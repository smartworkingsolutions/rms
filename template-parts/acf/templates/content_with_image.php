<?php
/**
 * The ACF template part for displaying Services.
 *
 * @package RMS
 */

$layout_style = get_sub_field( 'layout_style' );
$heading      = get_sub_field( 'content_with_image_heading' );
$content      = get_sub_field( 'content_with_image_content' );
$image        = '';
if ( get_sub_field( 'content_with_image_image' ) ) {
	$image = df_resize( get_sub_field( 'content_with_image_image' ), '', 765, 501, true, true );
}
$btn_text = get_sub_field( 'content_with_image_button_text' );
$btn_url  = get_sub_field( 'content_with_image_button_link' );

if ( ! $heading && ! $content && ! $image && ! $btn_text && ! $btn_url ) {
	return;
}

$margin = get_sub_field( 'content_with_image_margin' );
$class  = '';

if ( $margin && in_array( 'top', $margin ) && ! in_array( 'bottom', $margin ) ) {
	$class = ' mt-16 lg:mt-26';
}
if ( $margin && in_array( 'bottom', $margin ) && ! in_array( 'top', $margin ) ) {
	$class = ' mb-16 lg:mb-26';
}
if ( $margin && in_array( 'bottom', $margin ) && in_array( 'top', $margin ) ) {
	$class = ' mt-16 lg:mt-26 mb-16 lg:mb-26';
}
?>

<section class="knowledge<?php echo esc_html( $class ); ?>">
	<div class="container">

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-x-26">

			<?php
			if ( $image && 'content' !== $layout_style ) {
				echo '<div class="image-wrap w-full"><img src="' . esc_url( $image['url'] ) . '"></div>';
			}

			if ( $content || $heading ) {
				echo '<div class="content-wrap w-full space-y-8">';

				if ( $heading ) {
					echo '<h2 class="text-primary font-bold uppercase text-3xl">' . esc_html( $heading ) . '</h2>';
				}
				if ( $content ) {
					echo $content; // phpcs:ignore
				}
				if ( $btn_text && $btn_url ) {
					printf(
						'<div class="mt-6">
							<a href="%s" class="button">%s</a>
						</div>',
						esc_url( $btn_url ),
						esc_html( $btn_text )
					);
				}
				echo '</div>';
			}

			if ( $image && 'content' === $layout_style ) {
				echo '<div class="image-wrap w-full"><img src="' . esc_url( $image['url'] ) . '"></div>';
			}
			?>

		</div>

	</div>
</section>
