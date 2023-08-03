<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_action( 'admin_enqueue_scripts', 'bfg_load_admin_assets' );
/**
 * Enqueue admin CSS and JS files.
 *
 * @since 2.3.2
 */
function bfg_load_admin_assets() {

	$stylesheet_dir = get_stylesheet_directory_uri();

	$src     = BFG_PRODUCTION ? '/build/css/admin.min.css' : '/build/css/admin.css';
	$version = file_exists(CHILD_DIR . $src) ? filemtime(CHILD_DIR . $src) : null;
	wp_enqueue_style( 'bfg-admin', $stylesheet_dir . $src, array(), $version );

	$src     = BFG_PRODUCTION ? '/build/js/admin.min.js' : '/build/js/admin.js';
	$version = file_exists(CHILD_DIR . $src) ? filemtime(CHILD_DIR . $src) : null;
	wp_enqueue_script( 'bfg-admin', $stylesheet_dir . $src, array('jquery'), $version, true );

}

add_filter( 'image_editor_output_format', 'bfg_image_editor_output_format' );
/*
 * Use webP images
 *
 * @since 20210728
 */
function bfg_image_editor_output_format($formats) {

	$formats['image/jpg'] = 'image/webp';

	return $formats;

}

// add_filter( 'upload_mimes', 'bfg_enable_svg_uploads', 10, 1 );
/**
 * Enabled SVG uploads. Note that this could be a security issue, see: https://bjornjohansen.no/svg-in-wordpress.
 *
 * @since 2.3.38
 */
function bfg_enable_svg_uploads($mimes) {

	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';

	return $mimes;

}

/**
 * Disable the WP image size limitation. Better handled by Imsanity.
 *
 * @since 20230803
 */
add_filter( 'big_image_size_threshold', '__return_false' );

/*
 * Disable XML-RPC
 *
 * See: https://wordpress.stackexchange.com/questions/78780/xmlrpc-enabled-filter-not-called
 *
 * @since 2.2.12
 */
if( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) exit;

/*
 * Force secure cookie
 *
 * @since 20170608
 */
add_filter( 'secure_signon_cookie', '__return_true' );

/*
 * Prevent non-SSL HTTP origins.
 *
 * @since 20180604
 */
add_filter( 'allowed_http_origins', 'bfg_allowed_http_origins' );
function bfg_allowed_http_origins($allowed_origins) {

	$whitelisted_origins = array();
	foreach( $allowed_origins as $origin ) {
		$url = parse_url($origin);
		if( $url['scheme'] !== 'https' )
			continue;

		$whitelisted_origins[] = $origin;
	}

	return $whitelisted_origins;

}

/*
 * Disable recovery mode emails.
 *
 * @since 20200420
 */
add_filter( 'recovery_mode_email', 'bfg_disable_recovery_mode_emails', 10, 2 );
function bfg_disable_recovery_mode_emails($email, $url) {

	$email['to'] = '';

	return $email;

}

/*
 * Disable admin email verification
 *
 * @since 20200601
 */
add_filter( 'admin_email_check_interval', '__return_false' );

/*
 * Disable auto-update email notifications for plugins.
 *
 * @since 20200811
 */
add_filter( 'auto_plugin_update_send_email', '__return_false' );

/*
 * Disable auto-update email notifications for themes.
 *
 * @since 20200811
 */
add_filter( 'auto_theme_update_send_email', '__return_false' );
