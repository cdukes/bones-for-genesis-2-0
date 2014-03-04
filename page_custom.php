<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
	Template Name: Custom Template Starter
*/

/**
 * Add a custom body class to this page template. A nicer CSS hook than the WP template default
 *
 * @since 2.0.8
 */
add_filter( 'body_class', 'bfg_custom_template_body_class' );
function bfg_custom_template_body_class( $classes ) {

	$classes[] = 'landing';
	return $classes;

}

/**
 * Force a layout setting for the page
 *
 * See: http://www.briangardner.com/code/force-layout-setting/
 *
 * @since 2.0.0
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
// Other possible layouts: __genesis_return_content_sidebar, __genesis_return_sidebar_content, __genesis_return_content_sidebar_sidebar, __genesis_return_sidebar_sidebar_content, __genesis_return_sidebar_content_sidebar, __genesis_return_full_width_content

genesis();