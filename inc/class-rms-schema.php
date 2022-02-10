<?php
/**
 * Schema
 *
 * @package RMS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class for Actions
 */
class RMS_Schema {

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
		add_action( 'wp_head', [ $this, 'get_schema_data' ], 10 );
	}

	/**
	 * Schema data.
	 */
	public function get_schema_data() {
		$this->article_schema_data();
		$this->faqs_schema_data();
		$this->contact_schema_data();
	}

	/**
	 * Article Schema data.
	 */
	public function article_schema_data() {

		if ( ! is_single() ) {
			return;
		}

		while ( have_posts() ) :
			the_post();

			if ( has_post_thumbnail() ) {

				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 856, 514, true, true );
				$image_url    = '';
				$author_id    = get_the_author_meta( 'ID' );

				if ( $image ) {
					$image_url = $image['url'];
				}

			}

			?>
			<script type="application/ld+json">
			{
			"@context": "https://schema.org",
			"@type": "NewsArticle",
			"mainEntityOfPage": {
				"@type": "WebPage",
				"@id": "https://google.com/article"
			},
			"headline": "<?php esc_html( the_title() ); ?>",
			"image": [
				"<?php echo esc_url( $image_url ); ?>"
			],
			"datePublished": "<?php the_date(); ?>",
			"dateModified": "<?php the_modified_date(); ?>",
			"author": {
				"@type": "Person",
				"name": "<?php the_author_meta( 'display_name', $author_id ); ?>",
				"url": "<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"
			},
			"publisher": {
				"@type": "Organization",
				"name": "Google",
				"logo": {
				"@type": "ImageObject",
				"url": "https://google.com/logo.jpg"
				}
			}
			}
			</script>
			<?php

		endwhile;

		wp_reset_postdata();

	}

	/**
	 * FAQs Schema data.
	 */
	public function faqs_schema_data() {

		if ( ! is_post_type_archive( 'faqs' ) ) {
			return;
		}

		?>
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"mainEntity": [

				<?php
				$query = new WP_Query( // phpcs:ignore
					[
						'post_type'      => 'faqs',
						'posts_per_page' => -1,
					]
				);

				while ( $query->have_posts() ) :
					$query->the_post();

					if ( has_post_thumbnail() ) {

						$thumbnail_id = get_post_thumbnail_id( get_the_id() );
						$image        = df_resize( $thumbnail_id, '', 856, 514, true, true );
						$image_url    = '';
						$author_id    = get_the_author_meta( 'ID' );

						if ( $image ) {
							$image_url = $image['url'];
						}

						$thumbnail = sprintf(
							'<div class="card-img position-relative">
								<img src="%1$s" alt="%2$s">
							</div>',
							$image['url'],
							get_the_title(),
						);
					}

					?>
					{
						"@type": "Question",
						"name": "<?php esc_html( the_title() ); ?>",
						"acceptedAnswer": {
						"@type": "Answer",
						"text": "<?php the_content(); ?>"
						}
					},
					<?php

				endwhile;

				wp_reset_postdata();

				?>
				]
			}
		</script>
		<?php

	}

	/**
	 * Contact page schema data.
	 */
	public function contact_schema_data() {

		if ( ! is_page_template( 'page-contact.php' ) ) {
			return;
		}

		while ( have_posts() ) :
			the_post();

			if ( has_post_thumbnail() ) {

				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 856, 514, true, true );
				$image_url    = '';

				if ( $image ) {
					$image_url = $image['url'];
				}

			}

		endwhile;
		wp_reset_postdata();

		$phone         = get_field( 'top_phone_number', 'options' );
		$email         = get_field( 'top_email', 'options' );
		$streetaddress = get_field( 'street_address', 'options' );
		$locality      = get_field( 'address_locality', 'options' );
		$region        = get_field( 'address_region', 'options' );
		$zip           = get_field( 'postalcode', 'options' );
		$country       = get_field( 'addresscountry', 'options' );

		?>
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Organization",
			"image": [
				"<?php esc_url( $image_url ); ?>"
			],
			"address": {
				"@type": "PostalAddress",
				"streetAddress": "<?php echo esc_html( $streetaddress ); ?>",
				"addressLocality": "<?php echo esc_html( $locality ); ?>",
				"addressRegion": "<?php echo esc_html( $region ); ?>",
				"postalCode": "<?php echo esc_html( $zip ); ?>",
				"addressCountry": "<?php echo esc_html( $country ); ?>"
			},
			"contactPoint": {
				"@type": "ContactPoint",
				"contactType": "customer support",
				"telephone": "[<?php echo esc_html( $phone ); ?>]",
				"email": "<?php echo esc_html( $email ); ?>"
			}
		}
		</script>
		<?php

	}

}

// Init.
new RMS_Schema();
