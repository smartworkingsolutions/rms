<?php
/**
 * Template Name: Ask for help Form
 * The template for displaying Help query form.
 *
 * @package RMS
 */

get_header();

$heading   = get_field( 'ask_form_heading' );
$text      = get_field( 'ask_form_description' );
$shortcode = get_field( 'ask_form_shortcode' );
$image     = '';
if ( get_field( 'ask_image' ) ) {
	$image = df_resize( get_field( 'ask_image' ), '', 716, 680, true, true );
}
?>

	<section class="mt-16 lg:mt-26 mb-16 lg:mb-26">
		<div class="container">

			<div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-10">

				<!-- Form start -->
				<div class="w-full">

					<?php
					// Heading and text.
					if ( $heading || $text ) {
						echo '<div class="w-full mb-8">';

						if ( $heading ) {
							echo '<h2 class="text-theme-color font-bold text-3xl mb-4">' . esc_html( $heading ) . '</h2>';
						}
						if ( $text ) {
							echo '<p>' . wp_kses_post( $text ) . '</p>';
						}

						echo '</div>';
					}

					// Form.
					if ( $shortcode ) {
						echo do_shortcode( '[contactforms form_name="ask_form"]' );
					}
					?>

				</div>

				<?php
				// Image.
				if ( $image ) {
					echo '<div class="w-full">';
					echo '<img class="w-full" src="' . esc_url( $image['url'] ) . '" alt="How can we help?">';
					echo '</div>';
				}
				?>

			</div>

		</div>
	</section>

<?php
get_footer();
