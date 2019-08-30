<?php

namespace BFG;

if( !\defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'acf/load_field/name=icon', __NAMESPACE__ . '\\populate_acf_icon_options' );
/**
 * Populates icon options for ACF field 'icon'.
 *
 * @since 20170926
 */
function populate_acf_icon_options($field) {

	$field['choices'] = array();

	if( !\function_exists('get_current_screen') )
		return $field;

	// Skip if ACF edit screen
	$screen = get_current_screen();
	if( !empty($screen->id) && 'acf-field-group' === $screen->id )
		return $field;

	$path = CHILD_DIR . '/build/svgs/icons.svg';
	if( !\file_exists( $path ) )
		return $field;

	$css = \file_get_contents($path);
	\preg_match_all( '/id="icon-(.+?)"/', $css, $matches );

	if( empty($matches[1]) )
		return $field;

	foreach( $matches[1] as $slug ) {
		$label                   = \str_replace('-', ' ', $slug);
		$label                   = \ucwords($label);
		$field['choices'][$slug] = $label;
	}

	\natcasesort($field['choices']);

	return $field;

}

/**
 * Helper function for inserting inline SVGs.
 *
 * See: https://www.24a11y.com/2018/accessible-svg-icons-with-inline-sprites/
 *
 * @since 20170815
 */
function get_inline_icon($slug, $label = '') {

	if( !empty($label) ) {
		$label_id = \uniqid('svg-label-');
		$aria     = 'aria-labelledby="' . $label_id . '"';
	} else {
		$aria = 'aria-hidden="true" focusable="false"';
	}

	$svg = '<svg class="icon icon-' . esc_attr( $slug ) . '" ' . $aria . ' role="img">';
		if( !empty($label) )
			$svg .= ' <title id="' . $label_id . '">' . sanitize_text_field($label) . '</title> ';

		$svg .= ' <use xlink:href="#icon-' . esc_html( $slug ) . '"></use> ';
	$svg  .= '</svg>';

	return $svg;

}

add_shortcode( SLUG . '_icon', __NAMESPACE__ . '\\icon' );
/**
 * Shortcode version of get_inline_icon().
 *
 * @since 20181201
 */
function icon($atts, $content = '') {

	if( empty($atts['slug']) )
		return;

	return get_inline_icon($atts['slug']);

}
