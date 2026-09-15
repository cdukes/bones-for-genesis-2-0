<?php
/**
 * Site header customizations.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add a no-js class to the <body> tag.
 *
 * @since 2.3.51
 *
 * @param array $classes Body CSS classes.
 *
 * @return array Filtered classes.
 */
add_filter( 'body_class', 'bfg_no_js_body_class' );
function bfg_no_js_body_class( $classes ) {

	$classes[] = 'no-js';

	return $classes;
}

/**
 * Remove the header.
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

/**
 * Remove the site title and/or description.
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
