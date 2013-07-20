<?php
/**
 * Force HTML5
 *
 * See: http://www.briangardner.com/code/add-html5-markup/
 *
 * @since 2.0.0
 */
add_theme_support( 'genesis-html5' );

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
 * Add Genesis footer widget areas
 *
 * @since 2.0.1
 */
// add_theme_support( 'genesis-footer-widgets', 3 );

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

// add_action( 'widgets_init', 'bfg_remove_genesis_widgets', 20 );
/**
 * Disable some or all of the default Genesis widgets.
 *
 * @since 2.0.0
 */
function bfg_remove_genesis_widgets() {

    unregister_widget( 'Genesis_Featured_Page' );									// Featured Page
    unregister_widget( 'Genesis_User_Profile_Widget' );								// Featured Posts
    unregister_widget( 'Genesis_Featured_Post' );									// User Profile

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