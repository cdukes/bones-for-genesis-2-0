<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_filter( 'genesis_footer_output', 'bfg_footer_creds_text' );
/**
 * Custom footer 'creds' text.
 *
 * @since 2.0.0
 */
function bfg_footer_creds_text() {

	 return '<p>' . __( 'Copyright', CHILD_THEME_TEXT_DOMAIN ) . ' [footer_copyright] [footer_childtheme_link] &middot; [footer_genesis_link] [footer_studiopress_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]</p>';

}

// add_action( 'wp_footer', 'bfg_disable_pointer_events_on_scroll', 99 );
/**
 * Disable pointer events when scrolling. Be careful using this with CSS :hover-enabled menus.
 *
 * See: https://gist.github.com/ossreleasefeed/7768761
 *
 * @since 2.0.20
 */
function bfg_disable_pointer_events_on_scroll() {

	ob_start();
	?><script>
		if( window.addEventListener ) {
			var root = document.documentElement;
			var timer;

			window.addEventListener('scroll', function() {
				clearTimeout(timer);

				if (!root.style.pointerEvents) {
					root.style.pointerEvents = 'none';
				}

				timer = setTimeout(function() {
					root.style.pointerEvents = '';
				}, 250);
			}, false);
		}
	</script>
	<?php
	$output = ob_get_clean();
	echo preg_replace( '/\s+/', ' ', $output ) . "\n";

}

// add_action( 'wp_footer', 'bfg_ie_font_face_fix', 99 );
/**
 * Forces the main stylesheet to reload on document ready for IE8 and below.
 * This redraws any @font-face fonts, fixing the IE8 font loading bug.
 *
 * See: http://stackoverflow.com/questions/9809351/ie8-css-font-face-fonts-only-working-for-before-content-on-over-and-sometimes
 *
 * @since 2.0.13
 */
function bfg_ie_font_face_fix() {

	ob_start();
	?><!--[if lt IE 9]>
		<script>
			jQuery(document).ready(function($) {
				var head = document.getElementsByTagName('head')[0],
					style = document.createElement('style');
				style.type = 'text/css';
				style.styleSheet.cssText = ':before,:after{content:none !important;}';
				head.appendChild(style);
				setTimeout(function(){
					head.removeChild(style);
				}, 0);
			});
		</script>
	<![endif]-->
	<?php
	$output = ob_get_clean();
	echo preg_replace( '/\s+/', ' ', $output ) . "\n";

}
