<?php
/**
 * The template for displaying archive knowledge bank posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RMS
 */

get_header();
$count = 1;
?>

<?php get_template_part( 'template-parts/knowledge/hero', 'section' ); ?>

<section class="knowledge">
	<div class="container">

		<?php get_template_part( 'template-parts/knowledge/filters' ); ?>

		<div class="about-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-20">

			<?php
			while ( have_posts() ) :
				the_post();

				$thumbnail    = '';
				$thumbnail_id = '';
				$title_html   = '';
				$link_html    = '';

				$class1 = '';
				$class2 = '';

				if ( $count % 3 == 1 || $count % 3 == 0 ) {
					$class1 = ' lg:bg-primary';
					$class2 = ' lg:text-white';
				}

				if ( has_post_thumbnail() ) {

					$thumbnail_id = get_post_thumbnail_id( get_the_id() );
					$image        = df_resize( $thumbnail_id, '', 443, 353, true, true );

					$thumbnail = sprintf(
						'<img class="w-full" src="%1$s" alt="%2$s">',
						$image['url'],
						get_the_title()
					);

				}

				$title_html = sprintf(
					'<h3 class="article-title text-3xl font-bold%s">
						<a class="animate-line" href="%s">%s</a>
					</h3>',
					$class2,
					get_permalink(),
					get_the_title()
				);

				$link_html = sprintf(
					'<a href="%s" class="text-theme-color%s text-lg"><span class="animate-line">%s</span></a>',
					get_permalink(),
					$class2,
					__( 'View More', 'rms' )
				);

				printf(
					'<article class="w-full bg-light-gray%1$s">
						%2$s
						<div class="text-wrap p-9 flex flex-col space-y-4 lg:space-y-10">
							%3$s
							<p class="content%4$s">%5$s</p>
							%6$s
						</div>
					</article>',
					esc_html( $class1 ),
					$thumbnail, // phpcs:ignore
					wp_kses_post( $title_html ),
					esc_html( $class2 ),
					wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ),
					$link_html // phpcs:ignore
				);

				++$count;

			endwhile; // End of the loop.
			?>

		</div>

		<?php bootstrap_pagination(); ?>

	</div>
</section>

<?php get_template_part( 'template-parts/knowledge/cta' ); ?>

<?php
get_footer();
