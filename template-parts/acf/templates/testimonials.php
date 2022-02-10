<?php
/**
 * The ACF template part for displaying Testimonials.
 *
 * @package RMS
 */

$heading     = get_sub_field( 'testimonials_heading' );
$description = get_sub_field( 'testimonials_description' );
?>

<section class="testimonials mt-16 lg:mt-24">
	<div class="container">

		<?php
		if ( $heading || $description ) {
			echo '<div class="heading-section text-center mb-12 lg:mb-20">';

			if ( $heading ) {
				printf(
					'<span class="title-border text-7xl font-bold uppercase dark-stroke opacity-20 hidden lg:block">%1$s</span>
					<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 relative z-10">%1$s</h2>',
					esc_html( $heading )
				);
			}
			if ( $description ) {
				echo '<p class="description mt-5 text-theme-color font-light lg:w-6/12 mx-auto mb-8">' . esc_html( $description ) . '</p>';
			}

			echo '</div>';
		}

		// Check lists exists.
		if ( have_rows( 'testimonials_grid' ) ) :

			echo '<div class="testimonial-wrap grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-26 mb-26">';

			// Loop through rows.
			while ( have_rows( 'testimonials_grid' ) ) :
				the_row();

				// Load sub field value.
				$heading = get_sub_field( 'testimonial_title' );
				$text    = get_sub_field( 'testimonial_content' );

				if ( $heading || $text ) {
					?>

					<div class="w-full">

						<?php
						if ( $heading ) {
							echo '<h3 class="article-title text-3xl font-bold mb-8">' . esc_html( $heading ) . '</h3>';
						}
						if ( $text ) {
							?>
							<div class="content relative">
								<svg class="absolute -top-4 left-0" width="28" height="30" viewBox="0 0 28 30">
									<text id="quote-left" transform="translate(14 26)" fill="#c62509" font-size="30" font-family="FontAwesome6Pro-Solid, 'Font Awesome \36  Pro Solid'"><tspan x="-13.125" y="0">quote-left</tspan></text>
								</svg>
								<?php echo '<p class="first-letter:pl-8">' . wp_kses_post( $text ) . '</p>'; ?>
								<svg class="absolute -bottom-2 right-0" width="28" height="30" viewBox="0 0 28 30">
									<text id="quote-right" transform="translate(14 26)" fill="#c62509" font-size="30" font-family="FontAwesome6Pro-Solid, 'Font Awesome \36  Pro Solid'"><tspan x="-13.125" y="0">quote-right</tspan></text>
								</svg>
							</div>
							<?php
						}
						?>

					</div>

					<?php
				}

			endwhile;

			echo '</div>';

		endif;
		?>

	</div>
</section>
