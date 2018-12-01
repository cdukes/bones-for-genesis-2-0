<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_action( 'genesis_theme_settings_metaboxes', 'bfg_remove_theme_settings_metaboxes' );
/**
 * Remove some or all of the options metaboxes in Dashboard > Genesis > Theme Settings.
 *
 * See: http://genesissnippets.com/remove-unused-theme-settings-metaboxes/
 *
 * @since 2.0.0
 */
function bfg_remove_theme_settings_metaboxes($_genesis_theme_settings_pagehook) {

	// remove_meta_box( 'genesis-theme-settings-version', $_genesis_theme_settings_pagehook, 'main' );			// Information
	remove_meta_box( 'genesis-theme-settings-feeds', $_genesis_theme_settings_pagehook, 'main' );				// Custom Feeds
	remove_meta_box( 'genesis-theme-settings-adsense', $_genesis_theme_settings_pagehook, 'main' ); 			// Google AdSense
	// remove_meta_box( 'genesis-theme-settings-layout', $_genesis_theme_settings_pagehook, 'main' );			// Default Layout
	remove_meta_box( 'genesis-theme-settings-header', $_genesis_theme_settings_pagehook, 'main' );				// Header
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );					// Navigation
	remove_meta_box( 'genesis-theme-settings-breadcrumb', $_genesis_theme_settings_pagehook, 'main' );			// Breadcrumbs
	// remove_meta_box( 'genesis-theme-settings-comments', $_genesis_theme_settings_pagehook, 'main' );			// Comments and Trackbacks
	// remove_meta_box( 'genesis-theme-settings-posts', $_genesis_theme_settings_pagehook, 'main' );			// Content Archives
	// remove_meta_box( 'genesis-theme-settings-blogpage', $_genesis_theme_settings_pagehook, 'main' );			// Blog Page Template
	// remove_meta_box( 'genesis-theme-settings-scripts', $_genesis_theme_settings_pagehook, 'main' );			// Header and Footer Scripts

}

add_filter( 'genesis_theme_settings_defaults', 'bfg_theme_settings_defaults' );
/**
 * Set default values for custom theme options.
 *
 * @since 2.3.0
 */
function bfg_theme_settings_defaults($defaults) {

	$defaults['content_archive']           = 'excerpts';
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_size']                = 'thumbnail';
	$defaults['trackbacks_posts']          = 0;

	return $defaults;

}

/*
 * Add ACF site options admin menu
 *
 * @since 20181201
 */
if( function_exists('acf_add_options_page') )
	acf_add_options_page('Site Options');
