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
add_filter( 'the_generator', '__return_false' ); 						// WP Version (other locations)
remove_action( 'wp_head', 'wlwmanifest_link');							// WLW Manifest
// remove_action( 'wp_head', 'feed_links', 2 ); 						// Remove feed links
remove_action( 'wp_head', 'feed_links_extra', 3 );						// Remove comment feed links
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );				// Remove shortlink

// Remove WP-API <head> material
// See: https://wordpress.stackexchange.com/questions/211467/remove-json-api-links-in-header-html
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

add_action( 'wp', 'bfg_security_headers' );
/**
 * Prevent other sites from embedding this one in an iFrame, and prevents MIME type spoofing.
 *
 * @since 2.3.56
 */
function bfg_security_headers() {

	if( is_admin() )
		return;

	header( 'X-Frame-Options: DENY' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-XSS-Protection: 1; mode=block' );

	// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy
	// May break services that use a referrer check, such as typography.com and Google's APIs
	// header( 'Referrer-Policy: same-origin' );

	// Strict-Transport-Security: https://www.owasp.org/index.php/HTTP_Strict_Transport_Security_Cheat_Sheet (example not included here to avoid accidental activation)

}

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'bfg_do_doctype' );
/**
 * Overrides the default Genesis doctype.
 *
 * See: http://html5boilerplate.com/
 *
 * @since 2.2.4
 */
function bfg_do_doctype() {

?>
<!DOCTYPE html>
<html class="<?php echo is_admin_bar_showing() ? 'admin-bar-showing' : ''; ?>" <?php language_attributes( 'html' ); ?>>
<head <?php echo genesis_attr( 'head' ); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="format-detection" content="telephone=no">
<?php

}

add_filter( 'wp_resource_hints', 'bfg_resource_hints', 10, 2 );
/**
 * Prefetch the DNS for external resource domains. Better browser support than preconnect.
 *
 * See: https://www.igvita.com/2015/08/17/eliminating-roundtrips-with-preconnect/
 *
 * @since 2.3.19
 */
function bfg_resource_hints($hints, $relation_type) {

	if( 'dns-prefetch' === $relation_type ) {
		$hints[] = '//cdn.polyfill.io';
		$hints[] = '//cdnjs.cloudflare.com';
		// $hints[] = '//fonts.googleapis.com';
	}

	return $hints;

}

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
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

	// Google Fonts
	// Consider async loading: https://github.com/typekit/webfontloader
	// wp_enqueue_style(
	// 	'google-fonts',
	// 	'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7CLato',		// Open Sans (light, normal, and bold) and Lato regular, for example
	// 	array(),
	// 	null
	// );

	// Register polyfill.io with default options
	$src = $use_production_assets ? 'https://cdn.polyfill.io/v2/polyfill.min.js?features=default-3.6,fetch' : 'https://cdn.polyfill.io/v2/polyfill.js?features=default-3.6,fetch';
	wp_register_script( 'polyfill', $src, array(), null, true );

	// Use jQuery from a CDN
	wp_deregister_script( 'jquery' );
	$src = $use_production_assets ? 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' : 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js';
	wp_register_script( 'jquery', $src, array(), null, false );

	// Dequeue Genesis's scripts
	wp_dequeue_script( 'html5shiv' );
	wp_dequeue_script( 'skip-links' );
	wp_dequeue_script( 'superfish' );
	wp_dequeue_script( 'superfish-args' );

	// Main script file (in footer)
	$src = $use_production_assets ? '/build/js/scripts.min.js' : '/build/js/scripts.js';
	wp_enqueue_script( 'bfg', $stylesheet_dir . $src, array('polyfill'), $assets_version, true );

	// Add scripts which can be used by the _loader.js module here
	$on_demand_script_srcs = array(
		'svgxuse' => array(
			'src' => $use_production_assets ? 'https://cdnjs.cloudflare.com/ajax/libs/svgxuse/1.2.6/svgxuse.min.js' : 'https://cdnjs.cloudflare.com/ajax/libs/svgxuse/1.2.6/svgxuse.js',
			'sri' => $use_production_assets ? 'sha256-+xblFIDxgSu6OfR6TdLhVHZzVrhw8eXiVk8PRi9ACY8=' : 'sha256-TU+njGBu7T1DrfKgOBEH7kCKsl7UEvUNzpZaeUNNGi8=',
		),
	);
	wp_localize_script( 'bfg', 'bfg_script_srcs', $on_demand_script_srcs );

	$icon_src = add_query_arg(
		array(
			'v' => $assets_version,
		),
		$stylesheet_dir . '/build/svgs/icons.svg'
	);

	wp_localize_script( 'bfg', 'bfg_icons_src', $icon_src );

}

add_action( 'wp_footer', 'bfg_inject_script', 1 );
/**
 * Inject a JS script loader function.
 *
 * See: https://www.html5rocks.com/en/tutorials/speed/script-loading/
 *
 * @since 20170815
 */
function bfg_inject_script() {

	?>
	<script>
		window.bfg_inject_script = function( src ) {
			var script = document.createElement('script');
			script.src = src;
			script.async = false;
			document.head.appendChild(script);
		};
	</script>
	<?php

}

add_filter('script_loader_tag', 'bfg_script_loader_tags', 10, 3);
/**
 * Overwrite the <script> tag on selected assets to use the JS loader.
 *
 * See: https://www.html5rocks.com/en/tutorials/speed/script-loading/
 *
 * @since 20170815
 */
function bfg_script_loader_tags($tag, $handle, $src) {

	$tag = str_replace(" type='text/javascript'", '', $tag);

	switch( $handle ) {
		case 'polyfill':
			// Only load polyfill.js if the browser doesn't meet your requirements
			return '<script>if( !("fetch" in window) ) { bfg_inject_script("' . $src . '"); }</script>';
		case 'bfg':
			return '<script>bfg_inject_script("' . $src . '");</script>';
	}

	return $tag;

}

add_filter( 'genesis_attr_body', 'bfg_ajax_url_attribute' );
/**
 * Add the AJAX URL as a `data-*` attribute on `<body>`, instead of an inline script, for better CSP compatibility.
 *
 * @since 2.3.46
 */
function bfg_ajax_url_attribute($atts) {

	$atts['data-ajax_url'] = add_query_arg(
		array(
			'action' => ':action',
		),
		admin_url( 'admin-ajax.php' )
	);

	return $atts;

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
	$favicon_build_path = $stylesheet_dir . '/build/images';

	// Set to false to disable, otherwise set to a hex color
	$color = false;

	// Use a 192px X 192px PNG for the homescreen for Chrome on Android
	echo '<link rel="icon" type="image/png" href="' . $favicon_build_path . '/favicon-192.png" sizes="192x192">';

	// Use a 180px X 180px PNG for the latest iOS devices, also setup app styles
	echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $favicon_build_path . '/favicon-180.png">';

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

add_filter( 'body_class', 'bfg_no_js_body_class' );
/**
 * Add a no-js class to the <body> tag.
 *
 * @since 2.3.51
 */
function bfg_no_js_body_class($classes) {

	$classes[] = 'no-js';
	$classes[] = 'no-svg';

	return $classes;

}

/*
 * Remove the header
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

/*
 * Remove the site title and/or description
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
