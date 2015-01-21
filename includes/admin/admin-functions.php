<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'pre_ping', 'bfg_disable_self_pings' );
/**
 * Prevent the child theme from being overwritten by a WordPress.org theme with the same name.
 *
 * See: http://wp-snippets.com/disable-self-trackbacks/
 *
 * @since 2.0.0
 */
function bfg_disable_self_pings( &$links ) {

	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, home_url() ) )
			unset($links[$l]);

}

/**
 * Change WP JPEG compression (WP default is 90%)
 *
 * See: http://wpmu.org/how-to-change-jpeg-compression-in-wordpress/
 *
 * @since 2.0.14
 */
// add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

/**
 * Add new image sizes
 *
 * See: http://wptheming.com/2014/04/features-wordpress-3-9/
 *
 * @since 2.0.0
 */
// add_image_size( 'desktop-size', 1024, 768, array( 'left', 'top' ) ); // Crop positions are: top, left, right, bottom, center

// add_filter( 'image_size_names_choose', 'bfg_image_size_names_choose' );
/**
 * Add new image sizes to media size selection menu
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function bfg_image_size_names_choose( $sizes ) {

	$sizes['desktop-size'] = 'Desktop';
	return $sizes;

}

/**
 * List available image sizes with width and height
 *
 * See: http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 *
 * @since 2.2.24
 */
function get_image_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {
		if( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			$sizes[$_size]['width'] = get_option( $_size . '_size_w' );
			$sizes[$_size]['height'] = get_option( $_size . '_size_h' );
			$sizes[$_size]['crop'] = (bool) get_option( $_size . '_crop' );
		} elseif ( isset( $_wp_additional_image_sizes[$_size] ) ) {
			$sizes[$_size] = array(
				'width' => $_wp_additional_image_sizes[$_size]['width'],
				'height' => $_wp_additional_image_sizes[$_size]['height'],
				'crop' => $_wp_additional_image_sizes[$_size]['crop']
			);
		}
	}

	// Get only 1 size if found
	if( $size )
		return isset($sizes[$size]) ? $sizes[$size] : false;

	return $sizes;

}

/**
 * Activate the Link Manager
 *
 * See: http://wordpressexperts.net/how-to-activate-link-manager-in-wordpress-3-5/
 *
 * @since 2.0.1
 */
// add_filter( 'pre_option_link_manager_enabled', '__return_true' );		// Activate

/**
 * Disable pingbacks
 *
 * See: http://wptavern.com/how-to-prevent-wordpress-from-participating-in-pingback-denial-of-service-attacks
 *
 * Still having pingback/trackback issues? This post might help: https://wordpress.org/support/topic/disabling-pingbackstrackbacks-on-pages#post-4046256
 *
 * @since 2.2.3
 */
add_filter( 'xmlrpc_methods', 'bfg_remove_xmlrpc_pingback_ping' );
function bfg_remove_xmlrpc_pingback_ping( $methods ) {

	unset($methods['pingback.ping']);
	return $methods;

};

/**
 * Disable XML-RPC
 *
 * See: https://wordpress.stackexchange.com/questions/78780/xmlrpc-enabled-filter-not-called
 *
 * @since 2.2.12
 */
// if( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) exit;
