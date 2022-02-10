<?php
/**
 * The ACF template part for displaying Gallery.
 *
 * @package RMS
 */

$margin = get_sub_field( 'gallery_margin' );
$class  = '';

if ( $margin && in_array( 'top', $margin ) && ! in_array( 'bottom', $margin ) ) {
	$class = ' mt-20 lg:mt-26';
}
if ( $margin && in_array( 'bottom', $margin ) && ! in_array( 'top', $margin ) ) {
	$class = ' mb-20 lg:mb-26';
}
if ( $margin && in_array( 'bottom', $margin ) && in_array( 'top', $margin ) ) {
	$class = ' mt-20 lg:mt-26 mb-20 lg:mb-26';
}
?>

<section class="gallery-container<?php echo esc_html( $class ); ?>">
	<div class="container">

		<?php
		// Check lists exists.
		if ( have_rows( 'gallery_grid' ) ) :

			echo '<div class="gallery grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-11">';

			// Loop through rows.
			while ( have_rows( 'gallery_grid' ) ) :
				the_row();

				// Load sub field value.
				$image   = '';
				$caption = get_sub_field( 'gallery_image_caption' );

				if ( get_sub_field( 'gallery_image' ) ) {
					$image = df_resize( get_sub_field( 'gallery_image' ), '', 765, 501, true, true );
				}

				if ( $image ) {
					printf(
						'<a class="image-popup-vertical-fit" href="%1$s" title="%2$s">
							<img src="%1$s">
						</a>',
						esc_url( $image['url'] ),
						esc_html( $caption )
					);
				}

			endwhile;

			echo '</div>';

		endif;
		?>

		<!-- <div class="gallery grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-11">
			<a class="image-popup-vertical-fit" href="images/solutions.jpg" title="Caption text here.">
				<img src="images/solutions.jpg">
			</a>
			<a class="image-popup-vertical-fit" href="images/solutions.jpg" title="Caption text here.">
				<img src="images/solutions.jpg">
			</a>
			<a class="image-popup-vertical-fit" href="images/solutions.jpg" title="Caption text here.">
				<img src="images/solutions.jpg">
			</a>
			<a class="image-popup-vertical-fit" href="images/solutions.jpg" title="Caption text here.">
				<img src="images/solutions.jpg">
			</a>
		</div> -->

	</div>
</section>
