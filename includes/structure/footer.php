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
