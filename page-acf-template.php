<?php
/**
 * Template Name: ACF Template
 * The template for displaying ACF templates on page.
 *
 * @package RMS
 */

get_header();

/**
 * Template loop
 */
$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
$acfp->render();

get_footer();
