<?php
/**
 * Register Custom Post Types
 *
 * @package RMS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class of Custom Post Types
 */
class Custom_Post_Types {

	/**
	 * The Construct
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'knowledge_custom_post_type' ] );
		add_action( 'init', [ $this, 'knowledge_custom_taxonomy' ] );
		add_action( 'init', [ $this, 'careers_custom_post_type' ] );
	}

	/**
	 * Knowledge CPT
	 */
	public function knowledge_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Knowledge bank', 'Post Type General Name', 'rms' ),
			'singular_name'      => _x( 'Knowledge bank', 'Post Type Singular Name', 'rms' ),
			'menu_name'          => __( 'Knowledge bank', 'rms' ),
			'parent_item_colon'  => __( 'Parent Knowledge', 'rms' ),
			'all_items'          => __( 'All Knowledge', 'rms' ),
			'view_item'          => __( 'View Knowledge', 'rms' ),
			'add_new_item'       => __( 'Add New Knowledge', 'rms' ),
			'add_new'            => __( 'Add New', 'rms' ),
			'edit_item'          => __( 'Edit Knowledge', 'rms' ),
			'update_item'        => __( 'Update Knowledge', 'rms' ),
			'search_items'       => __( 'Search Knowledge', 'rms' ),
			'not_found'          => __( 'Not Found', 'rms' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'rms' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'knowledge', 'rms' ),
			'menu_icon'           => 'dashicons-database',
			'description'         => __( 'Knowledge bank posts', 'rms' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields' ],
			// You can associate this CPT with a taxonomy or custom taxonomy.
			'taxonomies'          => [ 'knowledge_category' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'knowledge', $args );

	}

	/**
	 * Create a custom taxonomy named 'knowledge_category' for Knowledge bank CPT.
	 */
	public function knowledge_custom_taxonomy() {

		$labels = [
			'name'              => _x( 'Categories', 'taxonomy general name', 'rms' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'rms' ),
			'search_items'      => __( 'Search Categories', 'rms' ),
			'all_items'         => __( 'All Categories', 'rms' ),
			'parent_item'       => __( 'Parent Category', 'rms' ),
			'parent_item_colon' => __( 'Parent Category: ', 'rms' ),
			'edit_item'         => __( 'Edit Category', 'rms' ), 
			'update_item'       => __( 'Update Category', 'rms' ),
			'add_new_item'      => __( 'Add New Category', 'rms' ),
			'new_item_name'     => __( 'New Category Name', 'rms' ),
			'menu_name'         => __( 'Categories', 'rms' ),
		];

		register_taxonomy(
			'knowledge_category',
			[ 'knowledge' ],
			[
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => [ 'slug' => 'knowledge_category' ],
				'show_in_rest'      => true,
			]
		);
	}

	/**
	 * Careers CPT
	 */
	public function careers_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Careers', 'Post Type General Name', 'rms' ),
			'singular_name'      => _x( 'Career', 'Post Type Singular Name', 'rms' ),
			'menu_name'          => __( 'Careers', 'rms' ),
			'parent_item_colon'  => __( 'Parent Career', 'rms' ),
			'all_items'          => __( 'All Careers', 'rms' ),
			'view_item'          => __( 'View Career', 'rms' ),
			'add_new_item'       => __( 'Add New Career', 'rms' ),
			'add_new'            => __( 'Add New', 'rms' ),
			'edit_item'          => __( 'Edit Career', 'rms' ),
			'update_item'        => __( 'Update Career', 'rms' ),
			'search_items'       => __( 'Search Career', 'rms' ),
			'not_found'          => __( 'Not Found', 'rms' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'rms' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Careers', 'rms' ),
			'menu_icon'           => 'dashicons-businessman',
			'description'         => __( 'Career posts', 'rms' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'career', $args );
	}

}

/**
 * Init
 */
new Custom_Post_Types();
