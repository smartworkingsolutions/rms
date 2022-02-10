<?php
/**
 * The template part for displaying Mobile menu in header.
 *
 * @package RMS
 */

$nav = new RMS_Menu_Walker( 'main-menu' );
?>

<div class="main-nav w-full uppercase hidden md:block pl-5 lg:pl-0">
    <nav><?php echo $nav->build_menu(); // phpcs:ignore ?></nav>
</div>
