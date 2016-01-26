<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
		wp_cache_flush();
	}

	$count = $wpdb->query( "SELECT `option_name` FROM `$wpdb->options` WHERE `option_name` LIKE ('_transient_%')" );

	$label = __( 'Clear Transients', CHILD_THEME_TEXT_DOMAIN );
	$args  = array(
		'id'     => 'clear-transients',
		'title'  => !empty($count) ? $label . ' (' . $count . ')' : $label,
		'parent' => 'site-name',
		'href'   => get_admin_url() . '?clear-transients=1',
	);

	$wp_admin_bar->add_node( $args );

}

// add_action( 'admin_bar_menu', 'bfg_cron_count_node', 99 );
/**
 * Show the length of the scheduled cron task list.
 *
 * @since 2.3.15
 */
function bfg_cron_count_node( $wp_admin_bar ) {

	if( !is_admin() || !current_user_can('manage_options') )
		return;

	$count = get_option( 'cron' );
	$count = count($count);
	if( 0 === $count )
		return;

	$label = __( 'Cron Tasks:', CHILD_THEME_TEXT_DOMAIN );
	$args  = array(
		'id'    => 'cron-task-count',
		'title' => !empty($count) ? $label . ' ' . $count : $label,
	);

	$wp_admin_bar->add_node( $args );

}
