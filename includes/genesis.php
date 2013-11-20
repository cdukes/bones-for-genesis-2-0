<?php
/**
 * Force HTML5
 *
 * See: http://www.briangardner.com/code/add-html5-markup/
 *
 * @since 2.0.0
 */
add_theme_support( 'html5' );

/**
 * Adds <meta> tags for mobile responsiveness.
 *
 * See: http://www.briangardner.com/code/add-viewport-meta-tag/
 *
 * @since 2.0.0
 */
// add_theme_support( 'genesis-responsive-viewport' );

/**
 * Add support for custom backgrounds
 *
 * @since 2.0.2
 */
// add_theme_support( 'custom-background' );

/**
 * Add support for a custom header
 *
 * @since 2.0.9
 */
// add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/**
 * Add Genesis post format support
 *
 * @since 2.0.9
 */
// add_theme_support( 'post-formats', array(
// 	'aside',
// 	'chat',
// 	'gallery',
// 	'image',
// 	'link',
// 	'quote',
// 	'status',
// 	'video',
// 	'audio'
// ));
// add_theme_support( 'genesis-post-format-images' );

/**
 * Add Genesis footer widget areas
 *
 * @since 2.0.1
 */
// add_theme_support( 'genesis-footer-widgets', 3 );

/**
 * Add Genesis theme color scheme selection theme option
 *
 * @since 2.0.11
 */
// add_theme_support(
// 	'genesis-style-selector',
// 	array(
// 		'bfg-red'   => 'Red',
// 		'bfg-orange'  => 'Orange'
// 	)
// );

/**
 * Declare WooCommerce support, using Genesis Connect for WooCommerce
 *
 * See: http://wordpress.org/plugins/genesis-connect-woocommerce/
 *
 * @since 2.0.6
 */
// add_theme_support( 'genesis-connect-woocommerce' );

/**
 * Unregister default Genesis layouts
 *
 * @since 1.x
 */
// genesis_unregister_layout( 'content-sidebar' );
// genesis_unregister_layout( 'sidebar-content' );
// genesis_unregister_layout( 'content-sidebar-sidebar' );
// genesis_unregister_layout( 'sidebar-sidebar-content' );
// genesis_unregister_layout( 'sidebar-content-sidebar' );
// genesis_unregister_layout( 'full-width-content' );

/**
 * Unregister default Genesis sidebars
 *
 * @since 1.x
 */
// unregister_sidebar( 'header-right' );
// unregister_sidebar( 'sidebar-alt' );
// unregister_sidebar( 'sidebar' );

/**
 * Unregister default Genesis menus and add your own
 *
 * @since 2.0.18
 */
// remove_theme_support( 'genesis-menus' );
// add_theme_support(
// 	'genesis-menus',
// 	array(
// 		'primary' => 'Primary Menu',
// 		'secondary' => 'Primary Menu',
// 	)
// );

// add_action( 'widgets_init', 'bfg_remove_genesis_widgets', 20 );
/**
 * Disable some or all of the default Genesis widgets.
 *
 * @since 2.0.0
 */
function bfg_remove_genesis_widgets() {

    unregister_widget( 'Genesis_Featured_Page' );									// Featured Page
    unregister_widget( 'Genesis_User_Profile_Widget' );								// User Profile
    unregister_widget( 'Genesis_Featured_Post' );									// Featured Posts

}

// add_action( 'init', 'bfg_remove_layout_meta_boxes' );
/**
 * Remove the Genesis 'Layout Settings' meta box for posts and/or pages.
 *
 * @since 2.0.0
 */
function bfg_remove_layout_meta_boxes() {

    remove_post_type_support( 'post', 'genesis-layouts' );							// Posts
    remove_post_type_support( 'page', 'genesis-layouts' );							// Pages

}

// add_action( 'init', 'bfg_remove_scripts_meta_boxes' );
/**
 * Remove the Genesis 'Scripts' meta box for posts and/or pages.
 *
 * @since 2.0.12
 */
function bfg_remove_scripts_meta_boxes() {

    remove_post_type_support( 'post', 'genesis-scripts' );							// Posts
    remove_post_type_support( 'page', 'genesis-scripts' );							// Pages

}