<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'admin_bar_menu', 'bfg_clear_transients_node', 99 );
/**
 * Clear all transients with one click.
 *
 * @since 2.2.9
 */
function bfg_clear_transients_node($wp_admin_bar) {

	if( !is_admin() || !current_user_can('manage_options') )
		return;

	global $wpdb;

	if( isset($_GET['clear-transients']) && 1 === (int) $_GET['clear-transients'] ) {
		$wpdb->query( "DELETE FROM `{$wpdb->options}` WHERE `option_name` LIKE ('_transient_%') OR `option_name` LIKE ('_site_transient_%')" );
		wp_cache_flush();
		add_action( 'admin_notices', 'bfg_transients_cleared_notice' );
	}

	if( isset($_GET['clear-orphans']) && 1 === (int) $_GET['clear-orphans'] ) {
		$wpdb->query( "DELETE pm FROM `{$wpdb->postmeta}` pm LEFT JOIN `{$wpdb->posts}` wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL;" );
		// $wpdb->query( "DELETE um FROM `$wpdb->usermeta` um LEFT JOIN `$wpdb->users` wp ON wp.ID = um.user_id WHERE wp.ID IS NULL;" );
		add_action( 'admin_notices', 'bfg_orphans_cleared_notice' );
	}

	$args = array(
		'id'     => 'clear-transients',
		'title'  => __( 'Clear Transients', CHILD_THEME_TEXT_DOMAIN ),
		'parent' => 'site-name',
		'href'   => get_admin_url() . '?clear-transients=1',
	);

	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'     => 'clear-orphans',
		'title'  => __( 'Clear Orphaned Metadata', CHILD_THEME_TEXT_DOMAIN ),
		'parent' => 'site-name',
		'href'   => get_admin_url() . '?clear-orphans=1',
	);

	$wp_admin_bar->add_node( $args );
}

/**
 * Show an admin notice when transients are cleared.
 *
 * @since 20170625
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
 */
function bfg_orphans_cleared_notice() {

	?>
	<div class="updated">
		<p>Orphaned metadata has been deleted.</p>
	</div>
	<?php

}
