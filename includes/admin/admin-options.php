<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_filter( 'genesis_customizer_theme_settings_config', 'bfg_customizer_theme_settings_config' );
/**
 * Remove some or all of the options metaboxes in Dashboard > Genesis > Theme Settings.
 *
 * @since 2.0.0
 */
function bfg_customizer_theme_settings_config($config) {

	// Updates
	unset($config['genesis']['sections']['genesis_updates']);

	// Headers
	unset($config['genesis']['sections']['genesis_header']);

	// Site Layout
	unset($config['genesis']['sections']['genesis_layout']);

	// Breadcrumbs
	unset($config['genesis']['sections']['genesis_breadcrumbs']);

	// Comments and Trackbacks
	unset($config['genesis']['sections']['genesis_comments']);

	// Content Archives
	unset($config['genesis']['sections']['genesis_archives']);

	// Header/Footer Scripts
	unset($config['genesis']['sections']['genesis_scripts']);

	return $config;

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
