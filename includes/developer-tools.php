<?php
add_action( 'wp_footer', 'bfg_query_stats' );
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