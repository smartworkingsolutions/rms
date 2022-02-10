<?php
/**
 * All custom actions here.
 *
 * @package RMS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class for Actions
 */
class RMS_Actions {

	/**
	 * The Construct
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hooks and Filters.
	 */
	public function hooks() {
		add_action( 'rms_after_header', [ $this, 'get_page_featured_section' ], 10 );
	}

	/**
	 * Page Title, Breadcrumb and Image.
	 */
	public function get_page_featured_section() {

		$image = '';
		if ( get_field( 'hero_section_image' ) ) {
			$image = df_resize( get_field( 'hero_section_image' ), '', 1920, 421, true, true );
		}
		$heading     = get_field( 'hero_section_heading' );
		$description = get_field( 'hero_section_content' );

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
		<?php
	}

}

// Init.
new RMS_Actions();
