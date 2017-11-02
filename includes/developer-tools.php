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
		$wpdb->query( "DELETE FROM `$wpdb->options` WHERE `option_name` LIKE ('_transient_%') OR `option_name` LIKE ('_site_transient_%')" );
		wp_cache_flush();
		add_action( 'admin_notices', 'bfg_transients_cleared_notice' );
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
