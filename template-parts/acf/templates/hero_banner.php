<?php
/**
 * The ACF template part for displaying Hero Banner.
 *
 * @package RMS
 */

$image = '';
if ( get_sub_field( 'hero_banner_image' ) ) {
	$image = df_resize( get_sub_field( 'hero_banner_image' ), '', 1920, false, true, true );
}
$layout        = get_sub_field( 'background_type' );
$overlay       = get_sub_field( 'hero_banner_overlay' );
$overlay_color = get_sub_field( 'overlay_bg_color' );
$video_id      = get_sub_field( 'vimeo_video_id' );
$heading       = get_sub_field( 'hero_banner_heading' );
$content       = get_sub_field( 'hero_banner_text' );
$btn_text      = get_sub_field( 'hero_banner_button_text' );
$btn_url       = get_sub_field( 'hero_banner_button_url' );
?>

<div class="w-full featured-area -mt-24 lg:-mt-20 relative">

	<?php
	if ( $overlay && $overlay_color ) {
		echo '<div class="absolute inset-0" style="background-color: ' . esc_html( $overlay_color ) . ';"></div>';
	}
	if ( 'image' === $layout ) {
		if ( $heading || get_sub_field( 'hero_banner_image' ) ) {
			printf(
				'<div class="w-full">
					<img class="w-full h-screen object-cover object-left" src="%s" alt="%s">
				</div>',
				esc_url( $image['url'] ),
				esc_html( $heading )
			);
		}
	}
	if ( 'video' === $layout && $video_id ) {
		?>
		<div class="w-full h-screen vimeo-wrapper overflow-hidden">
			<iframe src="https://player.vimeo.com/video/<?php echo esc_html( $video_id ); ?>?background=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;transparent=0&amp;autoplay=1&amp;muted=1&amp;loop=1&amp;autopause=0" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
		</div>
		<?php
	}
	?>

	<div class="container mx-auto">
		<div class="caption max-w-md text-white text-center md:text-right absolute top-2/4 right-1/2 md:right-10 lg:right-20 translate-x-1/2 md:translate-x-0 -translate-y-2/4">
			<?php
			if ( $heading ) {
				echo '<h1 class="uppercase text-5xl lg:text-6xl font-bold">' . esc_html( $heading ) . '</h1>';
			}
			if ( $content ) {
				echo '<p class="text-white">' . esc_html( $content ) . '</p>';
			}
			if ( $btn_text && $btn_url ) {
				printf(
					'<div class="text-center md:text-right mt-6">
						<a href="%s" class="button">%s</a>
					</div>',
					esc_url( $btn_url ),
					esc_html( $btn_text )
				);
			}
			?>
		</div>
		<div class="arrow animate-redirect md:animate-bounce text-white/70 text-4xl absolute bottom-24 right-1/2 md:right-20 translate-x-1/2 md:transform-none">
			<a href="#services"><i class="far fa-arrow-alt-circle-down"></i></a>
		</div>
	</div>
</div>
