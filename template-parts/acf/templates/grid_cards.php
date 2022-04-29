<?php
/**
 * The ACF template part for displaying 3 Grid Cards.
 *
 * @package RMS
 */

$heading     = get_sub_field( '3_grid_heading' );
$description = get_sub_field( '3_grid_description' );
$count       = 1;
?>

<section class="knowledge mb-28">
	<div class="container">

		<?php
		// Heading.
		if ( $heading || $description ) {
			echo '<div class="heading-section text-center mt-12">';

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
		if ( have_rows( '3_grid_grid_lists' ) ) :

			echo '<div class="about-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-20 mt-12 lg:mt-16">';

			// Loop through rows.
			while ( have_rows( '3_grid_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$image      = '';
				$image_html = '';
				$heading    = get_sub_field( '3_grid_title' );
				$content    = get_sub_field( '3_grid_content' );
				$btn_text   = get_sub_field( '3_grid_link_text' );
				$btn_url    = get_sub_field( '3_grid_link_url' );
				$title_html = '';
				$link_html  = '';

				$class1 = '';
				$class2 = '';

				if ( $count % 3 == 1 || $count % 3 == 0 ) {
					$class1 = ' lg:bg-primary';
					$class2 = ' lg:text-white';
				}

				if ( get_sub_field( '3_grid_image' ) ) {

					$image = df_resize( get_sub_field( '3_grid_image' ), '', 443, 353, true, true );

					$image_html = sprintf(
						'<img class="w-full" src="%1$s" alt="%2$s">',
						$image['url'],
						$heading
					);
				}

				if ( $heading ) {
					$title_html = sprintf(
						'<h3 class="article-title text-3xl font-bold%s">
							<a class="animate-line" href="%s">%s</a>
						</h3>',
						$class2,
						$btn_url,
						$heading
					);
				}

				if ( $btn_text && $btn_url ) {
					$link_html = sprintf(
						'<a href="%s" class="text-theme-color%s text-lg"><span class="animate-line">%s</span></a>',
						$btn_url,
						$class2,
						$btn_text
					);
				}

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
					$image_html, // phpcs:ignore
					wp_kses_post( $title_html ),
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
