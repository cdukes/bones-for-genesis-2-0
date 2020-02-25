<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Remove the Genesis redirect on theme upgrade
 *
 * @since 2.3.29
 */
remove_action( 'genesis_upgrade', 'genesis_upgrade_redirect' );

/*
 * Force HTML5
 *
 * See: http://www.briangardner.com/code/add-html5-markup/
 *
 * @since 2.0.0
 */
add_theme_support( 'html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script', 'style') );

/*
 * Genesis 2.2 accessibility features
 *
 * See: https://github.com/copyblogger/genesis-sample/commit/7613301f5e89b6fad15bb3165f607406db7c7c91
 *
 * @since 2.3.17
 */
add_theme_support( 'genesis-accessibility', array('404-page', 'headings', 'screen-reader-text', 'skip-links', 'search-form') );

/*
 * Remove Genesis Import/Export support
 *
 * @since 20190503
 */
remove_theme_support( 'genesis-import-export-menu' );

/**
 * Add Genesis post format support.
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
 * Add support for lazy loading.
 *
 * @since 20191113
 */
// add_theme_support( 'genesis-lazy-load-images' );

/**
 * Add support for after entry widget.
 *
 * @since 2.3.33
 */
// add_theme_support( 'genesis-after-entry-widget-area' );

/**
 * Add Genesis footer widget areas.
 *
 * @since 2.0.1
 */
// add_theme_support( 'genesis-footer-widgets', 3 );

/**
 * Add Genesis theme color scheme selection theme option.
 *
 * @since 2.0.11
 */
// add_theme_support(
// 	'genesis-style-selector',
// 	array(
// 		'bfg-red' => 'Red',
// 		'bfg-orange' => 'Orange'
// 	)
// );

/**
 * Declare WooCommerce support, using Genesis Connect for WooCommerce.
 *
 * See: http://wordpress.org/plugins/genesis-connect-woocommerce/
 *
 * @since 2.0.6
 */
// add_theme_support( 'genesis-connect-woocommerce' );

/**
 * Unregister default Genesis layouts.
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
 * Unregister default Genesis sidebars.
 *
 * @since 1.x
 */
// unregister_sidebar( 'header-right' );
// unregister_sidebar( 'sidebar-alt' );
// unregister_sidebar( 'sidebar' );

/**
 * Unregister default Genesis menus and add your own.
 *
 * @since 2.0.18
 */
// remove_theme_support( 'genesis-menus' );
// add_theme_support(
// 	'genesis-menus',
// 	array(
// 		'primary' => 'Primary Menu',
// 		'secondary' => 'Secondary Menu',
// 	)
// );

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

/*
 * Remove the Genesis 'Layout Settings' meta box for terms
 *
 * @since 2.3.23
 */
remove_theme_support( 'genesis-archive-layouts' );

/**
 * Remove the Genesis 'Archive Settings' fields for terms.
 *
 * @since 2.3.58
 */
// remove_action( 'admin_init', 'genesis_add_taxonomy_archive_options' );

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

/**
 * Remove the Genesis user meta boxes.
 *
 * @since 2.3.30
 */
// remove_action( 'show_user_profile', 'genesis_user_options_fields' );
// remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
// remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
// remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );

/**
 * Use HTML5 semantic headings.
 *
 * @since 2.3.4
 */
// add_filter( 'genesis_pre_get_option_semantic_headings', '__return_true' );

/**
 * Set child theme text domain.
 *
 * @since 2.3.33
 */
// add_action( 'after_setup_theme', 'bfg_load_child_theme_textdomain' );
function bfg_load_child_theme_textdomain() {

	load_child_theme_textdomain(
		CHILD_THEME_TEXT_DOMAIN,
		get_stylesheet_directory() . '/languages'
	);

}
