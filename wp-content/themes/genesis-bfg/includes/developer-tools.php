<?php
/**
 * Admin bar tools for developers: clear transients and orphaned meta rows.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Process the developer tool actions (clear all transients, clear orphaned
 * postmeta/usermeta/termmeta rows), then redirect back so a refresh doesn't
 * re-run the action.
 *
 * @since 2.2.9
 *
 * @return void
 */
add_action( 'admin_init', 'bfg_handle_developer_tools' );
function bfg_handle_developer_tools() {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	global $wpdb;

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- check_admin_referer() runs as part of this same condition, gating the isset() check before it
	if ( isset( $_GET['clear-transients'] ) && 1 === (int) $_GET['clear-transients'] && check_admin_referer( 'bfg_clear_transients' ) ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- static maintenance query with no user input, triggered manually by an admin; caching doesn't apply to a cache-clearing operation
		$wpdb->query( "DELETE FROM `{$wpdb->options}` WHERE `option_name` LIKE ('_transient_%') OR `option_name` LIKE ('_site_transient_%')" );
		wp_cache_flush();

		wp_safe_redirect( add_query_arg( 'bfg-cleared', 'transients', remove_query_arg( array( 'clear-transients', '_wpnonce' ) ) ) );
		exit;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- see note above
	if ( isset( $_GET['clear-orphans'] ) && 1 === (int) $_GET['clear-orphans'] && check_admin_referer( 'bfg_clear_orphans' ) ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- static maintenance query with no user input, triggered manually by an admin; caching doesn't apply to a cache-clearing operation
		$wpdb->query( "DELETE pm FROM `{$wpdb->postmeta}` pm LEFT JOIN `{$wpdb->posts}` wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL;" );
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- same as above
		$wpdb->query( "DELETE um FROM `{$wpdb->usermeta}` um LEFT JOIN `{$wpdb->users}` wp ON wp.ID = um.user_id WHERE wp.ID IS NULL;" );
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- same as above
		$wpdb->query( "DELETE tm FROM `{$wpdb->termmeta}` tm LEFT JOIN `{$wpdb->terms}` wp ON wp.term_id = tm.term_id WHERE wp.term_id IS NULL;" );

		wp_safe_redirect( add_query_arg( 'bfg-cleared', 'orphans', remove_query_arg( array( 'clear-orphans', '_wpnonce' ) ) ) );
		exit;
	}
}

/**
 * Add admin bar nodes to clear all transients and to clear orphaned meta rows
 * (postmeta, usermeta, termmeta) with one click.
 *
 * @since 2.2.9
 *
 * @param WP_Admin_Bar $wp_admin_bar The admin bar object, passed by reference.
 *
 * @return void
 */
add_action( 'admin_bar_menu', 'bfg_developer_tools_nodes', 99 );
function bfg_developer_tools_nodes( $wp_admin_bar ) {

	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
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
 *
 * @return void
 */
add_action( 'admin_notices', 'bfg_developer_tools_notices' );
function bfg_developer_tools_notices() {

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- displays a static confirmation message only; the action itself was nonce-checked before the redirect that set this arg
	$cleared = isset( $_GET['bfg-cleared'] ) ? sanitize_key( wp_unslash( $_GET['bfg-cleared'] ) ) : '';

	if ( 'transients' === $cleared ) {
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Transients have been deleted.', 'bfg' ) . '</p></div>';
	} elseif ( 'orphans' === $cleared ) {
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Orphaned metadata has been deleted.', 'bfg' ) . '</p></div>';
	}
}
