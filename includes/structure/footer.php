<?php
// add_filter( 'genesis_footer_creds_text', 'bfg_footer_creds_text' );
/**
 * Custom footer 'creds' text
 *
 * Note: Avoid adding <p> tags here, since it causes an HTML validation error in Genesis
 *
 * @since 2.0.0
 */
function bfg_footer_creds_text() {

	 return 'Copyright [footer_copyright] [footer_childtheme_link] &middot; [footer_genesis_link] [footer_studiopress_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';

}

add_action( 'wp_footer', 'bfg_ie_font_face_fix', 99 );
/**
 * Forces the main stylesheet to reload on document ready for IE8 and below.
 * This redraws any @font-face fonts, fixing the IE8 font loading bug
 *
 * See: http://stackoverflow.com/questions/9809351/ie8-css-font-face-fonts-only-working-for-before-content-on-over-and-sometimes
 *
 * @since 2.0.13
 */
function bfg_ie_font_face_fix() {

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

}