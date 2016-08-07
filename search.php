<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'genesis_before_loop', 'bfg_do_search_title' );
/**
 * Copied from the Genesis search.php file. Putting it here allows overriding.
 *
 * @since 1.9.0
 */
function bfg_do_search_title() {

	$title = sprintf( '<div class="archive-description"><h1 class="archive-title">%s %s</h1></div>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', CHILD_THEME_TEXT_DOMAIN ) ), get_search_query() );

	echo apply_filters( 'genesis_search_title_output', $title ) . "\n";

}

genesis();
