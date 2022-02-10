<?php
/**
 * The ACF template part for displaying Custom HTML.
 *
 * @package RMS
 */

$margin = get_sub_field( 'custom_html_margin' );
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

<section class="<?php echo esc_html( $class ); ?>">
	<div class="container">

		<div class="content-wrap w-full">
			<?php
			if ( get_sub_field( 'custom_html_code' ) ) {
				echo get_sub_field( 'custom_html_code' ); // phpcs:ignore
			}
			?>

		</div>

	</div>
</section>
