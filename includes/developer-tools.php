<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_action( 'wp_footer', 'bfg_query_stats' );
/**
 * Easily see the number of database queries made to load your page in your footer.
 *
 * See: http://wp-snippets.com/show-number-of-queries-and-page-load-time/
 *
 * @since 2.0.0
 */
function bfg_query_stats() {

	echo get_num_queries() . ' queries in ' . timer_stop(1) . ' seconds.';

}

// add_action( 'get_header', 'bfg_maintenance_mode' );
/**
 * Easily take your site down for maintenance, giving a 503 message for all non-admins.
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function bfg_maintenance_mode() {

	if( !(is_user_logged_in() && current_user_can( 'manage_options' ) ) ) {
		wp_die( 'Down for maintenance, please come back soon.', 'Down for maintenance, please come back soon.', array('response' => '503'));
	}

}

add_action( 'admin_bar_menu', 'bfg_clear_transients_node', 99 );
/**
 * Clear all transients with one click.
 *
 * @since 2.2.9
 */
function bfg_clear_transients_node( $wp_admin_bar ) {

	if( !is_admin() || !current_user_can('manage_options') )
		return;

	global $wpdb;

	if( isset($_GET['clear-transients']) && 1 === (int) $_GET['clear-transients'] ) {
		$wpdb->query( "DELETE FROM `$wpdb->options` WHERE `option_name` LIKE ('_transient_%') OR `option_name` LIKE ('_transient_timeout_%')" );
	}

	$count = $wpdb->query( "SELECT `option_name` FROM `$wpdb->options` WHERE `option_name` LIKE ('_transient_%')" );

	$args = array(
		'id'     => 'clear-transients',
		'title'  => 'Clear Transients (' . $count . ')',
		'parent' => 'site-name',
		'href'   => get_admin_url() . '?clear-transients=1',
	);

	$wp_admin_bar->add_node( $args );

}
