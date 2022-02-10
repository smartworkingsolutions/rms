<?php
/**
 * The template for displaying career single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package RMS
 */

get_header();
?>

	<section class="knowledge my-16 lg:my-26">
		<div class="container">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/careers/content', 'single' );
				get_template_part( 'template-parts/careers/responsibilities', 'requirements' );

			endwhile;
			?>

		</div>
	</section>

<?php
get_footer();
