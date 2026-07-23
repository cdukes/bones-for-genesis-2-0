<?php
/**
 * Loop and breadcrumb display customizations.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// add_filter( 'wpseo_breadcrumb_separator', 'bfg_wpseo_breadcrumb_separator' );
/**
 * Replace the Yoast SEO breadcrumb separator character with an SVG icon.
 *
 * @since 20180406
 *
 * @param string $sep The default breadcrumb separator.
 *
 * @return string The replacement separator markup.
 */
function bfg_wpseo_breadcrumb_separator( $sep ) {

	return bfg_get_icon( 'angle-right' );
}
