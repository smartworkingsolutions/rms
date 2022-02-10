<?php
/**
 * The template for displaying search form.
 *
 * @package RMS
 */

?>

<form id="searchform" class="search-form flex w-full sm:w-[60px] focus-within:w-full md:ml-auto relative" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search-input w-full sm:w-56 focus:outline-none focus:ring-0 px-4 grow bg-transparent sm:absolute top-0 bottom-0 left-0 sm:opacity-0 cursor-pointer border border-theme-color sm:border-0 -z-10" name="s" autocomplete="off" placeholder="Search..." value="<?php echo get_search_query(); ?>">
	<input type="hidden" name="post_type" value="knowledge" />
	<button class="search-submit bg-primary text-white w-[60px] h-[54px] ml-auto" type="submit"><i class="fa fa-search"></i></button>
</form>
