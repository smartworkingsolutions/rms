<?php
/**
 * The template part for displaying Content in knowledge single page.
 *
 * @package RMS
 */

?>

<div class="content-area w-full lg:w-4/6">

	<?php
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id( get_the_id() );
		$image        = df_resize( $thumbnail_id, '', 1068, 424, true, true );
		?>
		<div class="single-featured w-full mb-4 relative">
			<img src="<?php echo esc_url( $image['url'] ); ?>" class="w-full" alt="Featured single image">
			<div class="caption w-full px-4 text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
				<?php the_title( '<h1 class="text-white text-4xl font-bold px-8">', '</h1>' ); ?>
			</div>
		</div>
		<?php
	}
	?>

	<div class="social-icons flex justify-end">
		<?php get_template_part( 'template-parts/knowledge/social', 'shares' ); ?>
	</div>

	<div class="content-wrap space-y-8 mt-8 lg:mt-20">
		<?php the_content(); ?>
	</div>
</div>
