<?php
/**
 * RMS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RMS
 */

if ( ! defined( 'THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'THEME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'rms_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rms_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on RMS, use a find and replace
		 * to change 'rms' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rms', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			[
				'main-menu' => esc_html__( 'Primary', 'rms' ),
			]
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rms_custom_background_args',
				[
					'default-color' => 'ffffff',
					'default-image' => '',
				]
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'height'      => 50,
				'width'       => 138,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);
	}
endif;
add_action( 'after_setup_theme', 'rms_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rms_content_width', 640 );
}
add_action( 'after_setup_theme', 'rms_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rms_widgets_init() {
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar', 'rms' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rms' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);
}
add_action( 'widgets_init', 'rms_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rms_scripts() {

	$version = CUSTOMCACHE_VERSION;
	$path    = get_template_directory_uri();

	/**
	 * Styles
	 */
	// Main style css.
	wp_enqueue_style( 'rms-style', get_stylesheet_uri(), [], $version );

	// Magnific popup css.
	wp_enqueue_style( 'rms-magnific-popup-css', $path . '/css/magnific-popup.css', [], $version );

	/**
	 * Scripts
	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Theme's scrips.
	wp_enqueue_script( 'rms-custom', $path . '/js/custom.js', [ 'jquery' ], $version, true );
	wp_enqueue_script( 'rms-magnific-popup', $path . '/js/jquery.magnific-popup.min.js', [], $version, true );

	// Fontawesome icons.
	wp_enqueue_script( 'fontawesome5', '//kit.fontawesome.com/a0eab14e0c.js', [], $version, true );
	// Scroll Reveal JS.
	wp_enqueue_script( 'scroll-reveal', '//unpkg.com/scrollreveal', [], $version, true );

	// FB.
	wp_enqueue_script( 'fb-root', '//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0', [], '', true );

}
add_action( 'wp_enqueue_scripts', 'rms_scripts' );

/**
 * Add extra attributes to enqueued scripts.
 *
 * @param string $tag default.
 * @param string $handle default.
 */
function add_extra_attributes( $tag, $handle ) {
	return false !== strpos( $handle, 'fontawesome5' )
		? str_replace( ' src', ' crossorigin="anonymous" src', $tag )
		: $tag;
}
add_filter( 'script_loader_tag', 'add_extra_attributes', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * All classes here
 */
require get_template_directory() . '/inc/class-rms-menu-walker.php';
require get_template_directory() . '/inc/class-rms-actions.php';
require get_template_directory() . '/inc/class-rms-schema.php';
require get_template_directory() . '/inc/class-custom-post-types.php';
require get_template_directory() . '/inc/class-rms-forms.php';

/**
 * Load ACF Options panel.
 */
require get_template_directory() . '/inc/class-acf-options-panel.php';

/**
 * ACF content filter preview path.
 */
function get_acf_preview_path() {
	return 'template-parts/acf/images';
}
add_filter( 'acf-flexible-content-preview.images_path', 'get_acf_preview_path' );

/**
 * This will remove the default image sizes and the medium_large size.
 *
 * @param array $sizes default sizes.
 */
function prefix_remove_default_images( $sizes ) {
	unset( $sizes['small'] ); // 150px.
	unset( $sizes['medium'] ); // 300px.
	unset( $sizes['large'] ); // 1024px.
	unset( $sizes['medium_large'] ); // 768px.
	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );

/**
 * This will remove the default image sizes and the medium_large size.
 */
function remove_big_image_sizes() {
	remove_image_size( '1536x1536' ); // 2 x Medium Large (1536 x 1536)
	remove_image_size( '2048x2048' ); // 2 x Large (2048 x 2048)
}
add_action( 'init', 'remove_big_image_sizes' );
