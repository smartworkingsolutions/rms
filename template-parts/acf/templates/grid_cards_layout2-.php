<?php
/**
 * The ACF template part for displaying Grid Cards layout 2.
 *
 * @package RMS
 */

$heading     = get_sub_field( 'grid_l2_heading' );
$description = get_sub_field( 'grid_l2_description' );
$count       = 1;
?>

<section class="team my-16 lg:my-20">
	<div class="container">

		<?php
		// Grid.
		if ( have_rows( 'grid_l2_grid_lists' ) ) :

			echo '<div class="team-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-20">';

			// Loop through rows.
			while ( have_rows( 'grid_l2_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$heading    = get_sub_field( 'grid_l2_title' );
				$meta1      = get_sub_field( 'grid_l2_meta_1' );
				$meta2      = get_sub_field( 'grid_l2_meta_2' );
				$content    = get_sub_field( 'grid_l2_content' );
				$btn_text   = get_sub_field( 'grid_l2_link_text' );
				$btn_url    = get_sub_field( 'grid_l2_link_url' );
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

				if ( $heading ) {
					$title_html = sprintf(
						'<h3 class="article-title text-3xl font-bold mb-8 lg:mb-12%s">
							<a class="animate-line" href="%s">%s</a>
						</h3>',
						$class2,
						$btn_url,
						$heading
					);
				}
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
				if ( $btn_text && $btn_url ) {
					$link_html = sprintf(
						'<a href="%s" class="text-theme-color%s"><span class="animate-line">%s</span></a>',
						$btn_url,
						$class2,
						$btn_text
					);
				}

				printf(
					'<article class="w-full bg-light-gray px-7 py-11%1$s">
						%2$s
						%3$s
						<p class="content%4$s mb-8 lg:mb-12">%5$s</p>
						%6$s
					</article>',
					esc_html( $class1 ),
					wp_kses_post( $title_html ),
					wp_kses_post( $meta_info ),
					esc_html( $class2 ),
					wp_kses_post( $content ),
					$link_html // phpcs:ignore
				);

				++$count;

			endwhile;

			echo '</div>';

		endif;
		?>

	</div>
</section>
