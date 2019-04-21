<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BFG_Head {
	public function __construct() {

		$this->cleanup();

		// Remove <script> type attribute
		// For when you really want to pass validator.w3.org
		// add_filter( 'wp_head', array($this, 'open_remove_type_attr'), 1 );
		// add_filter( 'wp_footer', array($this, 'close_remove_type_attr'), 999 );

		// Headers
		add_action( 'wp', array($this, 'security_headers') );

		// Doctype
		remove_action( 'genesis_doctype', 'genesis_do_doctype' );
		add_action( 'genesis_doctype', array($this, 'doctype') );

		// Resource hints
		add_filter( 'wp_resource_hints', array($this, 'resource_hints'), 10, 2 );
		add_action( 'wp_head', array($this, 'inject_preload'), 2 );

		// Scripts + Styles
		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
		add_action( 'wp_enqueue_scripts', array($this, 'load_assets') );
		add_action( 'wp_footer', array($this, 'inject_script'), 1 );
		add_filter( 'script_loader_tag', array($this, 'script_loader_tags'), 10, 3);

		// Favicons
		remove_action( 'wp_head', 'genesis_load_favicon' );
		// add_filter( 'genesis_pre_load_favicon', array($this, 'pre_load_favicon') );
		// add_action( 'wp_head', array($this, 'load_favicons') );

	}

	/**
	 * Cleanup <head>.
	 *
	 * @since 2.0.0
	 */
	private function cleanup() {

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

	}

	/**
	 * Start OB for <script type="..."> removal.
	 *
	 * @since 20190421
	 */
	public function open_remove_type_attr() {

		ob_start();

	}

	/**
	 * Remove <script> type attribute.
	 *
	 * @since 20190421
	 */
	public function close_remove_type_attr() {

		$html = ob_get_clean();
		$html = str_replace(" type='text/javascript'", '', $html);
		echo $html;

	}

	/**
	 * Prevent other sites from embedding this one in an iFrame, and prevents MIME type spoofing.
	 *
	 * @since 2.3.56
	 */
	public function security_headers() {

		if( is_admin() )
			return;

		header( 'X-Frame-Options: DENY' );
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-XSS-Protection: 1; mode=block' );

		// https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy
		// May break services that use a referrer check, such as typography.com and Google's APIs
		// header( 'Referrer-Policy: origin-when-cross-origin' );

		// Strict-Transport-Security: https://www.owasp.org/index.php/HTTP_Strict_Transport_Security_Cheat_Sheet (example not included here to avoid accidental activation)

	}

	/**
	 * Overrides the default Genesis doctype.
	 *
	 * See: http://html5boilerplate.com/
	 *
	 * @since 2.2.4
	 */
	public function doctype() {

		?>
		<!DOCTYPE html>
		<html class="<?php echo is_admin_bar_showing() ? 'admin-bar-showing' : ''; ?>" <?php language_attributes( 'html' ); ?>>
		<head <?php echo genesis_attr( 'head' ); ?>>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="format-detection" content="telephone=no">
		<?php

	}

	/**
	 * Prefetch the DNS for external resource domains. Better browser support than preconnect.
	 *
	 * See: https://www.igvita.com/2015/08/17/eliminating-roundtrips-with-preconnect/
	 *
	 * @since 2.3.19
	 */
	public function resource_hints($hints, $relation_type) {

		if( 'dns-prefetch' === $relation_type ) {
			$hints[] = '//cdn.polyfill.io';
			$hints[] = '//cdnjs.cloudflare.com';
			// $hints[] = '//fonts.googleapis.com';
		}

		return $hints;

	}

	/**
	 * Add <link rel="preload">s for queued scripts.
	 *
	 * Don't preload the polyfill script, since there's little overlap
	 * between browsers that need it and that support preload
	 *
	 * @since 20190301
	 */
	public function inject_preload() {

		global $wp_scripts, $wp_version;

		$site_url = get_bloginfo( 'url' );

		$wp_scripts->all_deps( $wp_scripts->queue );
		foreach( $wp_scripts->to_do as $handle ) {
			// Don't preload polyfill, since it's unlikely to be needed on modern browsers
			if( 'polyfill' === $handle )
				continue;

			$script = $wp_scripts->registered[$handle];

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
			<link rel="preload" href="<?php echo $href; ?>" as="script" />
			<?php
		}

		// Preload icons.svg as `fetch`, since it's loaded via JS
		$href = add_query_arg(
			array(
				'v' => BFG_VERSION,
			),
			get_stylesheet_directory_uri() . '/build/svgs/icons.svg'
		);

		?>
		<link rel="preload" href="<?php echo $href; ?>" as="fetch" crossorigin />
		<?php

	}

	/**
	 * Overrides the default Genesis stylesheet with child theme specific CSS and JS.
	 *
	 * Only load these styles on the front-end.
	 *
	 * @since 2.0.0
	 */
	public function load_assets() {

		$stylesheet_dir = get_stylesheet_directory_uri();

		// Remove Gutenberg styles
		wp_dequeue_style( 'wp-block-library' );

		// Main theme stylesheet
		$src = BFG_PRODUCTION ? '/build/css/style.min.css' : '/build/css/style.css';
		wp_enqueue_style( 'bfg', $stylesheet_dir . $src, array(), BFG_VERSION );

		// Google Fonts
		// Consider async loading: https://github.com/typekit/webfontloader
		// wp_enqueue_style(
		// 	'google-fonts',
		// 	'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7CLato',		// Open Sans (light, normal, and bold) and Lato regular, for example
		// 	array(),
		// 	null
		// );

		// Register polyfill.io with default options
		$src = BFG_PRODUCTION ? 'https://cdn.polyfill.io/v2/polyfill.min.js?features=default-3.6,fetch' : 'https://cdn.polyfill.io/v2/polyfill.js?features=default-3.6,fetch';
		wp_register_script( 'polyfill', $src, array(), null, true );

		// instant.page
		$src = BFG_PRODUCTION ? 'https://cdnjs.cloudflare.com/ajax/libs/instant.page/1.2.2/instantpage.min.js' : 'https://cdnjs.cloudflare.com/ajax/libs/instant.page/1.2.2/instantpage.js';
		// wp_enqueue_script( 'instant.page', $src, array(), null, true );

		// Use jQuery from a CDN
		wp_deregister_script( 'jquery' );
		$src = BFG_PRODUCTION ? 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' : 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js';
		wp_register_script( 'jquery', $src, array(), null, false );

		// Dequeue Genesis's scripts
		wp_dequeue_script( 'html5shiv' );
		wp_dequeue_script( 'skip-links' );
		wp_dequeue_script( 'superfish' );
		wp_dequeue_script( 'superfish-args' );

		// Main script file (in footer)
		$src = BFG_PRODUCTION ? '/build/js/scripts.min.js' : '/build/js/scripts.js';
		wp_enqueue_script( 'bfg', $stylesheet_dir . $src, array('polyfill'), BFG_VERSION, true );

		// Add scripts which can be used by the _loader.js module here
		$on_demand_script_srcs = array(
			'svgxuse' => array(
				'src' => BFG_PRODUCTION ? 'https://cdnjs.cloudflare.com/ajax/libs/svgxuse/1.2.6/svgxuse.min.js' : 'https://cdnjs.cloudflare.com/ajax/libs/svgxuse/1.2.6/svgxuse.js',
				'sri' => BFG_PRODUCTION ? 'sha256-+xblFIDxgSu6OfR6TdLhVHZzVrhw8eXiVk8PRi9ACY8=' : 'sha256-TU+njGBu7T1DrfKgOBEH7kCKsl7UEvUNzpZaeUNNGi8=',
			),
		);
		wp_localize_script( 'bfg', 'bfg_script_srcs', $on_demand_script_srcs );

		$icon_src = add_query_arg(
			array(
				'v' => BFG_VERSION,
			),
			$stylesheet_dir . '/build/svgs/icons.svg'
		);

		wp_localize_script( 'bfg', 'bfg_icons_src', $icon_src );

	}

	/**
	 * Inject a JS script loader function.
	 *
	 * See: https://www.html5rocks.com/en/tutorials/speed/script-loading/
	 *
	 * @since 20170815
	 */
	public function inject_script() {

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

	/**
	 * Overwrite the <script> tag on selected assets to use the JS loader.
	 *
	 * See: https://www.html5rocks.com/en/tutorials/speed/script-loading/
	 *
	 * @since 20170815
	 */
	public function script_loader_tags($tag, $handle, $src) {

		$tag = str_replace(" type='text/javascript'", '', $tag);

		switch( $handle ) {
			case 'polyfill':
				// Only load polyfill.js if the browser doesn't meet your requirements
				return '<script>if( !("fetch" in window) ) { bfg_inject_script("' . $src . '"); }</script>';
			case 'instant.page':
				// Only load instant.page in modern browsers
				return '<script>if( "fetch" in window ) { bfg_inject_script("' . $src . '"); }</script>';
			case 'bfg':
				return '<script>bfg_inject_script("' . $src . '");</script>';
		}

		return $tag;

	}

	/**
	 * Simple favicon override to specify your favicon's location.
	 *
	 * @since 2.0.0
	 */
	public function pre_load_favicon() {

		return get_stylesheet_directory_uri() . '/images/favicon.ico';

	}

	/**
	 * Show the best favicon, within reason.
	 *
	 * See: http://www.jonathantneal.com/blog/understand-the-favicon/
	 *
	 * @since 2.0.4
	 */
	public function load_favicons() {

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
}

return new BFG_Head();
