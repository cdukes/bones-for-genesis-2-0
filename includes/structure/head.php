<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Cleanup <head>.
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
	// header( 'Referrer-Policy: origin-when-cross-origin' );

	// Strict-Transport-Security: https://www.owasp.org/index.php/HTTP_Strict_Transport_Security_Cheat_Sheet
	// header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );

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

	if( in_array($relation_type, array('dns-prefetch', 'preconnect'), true) ) {
		// $hints[] = 'https://cdnjs.cloudflare.com';
		// $hints[] = 'https://fonts.googleapis.com';
		// $hints[] = 'https://fonts.gstatic.com';
	}

	return $hints;

}

/**
 * Build a list of self-hosted fonts, used to resource hints and inline @font-face style.
 *
 * @since 20200716
 */
function bfg_get_fonts() {

	// Array key is the name of the file in /fonts/, without an extension
	// .woff and .woff2 variations should be included in /fonts/
	// Only enable preload for high priority font variations, such as body text

	return array(
		'roboto-400' => array(
			'preload' => false,
			'family'  => 'Roboto',
			'style'   => 'normal',
			'weight'  => 400,
		),
	);

}

/**
 * Inject inline @font-face CSS at the top of <head>.
 *
 * @since 20200716
 */
// add_action( 'wp_head', 'bfg_inject_fonts', 1 );
function bfg_inject_fonts() {

	$stylesheet_dir = get_stylesheet_directory_uri();

	?>
	<style>
		<?php
		foreach( bfg_get_fonts() as $slug => $font ) {
			?>
			@font-face {
				font-family: '<?php echo $font['family']; ?>';
				src: local('<?php echo $font['family']; ?>'),
					 url('<?php echo $stylesheet_dir; ?>/fonts/<?php echo $slug; ?>.woff2') format('woff2'),
					 url('<?php echo $stylesheet_dir; ?>/fonts/<?php echo $slug; ?>.woff') format('woff');
				font-weight: <?php echo $font['weight']; ?>;
				font-style: <?php echo $font['style']; ?>;
				font-display: swap;
			}
			<?php
		}
		?>
	</style>
	<?php

}

add_action( 'wp_head', 'bfg_inject_preload', 2 );
/**
 * Add <link rel="preload">s for queued scripts.
 *
 * @since 20190301
 */
function bfg_inject_preload() {

	global $wp_scripts, $wp_version;

	$site_url       = get_bloginfo( 'url' );
	$stylesheet_dir = get_stylesheet_directory_uri();

	$wp_scripts->all_deps( $wp_scripts->queue );
	foreach( $wp_scripts->to_do as $handle ) {
		$script = $wp_scripts->registered[$handle];

		if( empty($script->src) )
			continue;

		$ver = null;
		if( $script->ver !== null ) {
			if( mb_strlen($script->ver) > 0 ) {
				$ver = $script->ver;
			} else {
				$ver = $wp_version;
			}
		}

		$href = add_query_arg(
			array(
				'ver' => $ver,
			),
			$script->src
		);

		?>
		<link rel="preload" href="<?php echo $href; ?>" as="script">
		<?php
	}

	// Fonts
	foreach( bfg_get_fonts() as $slug => $font ) {
		if( !$font['preload'] )
			continue;

		?>
		<link rel="preload" href="<?php echo $stylesheet_dir; ?>/fonts/<?php echo $slug; ?>.woff2" as="font" type="font/woff2" crossorigin="anonymous">
		<?php
	}

}

// Scripts + Styles
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

	$stylesheet_dir = get_stylesheet_directory_uri();

	// Remove Gutenberg styles
	wp_dequeue_style( 'wp-block-library' );

	// Main theme stylesheet
	$src     = BFG_PRODUCTION ? '/build/css/style.min.css' : '/build/css/style.css';
	$version = file_exists(CHILD_DIR . $src) ? filemtime(CHILD_DIR . $src) : null;
	wp_enqueue_style( 'bfg', $stylesheet_dir . $src, array(), $version );

	// Deregister jQuery
	wp_deregister_script( 'jquery' );

	// Deregister wp-a11y (loaded by Gravity Forms)
	// wp_deregister_script( 'wp-a11y' );

	// Dequeue Genesis's scripts
	wp_dequeue_script( 'skip-links' );
	wp_dequeue_script( 'superfish' );
	wp_dequeue_script( 'superfish-args' );

	// Main script file (in footer)
	$src     = BFG_PRODUCTION ? '/build/js/scripts.min.js' : '/build/js/scripts.js';
	$version = file_exists(CHILD_DIR . $src) ? filemtime(CHILD_DIR . $src) : null;
	wp_enqueue_script( 'bfg', $stylesheet_dir . $src, array(), $version, true );

}

add_filter( 'script_loader_tag', 'bfg_script_loader_tags', 10, 3);
/**
 * Overwrite the <script> tag on selected assets to use the JS loader.
 *
 * See: https://www.html5rocks.com/en/tutorials/speed/script-loading/
 *
 * @since 20170815
 */
function bfg_script_loader_tags($tag, $handle, $src) {

	switch( $handle ) {
		case 'bfg':
			$tag = str_replace('<script ', '<script defer ', $tag);

			return $tag;
	}

	return $tag;

}

// Favicons
remove_action( 'wp_head', 'genesis_load_favicon' );
// add_filter( 'genesis_pre_load_favicon', 'bfg_pre_load_favicon' );
/**
 * Simple favicon override to specify your favicon's location.
 *
 * @since 2.0.0
 */
function bfg_pre_load_favicon() {

	return get_stylesheet_directory_uri() . '/images/favicon.ico';

}

add_action( 'customize_register', 'bfg_remove_site_icon_customizer', 20, 1 );
/**
 * Remove the site icon customizer field.
 *
 * @since 20200420
 */
function bfg_remove_site_icon_customizer($wp_customize) {

	$wp_customize->remove_control('site_icon');

}

/*
 * Remove the site icon <head> display
 *
 * @since 20200420
 */
remove_action( 'wp_head', 'wp_site_icon', 99 );

/*
 * Remove the site icon admin <head> display
 *
 * @since 20200420
 */
add_action( 'admin_head', 'bfg_remove_admin_site_icon', 8 );
function bfg_remove_admin_site_icon() {

	remove_action( 'admin_head', 'wp_site_icon' );

}

// add_action( 'wp_head', 'bfg_load_favicons' );
// add_action( 'admin_head', 'bfg_load_favicons' );
/**
 * Show the best favicon, within reason.
 *
 * See: https://evilmartians.com/chronicles/how-to-favicon-in-2021-six-files-that-fit-most-needs
 *
 * @since 2.0.4
 */
function bfg_load_favicons() {

	$stylesheet_dir = get_stylesheet_directory_uri();
	$favicon_path   = $stylesheet_dir . '/images/favicons';

	// Use an SVG if supported
	echo '<link rel="icon" type="image/svg+xml" href="' . $favicon_path . '/favicon.svg" sizes="512x512">';

	// Use a 192px X 192px PNG for the homescreen for Chrome on Android
	echo '<link rel="icon" type="image/png" href="' . $favicon_path . '/favicon-192.png" sizes="192x192">';

	// Use a 180px X 180px PNG for the latest iOS devices, also setup app styles
	echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $favicon_path . '/favicon-180.png">';

}
