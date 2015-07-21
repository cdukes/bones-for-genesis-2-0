<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
	Template Name: Custom Template Starter
*/

/*
 * Force a layout setting for the page
 *
 * See: http://www.briangardner.com/code/force-layout-setting/
 *
 * @since 2.0.0
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
// Other possible layouts: __genesis_return_content_sidebar, __genesis_return_sidebar_content, __genesis_return_content_sidebar_sidebar, __genesis_return_sidebar_sidebar_content, __genesis_return_sidebar_content_sidebar, __genesis_return_full_width_content

genesis();
