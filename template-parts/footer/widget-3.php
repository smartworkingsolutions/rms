<?php
/**
 * The template part for displaying Widget 3 in footer.
 *
 * @package RMS
 */

$heading = get_field( 'widget_3_heading', 'option' );
$address = get_field( 'widget_3_address', 'option' );
$phone   = get_field( 'widget_3_phone_number', 'option' );
$email   = get_field( 'widget_3_email', 'option' );

if ( ! $heading && ! $address && ! $phone && ! $email ) {
	return;
}
?>

<div class="f-widget md:col-end-5 md:col-span-2 md:text-right">

	<?php
	if ( $heading ) {
		echo '<h3 class="widget-title text-xl font-bold uppercase mb-4">' . esc_html( $heading ) . '</h3>';
	}

	if ( $address || $phone || $email ) {
		echo '<address class="text-lg not-italic font-bold">';

		if ( $address ) {
			echo '<div class="address mb-6 flex flex-col">' . wp_kses_post( $address ) . '</div>';
		}
		if ( $phone ) {
			echo '<div class="number mb-6 flex flex-col">' . wp_kses_post( $phone ) . '</div>';
		}
		if ( $email ) {
			echo '<div class="email flex flex-col">' . wp_kses_post( $email ) . '</div>';
		}

		echo '</address>';
	}

	echo '<p class="bottom-text text-xl font-medium mt-12"><a class="hover:text-primary" href="https://www.netbizgroup.co.uk/">Web Design Company</a></p>';
	?>
	<!-- <h3 class="widget-title text-xl font-bold uppercase mb-4">Contact Information</h3> -->

	<!-- <address class="text-lg not-italic font-bold">
		<div class="address mb-6 flex flex-col">
			Mowpen Brow, High Legh, Nr Knutsford<br>
			Cheshire<br>
			WA16 6PB
		</div>
		<div class="number mb-6 flex flex-col">
			<a class="hover:text-primary" href="tel:01925 752165">01925 752165</a>
			<a class="hover:text-primary" href="tel:01925 752165">01925 752165</a>
		</div>
		<div class="email flex flex-col">
			<a class="hover:text-primary" href="mailto:admin@rms-ltd.com">email: admin@rms-ltd.com</a>
		</div>
	</address>

	<p class="bottom-text text-xl font-medium mt-12"><a class="hover:text-primary" href="https://www.netbizgroup.co.uk/">Web Design Company</a></p> -->
</div>
