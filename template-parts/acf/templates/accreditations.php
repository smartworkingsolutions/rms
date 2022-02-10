<?php
/**
 * The ACF template part for displaying Accreditations.
 *
 * @package RMS
 */

$heading = get_sub_field( 'accreditations_heading' );
?>

<section class="clients py-20">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<div class="heading-section text-center mb-12 lg:mb-14">';

			printf(
				'<span class="title-border text-7xl font-bold uppercase dark-stroke opacity-20 hidden lg:block">%1$s</span>
				<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 relative z-10">%1$s</h2>',
				esc_html( $heading )
			);

			echo '</div>';
		}

		// Check lists exists.
		if ( have_rows( 'accreditations_logos' ) ) :

			echo '<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-x-8 justify-center items-center">';

			// Loop through rows.
			while ( have_rows( 'accreditations_logos' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'accreditations_image' ) ) {
					$image = df_resize( get_sub_field( 'accreditations_image' ), '', 239, 147, true, true );
				}
				$alt_text = get_sub_field( 'accreditations_alt_text' );

				if ( $image ) {
					printf(
						'<img class="w-auto" src="%s" alt="%s">',
						esc_url( $image['url'] ),
						esc_html( $alt_text )
					);
				}


			endwhile;

			echo '</div>';

		endif;
		?>

	</div>
</section>
