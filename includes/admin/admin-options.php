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

	// Singular Content
	unset($config['genesis']['sections']['genesis_single']);

	// Content Archives
	unset($config['genesis']['sections']['genesis_archives']);

	// Footer
	unset($config['genesis']['sections']['genesis_footer']);

	// Header/Footer Scripts
	unset($config['genesis']['sections']['genesis_scripts']);

	return $config;

}

// add_filter( 'acf/settings/show_admin', 'bfg_show_acf_settings' );
/*
 * Hide ACF config on production
 *
 * @since 20221128
 */
function bfg_show_acf_settings($show) {

	if( !BFG_PRODUCTION )
		return $show;

	if( !function_exists('acf_pro_get_license') )
		return $show;

	$license = acf_pro_get_license();
	if( empty($license) )
		return $show;

	return false;

}

/*
 * Add ACF site options admin menu
 *
 * @since 20181201
 */
if( function_exists('acf_add_options_page') )
	acf_add_options_page('Site Options');
