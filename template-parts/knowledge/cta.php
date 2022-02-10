<?php
/**
 * The template part for displaying CTA in knowledge bank archive page.
 *
 * @package RMS
 */

$image = '';
if ( get_field( 'kb_cta_image', 'options' ) ) {
	$image = df_resize( get_field( 'kb_cta_image', 'options' ), '', 1925, 423, true, true );
}
$heading1 = get_field( 'kb_cta_heading1', 'options' );
$heading2 = get_field( 'kb_cta_heading2', 'options' );
$btn_text = get_field( 'kb_cta_button_text', 'options' );
$btn_url  = get_field( 'kb_cta_button_url', 'options' );

if ( ! $image && ! $heading1 && ! $heading2 && ! $btn_text && ! $btn_url ) {
	return;
}
?>

<section class="cta mt-16 lg:mt-24 py-16 lg:py-20 bg-cover" style="background-image: url('<?php echo $image ? esc_url( $image['url'] ) : ''; ?>');">
	<div class="container">

		<?php
		if ( $heading1 || $heading2 || $btn_text || $btn_url ) {
			echo '<div class="heading-section text-white">';

			if ( $heading1 || $heading2 ) {
				echo '<h2 class="title w-full text-4xl lg:text-6xl font-bold text-white mb-4">' . esc_html( $heading1 ) . '</h2>';
				echo '<h2 class="title w-full text-4xl lg:text-6xl font-bold text-white mb-6">' . esc_html( $heading2 ) . '</h2>';
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
