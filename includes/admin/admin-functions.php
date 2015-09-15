<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_action( 'admin_enqueue_scripts', 'bfg_load_admin_assets' );
/**
 * Enqueue admin CSS and JS files.
 *
 * @since 2.3.2
 */
function bfg_load_admin_assets() {

	$stylesheet_dir        = get_stylesheet_directory_uri();
	$use_production_assets = genesis_get_option('bfg_production_on');
	$use_production_assets = !empty($use_production_assets);

	$src = $use_production_assets ? '/build/css/admin.min.css' : '/build/css/admin.css';
	wp_enqueue_style( 'bfg-admin', $stylesheet_dir . $src, array(), null );

	$src = $use_production_assets ? '/build/js/admin.min.js' : '/build/js/admin.js';
	wp_enqueue_script( 'bfg-admin', $stylesheet_dir . $src, array('jquery'), null, true );

}

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
 * Change WP JPEG compression (WP default is 90%).
 *
 * See: http://wpmu.org/how-to-change-jpeg-compression-in-wordpress/
 *
 * @since 2.0.14
 */
// add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

/**
 * Add new image sizes.
 *
 * See: http://wptheming.com/2014/04/features-wordpress-3-9/
 *
 * @since 2.0.0
 */
// add_image_size( 'desktop-size', 1024, 768, array( 'left', 'top' ) ); // Crop positions are: top, left, right, bottom, center

// add_filter( 'image_size_names_choose', 'bfg_image_size_names_choose' );
/**
 * Add new image sizes to media size selection menu.
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function bfg_image_size_names_choose( $sizes ) {

	$sizes['desktop-size'] = __( 'Desktop', CHILD_THEME_TEXT_DOMAIN );

	return $sizes;

}

/**
 * List available image sizes with width and height.
 *
 * See: http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 *
 * @since 2.2.24
 */
function bfg_get_image_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array();

	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {
		if( in_array( $_size, array('thumbnail', 'medium', 'large'), true ) ) {
			$sizes[$_size]['width']  = get_option( $_size . '_size_w' );
			$sizes[$_size]['height'] = get_option( $_size . '_size_h' );
			$sizes[$_size]['crop']   = (bool) get_option( $_size . '_crop' );
		} elseif ( isset( $_wp_additional_image_sizes[$_size] ) ) {
			$sizes[$_size] = array(
				'width'  => $_wp_additional_image_sizes[$_size]['width'],
				'height' => $_wp_additional_image_sizes[$_size]['height'],
				'crop'   => $_wp_additional_image_sizes[$_size]['crop'],
			);
		}
	}

	// Get only 1 size if found
	if( $size )
		return isset($sizes[$size]) ? $sizes[$size] : false;

	return $sizes;

}

/*
 * Downsize the original uploaded image if it's too large
 *
 * See: https://wordpress.stackexchange.com/questions/63707/automatically-replace-original-uploaded-image-with-large-image-size
 *
 * @since 2.3.6
 */
// add_filter( 'wp_generate_attachment_metadata', 'bfg_downsize_uploaded_image', 99 );
function bfg_downsize_uploaded_image( $image_data ) {

	$max_image_size_name = 'large';

	// Abort if no max image
	if( !isset($image_data['sizes'][$max_image_size_name]) )
		return $image_data;

	// paths to the uploaded image and the max image
	$upload_dir              = wp_upload_dir();
	$uploaded_image_location = $upload_dir['basedir'] . '/' . $image_data['file'];
	$max_image_location      = $upload_dir['path'] . '/' . $image_data['sizes'][$max_image_size_name]['file'];

	// Delete original image
	unlink($uploaded_image_location);

	// Rename max image to original image
	rename( $max_image_location, $uploaded_image_location );

	// Update and return image metadata
	$image_data['width']  = $image_data['sizes'][$max_image_size_name]['width'];
	$image_data['height'] = $image_data['sizes'][$max_image_size_name]['height'];
	unset($image_data['sizes'][$max_image_size_name]);

	return $image_data;

}

/*
 * Activate the Link Manager
 *
 * See: http://wordpressexperts.net/how-to-activate-link-manager-in-wordpress-3-5/
 *
 * @since 2.0.1
 */
// add_filter( 'pre_option_link_manager_enabled', '__return_true' );		// Activate

/*
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

/*
 * Disable XML-RPC
 *
 * See: https://wordpress.stackexchange.com/questions/78780/xmlrpc-enabled-filter-not-called
 *
 * @since 2.2.12
 */
if( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) exit;

/*
 * Automatically remove readme.html (and optionally xmlrpc.php) after a WP core update
 *
 * @since 2.2.26
 */
add_action( '_core_updated_successfully', 'bfg_remove_files_on_upgrade' );
function bfg_remove_files_on_upgrade() {

	if( file_exists(ABSPATH . 'readme.html') )
		unlink(ABSPATH . 'readme.html');

	if( file_exists(ABSPATH . 'xmlrpc.php') )
		unlink(ABSPATH . 'xmlrpc.php');

}
