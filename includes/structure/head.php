<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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

	// Strict-Transport-Security: https://www.owasp.org/index.php/HTTP_Strict_Transport_Security_Cheat_Sheet
	// header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );

}

/**
 * Use development mode for Yoast SEO when not in production
 *
 * @since 20220606
 */
add_filter( 'yoast_seo_development_mode', 'bfg_yoast_seo_development_mode' );
function bfg_yoast_seo_development_mode() {

	return !BFG_PRODUCTION;

}

/**
 * Build a list of self-hosted fonts, used to resource hints and inline @font-face style.
 *
 * @since 20200716
 */
function bfg_get_fonts() {

	// Array key is the name of the file in /fonts/, without an extension
	// .woff2's should be included in /fonts/
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
				src: url('<?php echo $stylesheet_dir; ?>/fonts/<?php echo $slug; ?>.woff2') format('woff2');
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

	$stylesheet_dir = get_stylesheet_directory_uri();

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
remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
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
	// wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );

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
	wp_enqueue_script( 'bfg', $stylesheet_dir . $src, array(), $version, array('strategy' => 'defer') );

	$src     = '/build/svgs/icons.svg';
	$version = file_exists(CHILD_DIR . $src) ? filemtime(CHILD_DIR . $src) : null;

	$icon_src = add_query_arg(
		array(
			'v' => $version,
		),
		$stylesheet_dir . $src
	);

	wp_localize_script(
		'bfg',
		'bfg_icons',
		array(
			'src' => $icon_src,
		)
	);

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
	echo '<link rel="icon" type="image/svg+xml" href="' . $favicon_path . '/favicon.svg">';

	// Use a 192px X 192px PNG fallback for Safari
	echo '<link rel="apple-touch-icon" href="' . $favicon_path . '/favicon-192.png">';

}
