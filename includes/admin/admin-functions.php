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

	$src = BFG_PRODUCTION ? '/build/css/admin.min.css' : '/build/css/admin.css';
	wp_enqueue_style( 'bfg-admin', $stylesheet_dir . $src, array(), BFG_VERSION );

	$src = BFG_PRODUCTION ? '/build/js/admin.min.js' : '/build/js/admin.js';
	wp_enqueue_script( 'bfg-admin', $stylesheet_dir . $src, array('jquery'), BFG_VERSION, true );

}

add_action( 'pre_ping', 'bfg_disable_self_pings' );
/**
 * Prevent the child theme from being overwritten by a WordPress.org theme with the same name.
 *
 * See: http://wp-snippets.com/disable-self-trackbacks/
 *
 * @since 2.0.0
 */
function bfg_disable_self_pings(&$links) {

	foreach ( $links as $l => $link )
		if ( 0 === mb_strpos( $link, home_url() ) )
			unset($links[$l]);

}

/**
 * Change WP JPEG compression (WP default is 90%).
 *
 * See: http://wpmu.org/how-to-change-jpeg-compression-in-wordpress/
 *
 * @since 2.0.14
 */
// add_filter( 'jpeg_quality', 'bfg_set_jpeg_quality' );
function bfg_set_jpeg_quality() {

	return 80;

}

/**
 * Disable srcset.
 *
 * @since 20200420
 */
// add_filter( 'wp_calculate_image_srcset', '__return_false' );

/**
 * Disable lazy loading.
 *
 * @since 20200811
 */
// add_filter( 'wp_lazy_loading_enabled', '__return_false' );

/**
 * Add new image sizes.
 *
 * See: http://wptheming.com/2014/04/features-wordpress-3-9/
 *
 * @since 2.0.0
 */
// add_image_size( 'desktop-size', 1024, 768, array( 'left', 'top' ) ); // Crop positions are: top, left, right, bottom, center

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

// add_filter( 'image_size_names_choose', 'bfg_image_size_names_choose' );
/**
 * Add new image sizes to media size selection menu.
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function bfg_image_size_names_choose($sizes) {

	$sizes['desktop-size'] = __( 'Desktop', CHILD_THEME_TEXT_DOMAIN );

	return $sizes;

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
function bfg_remove_xmlrpc_pingback_ping($methods) {

	unset($methods['pingback.ping']);

	return $methods;

}

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

/*
 * Force secure cookie
 *
 * @since 20170608
 */
add_filter( 'secure_signon_cookie', '__return_true' );

/*
 * Prevent login with username (email only).
 *
 * @since 20180604
 */
// remove_filter( 'authenticate', 'wp_authenticate_username_password', 20 );

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
		if( 'https' !== $url['scheme'] )
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
