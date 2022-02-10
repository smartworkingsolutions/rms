<?php
/**
 * The template part for displaying Mobile menu in header.
 *
 * @package RMS
 */

$nav = new RMS_Menu_Walker( 'main-menu' );
?>

<div class="mobile-menu slide-close uppercase bg-light-gray w-60 h-screen fixed left-0 top-0 z-30">
	<nav><?php echo $nav->build_menu( 'mobile' ); // phpcs:ignore ?></nav>
</div>
<div class="overlay hidden"></div>
