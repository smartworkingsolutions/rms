<?php
/**
 * The ACF template part for displaying About Team.
 *
 * @package RMS
 */

$image = '';
if ( get_sub_field( 'our_team_bg_image' ) ) {
	$image = df_resize( get_sub_field( 'our_team_bg_image' ), '', 1520, 832, true, true );
}
$heading       = get_sub_field( 'our_team_heading' );
$description   = get_sub_field( 'our_team_description' );
$grid_btn_text = get_sub_field( 'our_team_grid_button_text' );
$grid_btn_url  = get_sub_field( 'our_team_grid_button_url' );
$count         = 1;
?>

<section class="team py-20 lg:py-28 bg-cover" style="background-image: url('<?php echo esc_url( $image['url'] ); ?>');">
	<div class="container">

		<?php
		if ( $heading || $description ) {
			echo '<div class="heading-section text-center text-white mb-12 lg:mb-20">';

			if ( $heading ) {
				printf(
					'<span class="title-border text-7xl font-bold uppercase light-stroke opacity-40 hidden lg:block">%1$s</span>
					<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 text-white relative z-10">%1$s</h2>',
					esc_html( $heading )
				);
			}
			if ( $description ) {
				echo '<p class="description mt-5 text-white font-light lg:w-6/12 mx-auto mb-8">' . esc_html( $description ) . '</p>';
			}

			echo '</div>';
		}

		// Grid.
		if ( have_rows( 'our_team_grid_lists' ) ) :

			echo '<div class="team-wrapper grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

			// Loop through rows.
			while ( have_rows( 'our_team_grid_lists' ) ) :
				the_row();

				// Load sub field value.
				$heading   = get_sub_field( 'our_team_title' );
				$meta1     = get_sub_field( 'our_team_meta_info_1' );
				$meta2     = get_sub_field( 'our_team_meta_info_2' );
				$content   = get_sub_field( 'our_team_content' );
				$link_text = get_sub_field( 'our_team_link_text' );
				$link_url  = get_sub_field( 'our_team_link_url' );
				$class1    = ' bg-light-gray';
				$class2    = ' text-theme-color';
				$border    = ' border-theme-color';

				if ( $count % 2 == 1 ) {
					$class1 = ' bg-primary';
					$class2 = ' text-white';
					$border = ' border-white';
				}

				if ( $heading || $meta1 || $meta2 || $content || $link_text || $link_url ) {
					echo '<div class="w-full' . esc_html( $class1 ) . ' px-7 py-11">';

					if ( $heading ) {
						printf(
							'<h3 class="article-title text-3xl font-bold mb-6%s">
								<a class="animate-line" href="%s">%s</a>
							</h3>',
							esc_html( $class2 ),
							esc_url( $link_url ),
							esc_html( $heading )
						);
					}
					if ( $meta1 || $meta2 ) {
						echo '<ul class="meta flex leading-none mb-3' . esc_html( $class2 ) . '">';

						if ( $meta1 ) {
							echo '<li class="border-r' . esc_html( $border ) . ' mr-2 pr-2">' . esc_html( $meta1 ) . '</li>';
						}
						if ( $meta2 ) {
							echo '<li>' . esc_html( $meta2 ) . '</li>';
						}

						echo '</ul>';
					}
					if ( $content ) {
						printf(
							'<p class="content mb-6%s">%s</p>',
							esc_html( $class2 ),
							esc_html( $content )
						);
					}
					if ( $link_text || $link_url ) {
						printf(
							'<a href="%s" class="%s"><span class="animate-line">%s</span></a>',
							esc_url( $link_url ),
							esc_html( $class2 ),
							esc_html( $link_text )
						);
					}

					echo '</div>';
				}

				++$count;

			endwhile;

			if ( $grid_btn_text || $grid_btn_url ) {
				printf(
					'<a href="%s" class="w-full flex justify-center items-center text-center bg-light-gray px-7 py-11 font-bold text-3xl text-theme-color uppercase hover:bg-theme-color hover:text-white">%s</a>',
					esc_url( $grid_btn_url ),
					esc_html( $grid_btn_text )
				);
			}

			echo '</div>';

		endif;
		?>

	</div>
</section>
