<?php
// add_filter( 'genesis_search_text', 'bfg_search_text' );
/**
 * Customize the search form input box text
 *
 * See: http://www.briangardner.com/code/customize-search-form/
 *
 * @since 2.0.0
 */
function bfg_search_text() {
	return esc_attr( 'Search Text Goes Here...' );
}

// add_filter( 'genesis_search_button_text', 'bfg_search_button_text' );
/**
 * Customize the search form input button text
 *
 * See: http://www.briangardner.com/code/customize-search-form/
 *
 * @since 2.0.0
 */
function bfg_search_button_text( $text ) {
	return esc_attr( 'Click Here...' );
}
