<?php
/**
 * The template for displaying error(404) page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RMS
 */

get_header();
?>

<section class="mt-16 lg:mt-26 mb-16 lg:mb-26">
	<div class="container">

		<div class="text-center max-w-lg mx-auto space-y-8">

			<div class="text-9xl text-theme-color pb-8"><i class="fa fa-exclamation-triangle"></i></div>
			<h2 class="text-4xl">Sorry, something went wrong!</h2>
			<p class="max-w-sm mx-auto">This page is incidentally inaccessible because of support. We will back very before long much obliged for your understanding</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button mt-8"><?php esc_html_e( 'Return Home', 'rms' ); ?></a>

		</div>

	</div>
</section>

<?php
get_footer();
