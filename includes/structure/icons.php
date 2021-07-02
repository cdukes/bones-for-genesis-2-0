<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'acf/load_field/name=icon', 'bfg_populate_acf_icon_options' );
/**
 * Populates icon options for ACF field 'icon'.
 *
 * @since 20170926
 */
function bfg_populate_acf_icon_options($field) {

	$field['choices'] = array();

	if( !function_exists('get_current_screen') )
		return $field;

	// Skip if ACF edit screen
	$screen = get_current_screen();
	if( !empty($screen->id) && $screen->id === 'acf-field-group' )
		return $field;

	$path = CHILD_DIR . '/svgs/';
	if( !file_exists($path) )
		return $field;

	$files = scandir($path);
	foreach( $files as $file ) {
		$parts = pathinfo($file);
		if( empty($parts['extension']) )
			continue;

		if( $parts['extension'] !== 'svg' )
			continue;

		$slug = $parts['filename'];

		$label                   = str_replace('-', ' ', $slug);
		$label                   = ucwords($label);
		$field['choices'][$slug] = $label;
	}

	natcasesort($field['choices']);

	return $field;

}

/**
 * Helper function for inserting inline SVGs.
 *
 * @since 20170815
 */
function bfg_get_inline_icon($slug) {

	$path = CHILD_DIR . '/svgs/' . $slug . '.svg';
	if( !file_exists($path) )
		return;

	$svg = file_get_contents($path);

	return str_replace( '<svg ', '<svg class="icon icon-' . $slug . '"', $svg );

}

add_shortcode( 'bfg_icon', 'bfg_icon' );
/**
 * Shortcode version of bfg_get_inline_icon().
 *
 * @since 20181201
 */
function bfg_icon($atts, $content = '') {

	if( empty($atts['slug']) )
		return;

	return bfg_get_inline_icon($atts['slug']);

}
