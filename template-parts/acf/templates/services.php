<?php
/**
 * The ACF template part for displaying Services.
 *
 * @package RMS
 */

$heading = get_sub_field( 'services_heading' );

$margin = get_sub_field( 'services_margin' );
$class  = '';

if ( $margin && in_array( 'top', $margin ) && ! in_array( 'bottom', $margin ) ) {
	$class = ' mt-20 lg:mt-26';
}
if ( $margin && in_array( 'bottom', $margin ) && ! in_array( 'top', $margin ) ) {
	$class = ' mb-20 lg:mb-26';
}
if ( $margin && in_array( 'bottom', $margin ) && in_array( 'top', $margin ) ) {
	$class = ' mt-20 lg:mt-26 mb-20 lg:mb-26';
}
?>

<section id="services" class="bg-light-gray text-center py-20 lg:py-28<?php echo esc_html( $class ); ?>">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<div class="heading-section text-center mb-12 lg:mb-28">';

			printf(
				'<span class="title-border text-7xl font-bold uppercase dark-stroke text-neutral-200 opacity-20 hidden lg:block">%1$s</span>
				<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 relative z-10">%1$s</h2>',
				esc_html( $heading )
			);

			echo '</div>';
		}

		// Check lists exists.
		if ( have_rows( 'services_lists' ) ) :

			echo '<div class="service-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-0">';

			// Loop through rows.
			while ( have_rows( 'services_lists' ) ) :
				the_row();

				// Load sub field value.
				$icon = get_sub_field( 'service_icon' );
				$name = get_sub_field( 'service_title' );
				$text = get_sub_field( 'service_text' );

				$icon_html = '';
				$name_html = '';
				$text_html = '';

				if ( $icon ) {
					$icon_html = sprintf(
						'<div class="icon w-16 mx-auto mb-6">
							<img src="%s">
						</div>',
						$icon
					);
				}
				if ( $name ) {
					$name_html = sprintf(
						'<div class="title text-xl font-bold">
							%s
						</div>',
						$name
					);
				}
				if ( $text ) {
					$text_html = sprintf(
						'<div class="content mt-8">
							%s
						</div>',
						$text
					);
				}

				printf(
					'<div class="w-full px-4 lg:px-8">
						%s
						%s
						%s
					</div>',
					wp_kses_post( $icon_html ),
					wp_kses_post( $name_html ),
					wp_kses_post( $text_html )
				);

			endwhile;

			echo '</div>';

		endif;
		?>

	</div>
</section>
