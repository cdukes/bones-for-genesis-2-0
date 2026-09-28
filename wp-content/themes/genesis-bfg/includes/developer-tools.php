<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Process the developer tool actions (clear all transients, clear orphaned
 * postmeta/usermeta/termmeta rows), then redirect back so a refresh doesn't
 * re-run the action.
 *
 * @since 2.2.9
 */
add_action( 'admin_init', 'bfg_handle_developer_tools' );
function bfg_handle_developer_tools() {

	if ( !current_user_can( 'manage_options' ) ) {
		return;
	}

	global $wpdb;

	if ( isset( $_GET['clear-transients'] ) && (int) $_GET['clear-transients'] === 1 && check_admin_referer( 'bfg_clear_transients' ) ) {
		$wpdb->query( "DELETE FROM `{$wpdb->options}` WHERE `option_name` LIKE ('_transient_%') OR `option_name` LIKE ('_site_transient_%')" );
		wp_cache_flush();

		wp_safe_redirect( add_query_arg( 'bfg-cleared', 'transients', remove_query_arg( array('clear-transients', '_wpnonce') ) ) );
		exit;
	}

	if ( isset( $_GET['clear-orphans'] ) && (int) $_GET['clear-orphans'] === 1 && check_admin_referer( 'bfg_clear_orphans' ) ) {
		$wpdb->query( "DELETE pm FROM `{$wpdb->postmeta}` pm LEFT JOIN `{$wpdb->posts}` wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL;" );
		$wpdb->query( "DELETE um FROM `{$wpdb->usermeta}` um LEFT JOIN `{$wpdb->users}` wp ON wp.ID = um.user_id WHERE wp.ID IS NULL;" );
		$wpdb->query( "DELETE tm FROM `{$wpdb->termmeta}` tm LEFT JOIN `{$wpdb->terms}` wp ON wp.term_id = tm.term_id WHERE wp.term_id IS NULL;" );

		wp_safe_redirect( add_query_arg( 'bfg-cleared', 'orphans', remove_query_arg( array('clear-orphans', '_wpnonce') ) ) );
		exit;
	}
}

/**
 * Add admin bar nodes to clear all transients and to clear orphaned meta rows
 * (postmeta, usermeta, termmeta) with one click.
 *
 * @since 2.2.9
 */
add_action( 'admin_bar_menu', 'bfg_developer_tools_nodes', 99 );
function bfg_developer_tools_nodes($wp_admin_bar) {

	if ( !is_admin() || !current_user_can( 'manage_options' ) ) {
		return;
	}

	$args = array(
		'id'     => 'clear-transients',
		'title'  => __( 'Clear Transients', 'bfg' ),
		'parent' => 'site-name',
		'href'   => wp_nonce_url( add_query_arg( 'clear-transients', 1, get_admin_url() ), 'bfg_clear_transients' ),
	);

	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'     => 'clear-orphans',
		'title'  => __( 'Clear Orphaned Metadata', 'bfg' ),
		'parent' => 'site-name',
		'href'   => wp_nonce_url( add_query_arg( 'clear-orphans', 1, get_admin_url() ), 'bfg_clear_orphans' ),
	);

	$wp_admin_bar->add_node( $args );
}

/**
 * Show a confirmation notice after a developer tool action completes.
 *
 * @since 20170625
 */
add_action( 'admin_notices', 'bfg_developer_tools_notices' );
function bfg_developer_tools_notices() {

	$cleared = isset( $_GET['bfg-cleared'] ) ? sanitize_key( wp_unslash( $_GET['bfg-cleared'] ) ) : '';

	if ( $cleared === 'transients' ) {
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Transients have been deleted.', 'bfg' ) . '</p></div>';
	} elseif ( $cleared === 'orphans' ) {
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Orphaned metadata has been deleted.', 'bfg' ) . '</p></div>';
	}
}
