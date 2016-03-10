<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Cleanup <head>
 *
 * @since 2.0.0
 */
remove_action( 'wp_head', 'rsd_link' );									// RSD link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );				// Parent rel link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );				// Start post rel link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );	// Adjacent post rel link
remove_action( 'wp_head', 'wp_generator' );								// WP Version
remove_action( 'wp_head', 'wlwmanifest_link');							// WLW Manifest
// remove_action( 'wp_head', 'feed_links', 2 ); 						// Remove feed links
remove_action( 'wp_head', 'feed_links_extra', 3 ); 						// Remove comment feed links

// Remove WP-API <head> material
// See: https://wordpress.stackexchange.com/questions/211467/remove-json-api-links-in-header-html
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'bfg_do_doctype' );
/**
 * Overrides the default Genesis doctype with IE and JS identifier classes.
 *
 * See: http://html5boilerplate.com/
 *
 * @since 2.2.4
 */
function bfg_do_doctype() {

	if( genesis_html5() ) {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes( 'html' ); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes( 'html' ); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php
	} else {
		genesis_xhtml_doctype();
	}

}

add_action( 'wp_head', 'bfg_fetch_dns', 1 );
/**
 * Prefetch the DNS for external resource domains. Better browser support than preconnect.
 *
 * See: https://www.igvita.com/2015/08/17/eliminating-roundtrips-with-preconnect/
 *
 * @since 2.3.19
 */
function bfg_fetch_dns() {

	$hrefs = array(
		'//ajax.googleapis.com',
		// '//fonts.googleapis.com'
	);

	foreach( $hrefs as $href )
		echo '<link rel="dns-prefetch" href="' . $href . '">' . "\n";

}

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
remove_action( 'wp_enqueue_scripts', 'genesis_register_scripts' );
add_action( 'wp_enqueue_scripts', 'bfg_load_assets' );
/**
 * Overrides the default Genesis stylesheet with child theme specific CSS and JS.
 *
 * Only load these styles on the front-end.
 *
 * @since 2.0.0
 */
function bfg_load_assets() {

	$use_production_assets = genesis_get_option('bfg_production_on');
	$use_production_assets = !empty($use_production_assets);

	$assets_version = genesis_get_option('bfg_assets_version');
	$assets_version = !empty($assets_version) ? absint($assets_version) : null;

	$stylesheet_dir = get_stylesheet_directory_uri();

	// Main theme stylesheet
	$src = $use_production_assets ? '/build/css/style.min.css' : '/build/css/style.css';
	wp_enqueue_style( 'bfg', $stylesheet_dir . $src, array(), $assets_version );

	// Disable the 'Open Sans' loaded by the admin bar
	// https://wordpress.org/support/topic/remove-open-sans-and-add-custom-fonts
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );

	// Google Fonts
	// Consider async loading: https://github.com/typekit/webfontloader
 	// wp_enqueue_style(
 	// 	'google-fonts',
 	// 	'//fonts.googleapis.com/css?family=Open+Sans:300,400,700%7CLato',		// Open Sans (light, normal, and bold) and Lato regular, for example
 	// 	array(),
 	// 	null
 	// );

 	// Dequeue comment-reply if no active comments on page
	if( ( is_single() || is_page() || is_attachment() ) && comments_open() & (int) get_option( 'thread_comments' ) === 1 && !is_front_page() ) {
		wp_enqueue_script( 'comment-reply' );
	} else {
		wp_dequeue_script( 'comment-reply' );
	}

	// Override WP default self-hosted jQuery with version from Google's CDN
	wp_deregister_script( 'jquery' );
	$src = $use_production_assets ? '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js' : '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.js';
	wp_register_script( 'jquery', $src, array(), null, true );
	add_filter( 'script_loader_src', 'bfg_jquery_local_fallback', 10, 2 );

	// Main script file (in footer)
	$src = $use_production_assets ? '/build/js/scripts.min.js' : '/build/js/scripts.js';
	wp_enqueue_script( 'bfg', $stylesheet_dir . $src, array('jquery'), $assets_version, true );
	wp_localize_script(
		'bfg',
		'grunticon_paths',
		array(
			'svg'      => $stylesheet_dir . '/build/svgs/icons.data.svg.css',
			'png'      => $stylesheet_dir . '/build/svgs/icons.data.png.css',
			'fallback' => $stylesheet_dir . '/build/svgs/icons.fallback.css',
		)
	);
	// wp_localize_script( 'bfg', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}

add_filter( 'script_loader_tag', 'bfg_ie_script_conditionals', 10, 3 );
/**
 * Conditionally load jQuery v1 on old IE.
 *
 * @since 2.3.1
 */
function bfg_ie_script_conditionals( $tag, $handle, $src ) {

	if( 'jquery' === $handle ) {
		$output = '<!--[if !IE]> -->' . "\n" . $tag . '<!-- <![endif]-->' . "\n";
		$output .= '<!--[if gt IE 8]>' . "\n" . $tag . '<![endif]-->' . "\n";

		$use_production_assets = genesis_get_option('bfg_production_on');
		$use_production_assets = !empty($use_production_assets);
		$src                   = $use_production_assets ? '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js' : '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js';
		$fallback_script       = '<script type="text/javascript" src="' . $src . '"></script>';
		$output .= '<!--[if lte IE 8]>' . "\n" . $fallback_script . '<![endif]-->' . "\n";
	} else {
		$output = $tag;
	}

	return $output;

}

/*
 * jQuery local fallback, if Google CDN is unreachable
 *
 * See: https://github.com/roots/roots/blob/aa59cede7fbe2b853af9cf04e52865902d2ff1a9/lib/scripts.php#L37-L52
 *
 * @since 2.0.20
 */
add_action( 'wp_head', 'bfg_jquery_local_fallback' );
function bfg_jquery_local_fallback( $src, $handle = null ) {

	static $add_jquery_fallback = false;

	if( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . includes_url() . 'js/jquery/jquery.js"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if( $handle === 'jquery' ) {
		$add_jquery_fallback = true;
	}

	return $src;

}

// add_filter( 'genesis_pre_load_favicon', 'bfg_pre_load_favicon' );
/**
 * Simple favicon override to specify your favicon's location.
 *
 * @since 2.0.0
 */
function bfg_pre_load_favicon() {

	return get_stylesheet_directory_uri() . '/images/favicon.ico';

}

remove_action( 'wp_head', 'genesis_load_favicon' );
// add_action( 'wp_head', 'bfg_load_favicons' );
/**
 * Show the best favicon, within reason.
 *
 * See: http://www.jonathantneal.com/blog/understand-the-favicon/
 *
 * @since 2.0.4
 */
function bfg_load_favicons() {

	$stylesheet_dir     = get_stylesheet_directory_uri();
	$favicon_path       = $stylesheet_dir . '/images/favicons';
	$favicon_build_path = $stylesheet_dir . '/build/images/favicons';

	// Set to false to disable, otherwise set to a hex color
	$color = false;

	// Use a 192px X 192px PNG for the homescreen for Chrome on Android
	echo '<link rel="icon" type="image/png" href="' . $favicon_build_path . '/favicon-192.png" sizes="192x192">';

	// Use a 180px X 180px PNG for the latest iOS devices, also setup app styles
	echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $favicon_build_path . '/favicon-180.png">';

	// Give IE <= 9 the old favicon.ico (16px X 16px)
	echo '<!--[if IE]><link rel="shortcut icon" href="' . $favicon_path . '/favicon.ico"><![endif]-->';

	// Use a 144px X 144px PNG for Windows tablets
	echo '<meta name="msapplication-TileImage" content="' . $favicon_build_path . '/favicon-144.png">';

	if( false !== $color ) {
		// Windows icon background color
		echo '<meta name="msapplication-TileColor" content="' . $color . '">';

		// Chrome for Android taskbar color
		echo '<meta name="theme-color" content="' . $color . '">';

		// Safari 9 pinned tab color
		echo '<link rel="mask-icon" href="' . $favicon_build_path . '/favicon.svg" color="' . $color . '">';
	}

}

/*
 * Remove the header
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_header', 'genesis_do_header' );

/*
 * Remove the site title and/or description
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

