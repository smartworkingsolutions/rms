<?php
/**
 * The template part for displaying Mobile menu in header.
 *
 * @package RMS
 */

$number      = get_field( 'phone_number', 'option' );
$number_link = rms_clean( $number );

$class = ' lg:border-theme-color';
$text  = ' text-theme-color';
if ( is_page_template( 'page-home.php' ) ) {
	$class = ' lg:border-white';
	$text  = ' text-white';
}
?>

<div class="contact-info flex justify-end h-full items-center lg:border-l<?php echo $class; ?> px-3 lg:px-10 relative z-20">
	<?php
	if ( $number ) {
		printf(
			'<div class="hidden lg:flex items-center">
				<i class="fa fa-phone mr-1"></i>
				<span class="whitespace-nowrap"><a href="tel:+%s">%s</a></span>
			</div>',
			esc_html( $number_link ),
			esc_html( $number )
		);
	}
	?>

	<!-- Mobile menu button -->
	<div class="mobile-menu-wrapper md:hidden flex flex-col items-center pl-2">
		<button class="outline-none mobile-menu-button text-4xl">
			<svg
				class="open w-12 h-12<?php echo esc_html( $text ); ?>"
				x-show="!showMenu"
				fill="none"
				stroke-linecap="round"
				stroke-linejoin="round"
				stroke-width="2"
				viewBox="0 0 24 24"
				stroke="currentColor"
			>
			<path d="M4 6h16M4 12h16M4 18h16"></path>
			</svg>
			<svg class="close w-12 h-12<?php echo esc_html( $text ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
		<span class="text-sm"><?php esc_html_e( 'Menu', 'rms' ); ?></span>
	</div>
</div>
