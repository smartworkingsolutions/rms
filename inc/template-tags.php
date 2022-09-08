<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RMS
 */

/**
 * Prints HTML of logo.
 */
function theme_logo() {
	$class = ' md:border-theme-color';
	if ( is_page_template( 'page-home.php' ) ) {
		$class = ' md:border-white';
	}
	?>
	<div class="logo flex h-full items-center md:border-r<?php echo $class; ?> px-4 lg:px-10">
	<?php
	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		$image_url      = $image[0];

		printf(
			'<a href="%s" class="navbar-brand">
			<img src="%s">
			</a>',
			esc_url( get_home_url() ),
			esc_url( $image_url )
		);
	} else {
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php
	}
	?>
	</div>
	<?php
}

if ( ! function_exists( 'rms_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function rms_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'rms' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'rms_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function rms_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'rms' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'rms_author_avatar' ) ) :
	/**
	 * Prints HTML with author image for the current author.
	 *
	 * @param string $size size of avatar image.
	 */
	function rms_author_avatar( $size = '100' ) {
		if ( function_exists( 'get_avatar' ) ) :
			echo get_avatar( get_the_author_meta( 'email' ), $size );
		endif;
	}
endif;

if ( ! function_exists( 'rms_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function rms_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'rms' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rms' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'rms' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rms' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rms' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'rms' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'rms_post_title' ) ) {
	/**
	 * Displays an optional post title.
	 */
	function rms_post_title() {

		if ( is_singular() && ! is_front_page() ) :
			the_title( '<h1 class="page-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

	}
}

if ( ! function_exists( 'rms_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $thumb cuustom thumb size.
	 */
	function rms_post_thumbnail( $thumb = 'post-thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$thumb,
						[
							'alt' => the_title_attribute(
								[
									'echo' => false,
								]
							),
						]
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Prints HTML of header.
 */
function theme_header_html() {

	if ( is_404() ) {
		return;
	}

	$class = ' bg-light-gray z-10 border-b border-theme-color';
	if ( is_page_template( 'page-home.php' ) ) {
		$class = ' bg-gray-900/20 text-white';
	}

	// Mobile menu.
	get_template_part( 'template-parts/header/mobile', 'menu' );
	?>

	<!-- Header start -->
	<header class="site-header w-full h-24 lg:h-20 flex justify-between items-center<?php echo esc_html( $class ); ?> relative z-20">
		<?php theme_logo(); ?>
		<?php get_template_part( 'template-parts/header/main', 'menu' ); ?>
		<?php get_template_part( 'template-parts/header/contact', 'info' ); ?>
	</header>
	<!-- Header end -->
	<?php

}

/**
 * Prints HTML of footer.
 */
function theme_footer_html() {

	if ( is_404() ) {
		return;
	}
	$footer_logo = get_theme_mod( 'footer_logo' );
	?>

	<footer class="site-footer bg-light-gray py-12">
		<div class="container">

			<?php
			if ( $footer_logo ) {
				echo '<div class="f-logo w-full flex md:justify-end mb-8">';

				printf(
					'<a href="%s">
						<img src="%s" alt="%s">
					</a>',
					esc_url( get_home_url() ),
					esc_url( $footer_logo ),
					esc_html( get_bloginfo( 'name' ) )
				);

				echo '</div>';
			}
			?>

			<div class="widgets-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 md:gap-0 text-theme-color">

				<?php
				/**
				 * Widgets here
				 */
				get_template_part( 'template-parts/footer/widget', '1' );
				get_template_part( 'template-parts/footer/widget', '2' );
				get_template_part( 'template-parts/footer/widget', '3' );
				?>

			</div>

		</div>
	</footer>

	<?php
}
