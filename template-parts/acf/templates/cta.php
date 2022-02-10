<?php
/**
 * The ACF template part for displaying CTA.
 *
 * @package RMS
 */

$image = '';
if ( get_sub_field( 'cta_bg_image' ) ) {
	$image = df_resize( get_sub_field( 'cta_bg_image' ), '', 1919, 661, true, true );
}
$heading     = get_sub_field( 'cta_heading' );
$description = get_sub_field( 'cta_description' );
$btn_text    = get_sub_field( 'cta_button_text' );
$btn_url     = get_sub_field( 'cta_button_url' );
?>

<section class="cta py-20 lg:py-28 bg-cover" style="background-image: url('<?php echo esc_url( $image['url'] ); ?>');">
	<div class="container">

		<?php
		if ( $heading || $description || $btn_text || $btn_url ) {
			echo '<div class="heading-section text-center text-white">';

			if ( $heading ) {
				echo '<span class="title-border text-7xl font-bold uppercase light-stroke opacity-40 hidden lg:block">' . esc_html( $heading ) . '</span>';
				echo '<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 text-white relative z-10">' . esc_html( $heading ) . '</h2>';
			}
			if ( $description ) {
				echo '<p class="description mt-5 text-white font-light lg:w-6/12 mx-auto mb-8">' . esc_html( $description ) . '</p>';
			}
			if ( $btn_text && $btn_url ) {
				printf(
					'<a href="%s" class="button">%s</a>',
					esc_url( $btn_url ),
					esc_html( $btn_text )
				);
			}

			echo '</div>';
		}
		?>

	</div>
</section>
