<?php
/**
 * The ACF template part for displaying CTA Layout 2.
 *
 * @package RMS
 */

$image = '';
if ( get_sub_field( 'cta_layout_2_bg_image' ) ) {
	$image = df_resize( get_sub_field( 'cta_layout_2_bg_image' ), '', 1925, 423, true, true );
}
$heading1 = get_sub_field( 'cta_layout_2_heading_1' );
$heading2 = get_sub_field( 'cta_layout_2_heading_2' );
$content  = get_sub_field( 'cta_layout_2_content' );
$btn_text = get_sub_field( 'cta_layout_2_button_text' );
$btn_url  = get_sub_field( 'cta_layout_2_button_url' );

if ( ! $image && ! $heading1 && ! $heading2 && ! $content && ! $btn_text && ! $btn_url ) {
	return;
}
?>

<section class="cta mt-16 lg:mt-24 py-16 lg:py-20 bg-cover" style="background-image: url('<?php echo $image ? esc_url( $image['url'] ) : ''; ?>');">
	<div class="container">

		<?php
		if ( $heading1 || $heading2 || $content || $btn_text || $btn_url ) {
			echo '<div class="heading-section text-white">';

			if ( $heading1 || $heading2 ) {
				echo '<h2 class="title w-full text-4xl lg:text-6xl font-bold text-white mb-4">' . esc_html( $heading1 ) . '</h2>';
				echo '<h2 class="title w-full text-4xl lg:text-6xl font-bold text-white mb-6">' . esc_html( $heading2 ) . '</h2>';
			}
			if ( $content ) {
				echo '<p class="text-white mb-8">' . nl2br( esc_html( $content ) ) . '</p>';
			}
			if ( $btn_text && $btn_url ) {
				printf(
					'<a href="%s" class="button">%s</a>',
					esc_url( $btn_url ),
					esc_html( $btn_text )
				);
			}

			echo '</div>';
		}
		?>

	</div>
</section>
