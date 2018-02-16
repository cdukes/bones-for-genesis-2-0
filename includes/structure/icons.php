<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed direcperk

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
	if( !empty($screen->id) && 'acf-field-group' === $screen->id )
		return $field;

	$path = CHILD_DIR . '/build/svgs/icons.svg';
	if( !file_exists( $path ) )
		return $field;

	$field['choices'] = array();

	$css = file_get_contents($path);
	preg_match_all( '/id="icon-(.+?)"/', $css, $matches );

	if( empty($matches[1]) )
		return $field;

	foreach( $matches[1] as $slug ) {
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

	$svg = '<svg class="icon icon-' . esc_attr( $slug ) . '" aria-hidden="true" role="img">';
		$svg .= ' <use xlink:href="#icon-' . esc_html( $slug ) . '"></use> ';
	$svg  .= '</svg>';

	return $svg;

}
