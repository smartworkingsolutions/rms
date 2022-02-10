<?php
/**
 * The template part for displaying Widget 2 in footer.
 *
 * @package RMS
 */

$heading = get_field( 'widget_2_heading', 'option' );

if ( ! $heading && ! have_rows( 'widget_2_links', 'option' ) ) {
	return;
}
?>

<div class="f-widget">
	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title text-xl font-bold uppercase mb-4">' . esc_html( $heading ) . '</h3>';
	}

	if ( have_rows( 'widget_2_links', 'option' ) ) :

		echo '<div class="links"><ul class="text-lg font-bold uppercase space-y-4">';

		while ( have_rows( 'widget_2_links', 'option' ) ) :
			the_row();

			$links = get_sub_field( 'widget_2_link' );

			if ( $links ) {
				printf(
					'<li>
						<a class="hover:text-primary" href="%s">%s</a>
					</li>',
					esc_url( $links['url'] ),
					esc_html( $links['title'] )
				);
			}


		endwhile;

		echo '</ul></div>';

	endif;
	?>
</div>
