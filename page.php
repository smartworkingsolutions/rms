<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RMS
 */

get_header();
?>

	<section class="mt-16 lg:mt-26 mb-16 lg:mb-26">
		<div class="container">
			<div class="w-full">

				<?php
				while ( have_posts() ) :
					the_post();

					the_title( '<h2 class="mb-4">', '</h2>' );

					the_content();

				endwhile; // End of the loop.
				?>

			</div>
		</div>
	</section>

<?php
get_footer();
