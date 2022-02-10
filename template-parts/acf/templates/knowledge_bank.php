<?php
/**
 * The ACF template part for displaying Knowledge bank.
 *
 * @package RMS
 */

$heading     = get_sub_field( 'knowledge_bank_heading' );
$description = get_sub_field( 'knowledge_bank_description' );
$post_num    = get_sub_field( 'knowledge_bank_num_post' );
$count       = 1;
?>

<section class="knowledge py-20 lg:py-24">
	<div class="container">

		<?php
		// Heading.
		if ( $heading || $description ) {
			echo '<div class="heading-section text-center mb-12 lg:mb-28">';

			if ( $heading ) {
				printf(
					'<span class="title-border text-7xl font-bold uppercase dark-stroke opacity-20 hidden lg:block">%1$s</span>
					<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 relative z-10">%1$s</h2>',
					esc_html( $heading )
				);
			}
			if ( $description ) {
				echo '<p class="description mt-6 text-gray-400 font-light lg:w-6/12 mx-auto">' . esc_html( $description ) . '</p>';
			}

			echo '</div>';
		}

		// Grid.
		echo '<div class="about-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-20">';

		$query = new WP_Query( // phpcs:ignore
			[
				'post_type'      => 'knowledge',
				'post_status'    => 'publish',
				'posts_per_page' => $post_num,
			]
		);

		if ( ! $query->have_posts() ) {
			echo '<p>No Knowledge Bank Posts available.</p>';
		}

		while ( $query->have_posts() ) :
			$query->the_post();

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

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

	</div>
</section>
