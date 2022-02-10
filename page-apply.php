<?php
/**
 * Template Name: Apply Form
 * The template for displaying Apply for Job form.
 *
 * @package RMS
 */

get_header();
?>

	<section class="mt-16 lg:mt-26 mb-16 lg:mb-26">
		<div class="container">

			<div class="w-full bg-light-gray px-12 md:px-20 py-12">

				<h2 class="text-theme-color font-bold text-3xl mb-12"><?php esc_html_e( 'Applying for job', 'rms' ); ?></h2>

				<?php echo do_shortcode( '[contactforms form_name="apply_form"]' ); ?>

			</div>

		</div>
	</section>

<?php
get_footer();
