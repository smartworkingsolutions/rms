<?php
/**
 * The template part for displaying Content in news single page.
 *
 * @package RMS
 */

?>

<div class="card card-style7 border-0">
	<?php
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id( get_the_id() );
		$image        = df_resize( $thumbnail_id, '', 856, 514, true, true );
		?>
		<img src="<?php echo esc_url( $image['url'] ); ?>" class="card-img-top" alt="Featured single image">
		<?php
	}
	?>
	<div class="card-body px-4 py-2-3">

		<?php
		the_title( '<h2 class="mb-4">', '</h2>' );
		the_content();
		?>

		<?php get_template_part( 'template-parts/news/social', 'share' ); ?>
	</div>
</div>
