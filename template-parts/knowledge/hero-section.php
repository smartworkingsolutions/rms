<?php
/**
 * The template part for displaying Hero Section in knowledge bank archive page.
 *
 * @package RMS
 */

$image = '';
if ( get_field( 'kb_archive_hero_image', 'options' ) ) {
	$image = df_resize( get_field( 'kb_archive_hero_image', 'options' ), '', 1920, 421, true, true );
}
$heading     = get_field( 'kb_archive_hero_heading', 'options' );
$description = get_field( 'kb_archive_hero_content', 'options' );

if ( ! $image && ! $heading && ! $description ) {
	return;
}
?>

<section class="featured py-16 lg:py-28 bg-cover" style="background-image: url('<?php echo $image ? esc_url( $image['url'] ) : ''; ?>');">
	<div class="container">

		<?php
		if ( $heading || $description ) {
			echo '<div class="heading-section text-center text-white">';

			if ( $heading ) {
				echo '<span class="title-border text-7xl font-bold uppercase light-stroke opacity-40 hidden lg:block">' . esc_html( $heading ) . '</span>';
				echo '<h2 class="title text-4xl md:text-6xl font-bold uppercase lg:-mt-10 text-white relative z-10">' . esc_html( $heading ) . '</h2>';
			}
			if ( $description ) {
				echo '<p class="description mt-5 text-white lg:w-6/12 mx-auto">' . wp_kses_post( $description ) . '</p>';
			}

			echo '</div>';
		}
		?>

	</div>
</section>
