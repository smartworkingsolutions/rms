<?php
/**
 * The ACF template part for displaying About RMS.
 *
 * @package RMS
 */

$heading       = get_sub_field( 'about_rms_heading' );
$description   = get_sub_field( 'about_rms_description' );
$grid_btn_text = get_sub_field( 'about_rms_grid_button_text' );
$grid_btn_url  = get_sub_field( 'about_rms_grid_button_url' );
$count         = 1;
?>

<section class="about-rms py-20 lg:py-28">
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
		if ( have_rows( 'about_rms_grid_lists' ) ) :

			echo '<div class="about-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-20">';

			// Loop through rows.
			while ( have_rows( 'about_rms_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$image = '';
				if ( get_sub_field( 'about_rms_image' ) ) {
					$image = df_resize( get_sub_field( 'about_rms_image' ), '', 443, 353, true, true );
				}
				$heading  = get_sub_field( 'about_rms_title' );
				$content  = get_sub_field( 'about_rms_content' );
				$btn_text = get_sub_field( 'about_rms_link_text' );
				$btn_url  = get_sub_field( 'about_rms_link_url' );
				$class1   = ' bg-primary';
				$class2   = ' text-white';

				if ( $count % 2 == 1 ) {
					$class1 = ' bg-light-gray';
					$class2 = ' text-theme-color';
				}

				?>
				<div class="wrap<?php echo esc_html( $class1 ); ?>">

					<?php
					if ( $image ) {
						printf(
							'<img class="w-full" src="%s" alt="%s">',
							esc_url( $image['url'] ),
							esc_html( $heading )
						);
					}

					if ( $heading || $content || $btn_text || $btn_url ) {
						echo '<div class="text-wrap p-9 flex flex-col space-y-4 lg:space-y-10">';

						if ( $heading ) {
							printf(
								'<h3 class="article-title text-3xl font-bold%s">
									<a class="animate-line" href="%s">%s</a>
								</h3>',
								esc_html( $class2 ),
								esc_url( $btn_url ),
								esc_html( $heading )
							);
						}
						if ( $content ) {
							echo '<p class="content' . esc_html( $class2 ) . '">' . wp_kses_post( $content ) . '</p>';
						}
						if ( $btn_text || $btn_url ) {
							printf(
								'<a href="%s" class="text-lg%s"><span class="animate-line">%s</span></a>',
								esc_url( $btn_url ),
								esc_html( $class2 ),
								esc_html( $btn_text )
							);
						}

						echo '</div>';
					}
					?>

				</div>
				<?php

				++$count;

			endwhile;

			if ( $grid_btn_text || $grid_btn_url ) {
				printf(
					'<a href="%s" class="bg-primary lg:hidden p-9 flex justify-center items-center text-white text-3xl font-bold">%s</a>',
					esc_url( $grid_btn_url ),
					esc_html( $grid_btn_text )
				);
			}

			echo '</div>';

		endif;
		?>

	</div>
</section>
