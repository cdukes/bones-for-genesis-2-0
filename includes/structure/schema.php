<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_filter( 'genesis_attr_site-header', 'bfg_schema_empty' );
// add_filter( 'genesis_attr_nav-primary', 'bfg_schema_empty' );
// add_filter( 'genesis_attr_sidebar-primary', 'bfg_schema_empty' );
// add_filter( 'genesis_attr_site-footer', 'bfg_schema_empty' );
/**
 * Remove extra schema attributes
 *
 * @since 2.3.11
 */
function bfg_schema_empty( $attr ) {

	$attr['itemtype']  = '';
	$attr['itemprop']  = '';
	$attr['itemscope'] = '';
	return $attr;

}
