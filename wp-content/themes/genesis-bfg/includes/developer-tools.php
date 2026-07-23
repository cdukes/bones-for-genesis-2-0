<?php
/**
 * Admin bar tools for developers: clear transients and orphaned meta rows.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'admin_bar_menu', 'bfg_clear_transients_node', 99 );
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
function bfg_clear_transients_node( $wp_admin_bar ) {

	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	global $wpdb;

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- check_admin_referer() runs as part of this same condition, gating the isset() check before it
	if ( isset( $_GET['clear-transients'] ) && 1 === (int) $_GET['clear-transients'] && check_admin_referer( 'bfg_clear_transients' ) ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- static maintenance query with no user input, triggered manually by an admin; caching doesn't apply to a cache-clearing operation
		$wpdb->query( "DELETE FROM `{$wpdb->options}` WHERE `option_name` LIKE ('_transient_%') OR `option_name` LIKE ('_site_transient_%')" );
		wp_cache_flush();
		add_action( 'admin_notices', 'bfg_transients_cleared_notice' );
	}

	if ( isset( $_GET['clear-orphans'] ) && 1 === (int) $_GET['clear-orphans'] && check_admin_referer( 'bfg_clear_orphans' ) ) {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- static maintenance query with no user input, triggered manually by an admin; caching doesn't apply to a cache-clearing operation
		$wpdb->query( "DELETE pm FROM `{$wpdb->postmeta}` pm LEFT JOIN `{$wpdb->posts}` wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL;" );
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- same as above
		$wpdb->query( "DELETE um FROM `{$wpdb->usermeta}` um LEFT JOIN `{$wpdb->users}` wp ON wp.ID = um.user_id WHERE wp.ID IS NULL;" );
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- same as above
		$wpdb->query( "DELETE tm FROM `{$wpdb->termmeta}` tm LEFT JOIN `{$wpdb->terms}` wp ON wp.term_id = tm.term_id WHERE wp.term_id IS NULL;" );
		add_action( 'admin_notices', 'bfg_orphans_cleared_notice' );
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
 * Show an admin notice when transients are cleared.
 *
 * @since 20170625
 *
 * @return void
 */
function bfg_transients_cleared_notice() {

	?>
	<div class="updated">
		<p>Transients have been deleted.</p>
	</div>
	<?php
}

/**
 * Show an admin notice when orphans are cleared.
 *
 * @since 20180604
 *
 * @return void
 */
function bfg_orphans_cleared_notice() {

	?>
	<div class="updated">
		<p>Orphaned metadata has been deleted.</p>
	</div>
	<?php
}
