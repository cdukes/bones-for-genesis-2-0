<?php
/**
 * Navigation menu customizations.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Remove the primary and secondary menus.
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_after_header', 'genesis_do_nav' );
// remove_action( 'genesis_after_header', 'genesis_do_subnav' );

/**
 * Remove menu item IDs.
 *
 * @since 2.3.31
 */
add_filter( 'nav_menu_item_id', '__return_false' );

/**
 * Limit menu depth.
 *
 * @since 2.3.31
 *
 * @param array $args wp_nav_menu() arguments.
 *
 * @return array Filtered arguments.
 */
add_filter( 'wp_nav_menu_args', 'bfg_limit_menu_depth' );
function bfg_limit_menu_depth( $args ) {

	$args['item_spacing'] = 'discard';
	$args['container']    = false;
	$args['fallback_cb']  = false;

	if ( ! in_array( $args['theme_location'] ?? '', array( 'primary', 'secondary' ), true ) ) {
		return $args;
	}

	$args['depth'] = 2;

	return $args;
}
