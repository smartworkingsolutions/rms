<?php
/**
 * The template part for displaying Search Title in knowledge bank archive page.
 *
 * @package RMS
 */

$image = '';
if ( get_field( 'kb_archive_hero_image', 'options' ) ) {
	$image = df_resize( get_field( 'kb_archive_hero_image', 'options' ), '', 1920, 421, true, true );
}

if ( ! $image ) {
	return;
}
?>

<section class="featured py-16 lg:py-28 bg-cover" style="background-image: url('<?php echo $image ? esc_url( $image['url'] ) : ''; ?>');">
	<div class="container">

		<div class="heading-section text-center">
			<h2 class="title text-4xl md:text-5xl font-bold uppercase text-white relative z-10">
				<?php
				if ( is_search() ) {
					echo 'Search Results for: ' . get_search_query();
				} else {
					the_archive_title();
				}
				?>
			</h2>
		</div>

	</div>
</section>
