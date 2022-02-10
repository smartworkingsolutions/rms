<?php
/**
 * The template part for displaying Responsibilities and Requirements in career single page.
 *
 * @package RMS
 */

$responsibilities_heading = get_field( 'key_responsibilities_heading' );
$responsibilities_text    = get_field( 'add_key_responsibilities' );
$responsibilities_box     = get_field( 'key_responsibilities_box_text' );
$requirements_heading     = get_field( 'requirements_heading' );
$requirements_text        = get_field( 'add_qualification_requirements' );
$requirements_box         = get_field( 'requirements_box_text' );
?>

<?php
if ( ! $responsibilities_heading && ! $responsibilities_text && ! $responsibilities_box && ! $requirements_heading && ! $requirements_text && ! $requirements_box ) {
	return;
}
?>

<div class="details-border block md:flex mt-16 md:mt-20 md:space-x-26 relative">

	<?php
	if ( $responsibilities_heading || $responsibilities_text || $responsibilities_box ) {
		?>
		<div class="w-full">
			<div class="text">
				<?php
				if ( $responsibilities_heading ) {
					echo '<h2 class="text-3xl font-bold mb-6 text-theme-color">' . esc_html( $responsibilities_heading ) . '</h2>';
				}
				if ( $responsibilities_text ) {
					echo '<p>' . wp_kses_post( $responsibilities_text ) . '</p>';
				}
				?>
			</div>
			<?php
			if ( $responsibilities_box ) {
				echo '<div class="contact hidden md:block p-6 border border-primary font-bold text-center mt-24">' . esc_html( $responsibilities_box ) . '</div>';
			}
			?>
		</div>
		<?php
	}
	?>

	<?php
	if ( $requirements_heading || $requirements_text || $requirements_box || $responsibilities_box ) {
		?>
		<div class="w-full mt-12 md:mt-0">
			<div class="text-2">
				<?php
				if ( $requirements_heading ) {
					echo '<h2 class="text-3xl font-bold mb-6 text-theme-color">' . esc_html( $requirements_heading ) . '</h2>';
				}
				if ( $requirements_text ) {
					echo '<p>' . wp_kses_post( $requirements_text ) . '</p>';
				}
				?>
			</div>
			<?php
			if ( $responsibilities_box ) {
				echo '<div class="contact block md:hidden p-6 border border-primary font-bold text-center mt-8 md:mt-24">' . esc_html( $responsibilities_box ) . '</div>';
			}
			if ( $requirements_box ) {
				echo '<div class="contact p-6 border border-primary font-bold text-center mt-8 md:mt-24">' . esc_html( $requirements_box ) . '</div>';
			}
			?>
		</div>
		<?php
	}
	?>

</div>
