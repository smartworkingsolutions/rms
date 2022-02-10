<?php
/**
 * The template part for displaying Filters in knowledge bank archive page.
 *
 * @package RMS
 */

$is_filter_enable = get_field( 'showhide_filters', 'options' );

$terms = get_terms(
	[
		'taxonomy'   => 'knowledge_category',
		'hide_empty' => false,
	]
);

if ( ! $is_filter_enable ) {
	return;
}
?>

<div class="filter-container flex flex-col sm:flex-row sm:justify-between md:justify-end py-5 md:space-x-4">

	<div class="search-box w-full sm:w-72 md:text-right">
		<?php get_search_form(); ?>
	</div>

	<?php
	if ( $terms ) {
		?>

		<div class="filter mt-4 sm:mt-0 ml-auto sm:ml-0">
			<div class="relative w-48">
				<input type="checkbox" id="sortbox" class="hidden absolute">
				<label for="sortbox" class="flex justify-between items-center space-x-1 bg-primary text-white w-full h-[54px] px-6 cursor-pointer">
					<span class="text-base"><?php esc_html_e( 'Filter by category', 'rms' ); ?></span>
					<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
					</svg>
				</label>

				<div id="sortboxmenu" class="absolute mt-[1px] right-0 top-full w-full min-w-max shadow opacity-0 bg-primary text-white transition delay-75 ease-in-out z-10">
					<ul class="block">
						<?php
						foreach ( $terms as $term ) { // phpcs:ignore
							printf(
								'<li><a href="%s" class="block px-3 py-2 hover:bg-theme-color">%s</a></li>',
								esc_url( get_term_link( $term->slug, 'knowledge_category' ) ),
								esc_html( $term->name )
							);
						}
						?>
					</ul>
				</div>
			</div>
		</div>

		<?php
	}
	?>

</div>
