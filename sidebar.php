<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RMS
 */

$count = 1;
?>

<aside class="sidebar w-full mx-auto lg:w-4/12 mt-16 lg:mt-0">

	<div class="widget space-y-12 lg:space-y-26">

		<?php
		$query = new WP_Query( // phpcs:ignore
			[
				'post_type'      => 'knowledge',
				'post_status'    => 'publish',
				'posts_per_page' => 2,
				'orderby'        => 'rand',
			]
		);

		while ( $query->have_posts() ) :
			$query->the_post();

			$thumbnail    = '';
			$thumbnail_id = '';
			$title_html   = '';
			$link_html    = '';

			if ( has_post_thumbnail() && 1 !== $count ) {

				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 456, 306, true, true );

				$thumbnail = sprintf(
					'<img class="w-full" src="%1$s" alt="%2$s">',
					$image['url'],
					get_the_title()
				);

			}

			$title_html = sprintf(
				'<h3 class="article-title text-3xl font-bold text-white">
					<a class="animate-line" href="%s">%s</a>
				</h3>',
				get_permalink(),
				get_the_title()
			);

			$link_html = sprintf(
				'<a href="%s" class="text-white"><span class="animate-line">%s</span></a>',
				get_permalink(),
				__( 'View More', 'rms' )
			);

			printf(
				'<article class="w-full bg-primary">
					%s
					<div class="text-wrap p-9 flex flex-col space-y-4 lg:space-y-8">
						%s
						<p class="content text-white">%s</p>
						%s
					</div>
				</article>',
				$thumbnail, // phpcs:ignore
				wp_kses_post( $title_html ),
				wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ),
				$link_html // phpcs:ignore
			);

			++$count;

		endwhile;

		wp_reset_postdata();
		?>

	</div>
</aside>
