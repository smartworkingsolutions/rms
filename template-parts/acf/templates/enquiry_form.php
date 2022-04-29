<?php
/**
 * The ACF template part for displaying Enquiry form.
 *
 * @package RMS
 */

$heading = get_sub_field( 'enquiry_form_heading' );
$image   = '';
if ( get_sub_field( 'enquiry_form_ad_image' ) ) {
	$image = df_resize( get_sub_field( 'enquiry_form_ad_image' ), '', 444, 776, true, true );
}
$ad_title  = get_sub_field( 'enquiry_form_ad_title' );
$ad_title2 = get_sub_field( 'enquiry_form_ad_title2' );
$btn_obj   = get_sub_field( 'enquiry_form_ad_button_link' );

$title_html = '';
$btn_html   = '';
?>

<section>
	<div class="container">

		<div class="grid grid-cols-1 lg:grid-cols-3 items-start gap-12 lg:gap-20 mt-10">

			<div class="bg-light-gray p-9 col-span-2">

				<?php
				if ( $heading ) {
					echo '<h3 class="text-4xl font-bold text-theme-color uppercase mb-14 lg:mb-16">' . esc_html( $heading ) . '</h3>';
				}

				echo do_shortcode( '[contactforms form_name="enquiry_form"]' );
				?>

			</div>

			<?php
			if ( $ad_title || $ad_title2 ) {
				$title_html = sprintf(
					'<h2 class="text-4xl xl:text-5xl font-bold text-white">%s</h2>
					<h2 class="text-4xl xl:text-5xl font-bold text-white mt-2 xl:mt-4">%s</h2>',
					$ad_title,
					$ad_title2
				);
			}
			if ( $btn_obj ) {
				$btn_html = sprintf(
					'<a class="button w-full mt-6 xl:mt-12" href="%s">%s</a>',
					$btn_obj['url'],
					$btn_obj['title']
				);
			}
			if ( $image ) {
				printf(
					'<div class="ad hidden lg:block relative">
						<img class="w-full" src="%s" alt="%s">
						<div class="w-full absolute left-0 bottom-2 p-8">
						%s
						%s
						</div>
					</div>',
					esc_url( $image['url'] ),
					esc_html( $heading ),
					wp_kses_post( $title_html ),
					wp_kses_post( $btn_html )
				);
			}
			?>

		</div>

	</div>
</section>
