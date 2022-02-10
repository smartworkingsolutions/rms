<?php
/**
 * The ACF template part for displaying Careers posts.
 *
 * @package RMS
 */

$post_num = get_sub_field( 'careers_posts_num_post' );
$count    = 1;
?>

<section class="team my-16 lg:my-20">
	<div class="container">

		<?php
		// Grid.
		echo '<div class="team-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-20">';

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; // phpcs:ignore
		$query = new WP_Query( // phpcs:ignore
			[
				'post_type'      => 'career',
				'post_status'    => 'publish',
				'posts_per_page' => $post_num,
				'paged'          => $paged,
			]
		);

		if ( ! $query->have_posts() ) {
			echo '<p>No Career Posts available.</p>';
		}

		while ( $query->have_posts() ) :
			$query->the_post();

			// Load sub field value.
			$meta1      = get_field( 'career_single_job_type' );
			$meta2      = get_field( 'career_single_job_type_2' );
			$title_html = '';
			$link_html  = '';
			$meta_info  = '';

			$class1 = '';
			$class2 = '';
			$border = '';

			if ( $count % 3 == 1 || $count % 3 == 0 ) {
				$class1 = ' lg:bg-primary';
				$class2 = ' lg:text-white';
				$border = ' lg:border-white';
			}

			$title_html = sprintf(
				'<h3 class="article-title text-3xl font-bold mb-8 lg:mb-12%s">
					<a class="animate-line" href="%s">%s</a>
				</h3>',
				$class2,
				get_permalink(),
				get_the_title()
			);
			if ( $meta1 || $meta2 ) {
				$meta_info = sprintf(
					'<ul class="meta flex leading-none mb-3%s">
						<li class="border-r border-theme-color%s mr-2 pr-2">%s</li>
						<li>%s</li>
					</ul>',
					$class2,
					$border,
					$meta1,
					$meta2
				);
			}

			$link_html = sprintf(
				'<a href="%s" class="text-theme-color%s"><span class="animate-line">%s</span></a>',
				get_permalink(),
				$class2,
				esc_html__( 'Apply Now', 'rms' )
			);

			$content_html = sprintf(
				'<p class="content%1$s mb-8 lg:mb-12">Job Description : %2$s</p>',
				$class2,
				wp_trim_words( get_the_excerpt(), 16 ),
			);

			printf(
				'<article class="w-full bg-light-gray px-7 py-11%1$s">
					%2$s
					%3$s
					%4$s
					%5$s
				</article>',
				esc_html( $class1 ),
				wp_kses_post( $title_html ),
				wp_kses_post( $meta_info ),
				wp_kses_post( $content_html ),
				$link_html // phpcs:ignore
			);

			++$count;

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

		<?php bootstrap_pagination( [ 'custom_query' => $query ] ); ?>

	</div>
</section>
