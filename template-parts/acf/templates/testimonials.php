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
								<svg class="absolute -top-4 left-0" width="28" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path fill="#c62509" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"/></svg>
								<?php echo '<p class="first-letter:pl-8">' . wp_kses_post( $text ) . '</p>'; ?>
								<svg class="absolute -bottom-2 right-0" width="28" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path fill="#c62509" d="M464 32H336c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48zm-288 0H48C21.5 32 0 53.5 0 80v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48z"/></svg>
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
