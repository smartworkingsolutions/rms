<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package RMS
 */

get_header();
?>

	<section class="knowledge py-26">
		<div class="container">
			<div class="block lg:flex lg:space-x-26">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/knowledge/content', 'single' );

				endwhile;
				?>

				<?php get_sidebar(); ?>

			</div>
		</div>
	</section>

<?php
get_footer();
