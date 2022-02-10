<?php
/**
 * Menu Walker.
 *
 * @package RMS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class
 */
class RMS_Menu_Walker {

	/**
	 * Menu id
	 *
	 * @var $menu_id
	 */
	public $menu_id = '';

	/**
	 * Menu data
	 *
	 * @var $data
	 */
	public $data = [];

	/**
	 * Default constructor.
	 *
	 * @param string $menu_id menu id.
	 */
	public function __construct( $menu_id ) {
		$this->menu_id = $menu_id;
		$cache         = new get_menu_cache( $this->menu_id );
		$this->data    = $cache->data;
	}

	/**
	 * Build the mega menu with one tier drop downs
	 * Needs to be wrapped in a container/nav tag when
	 * output in template
	 *
	 * @param string $loc menu location.
	 *
	 * @return $html
	 */
	public function build_menu( $loc = '' ) {

		global $options;
		global $wp;
		$current_url = home_url( add_query_arg( [], $wp->request ) ) . '/';

		$menu_html = '<ul class="flex justify-around md:space-x-3 lg:space-x-4">';

		if ( 'mobile' === $loc ) {
			$menu_html = '<ul class="flex flex-col">';
		}

		foreach ( $this->data as $link ) {

			$current        = ( $current_url === $link['url'] ) ? true : false;
			$mobile_submenu = 'sub-menu w-52 bg-light-gray p-5 rounded text-theme-color space-y-2 absolute top-12 -left-1/2 hidden group-hover:block';
			$caret          = '';

			if ( $current && is_page_template( 'page-home.php' ) && 'mobile' !== $loc ) {
				$classes = 'hover:text-primary border-b border-white';
			}
			if ( $current && ! is_page_template( 'page-home.php' ) && 'mobile' !== $loc ) {
				$classes = 'hover:text-primary border-b border-theme-color';
			}
			if ( ! $current ) {
				$classes = 'hover:text-primary';
			}
			if ( 'mobile' === $loc ) {
				$classes        = 'block px-6 py-2 border-b border-neutral-300';
				$mobile_submenu = $classes;
			}
			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) && 'mobile' !== $loc ) {
				$caret = '<span> <i class="fa fa-angle-down"></i></span>';
			}

			$target = '';
			if ( '' !== $link['target'] ) {
				$target = ' target="' . $link['target'] . '" ';
			}

			$menu_html .= '<li class="group relative">';

			$menu_html .= sprintf(
				'<a href="%s" %s class="%s">%s%s</a>',
				$link['url'],
				$target,
				$classes,
				$link['title'],
				$caret
			);

			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) ) {
				$menu_html .= '<ul class="' . $mobile_submenu . '">';
			}

			foreach ( $link['children'] as $child ) {

				$menu_html .= '<li class="group relative">';

				if ( empty( $child['children'] ) ) {
					$menu_html .= sprintf(
						'<a href="%s" %s class="hover:text-primary">%s</a>',
						$child['url'],
						$target,
						$child['title']
					);
				}

				$menu_html .= '</li>';

			}

			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) ) {
				$menu_html .= '</ul>';
			}

			$menu_html .= '</li>';

		}

		$menu_html .= '</ul>';

		return $menu_html;

	}

}
