<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RMS
 */

get_header();
?>

	<section>
		<div class="container">
			<div class="row">

				<div class="col-lg-8 mb-1-9 mb-lg-0">

					<div class="row mt-n1-9">

						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', 'news' );

							endwhile;

							bootstrap_pagination();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>

					</div>

				</div>

				<div class="col-lg-4">
					<?php get_sidebar(); ?>
				</div>

			</div>
		</div>
	</section>

<?php
get_footer();
