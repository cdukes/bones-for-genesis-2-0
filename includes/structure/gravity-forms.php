<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Disable view counting.
 *
 * @since 20180730
 */
// add_filter( 'gform_disable_view_counter', '__return_true' );

/**
 * Remove all 'tabindex' attributes from Gravity Forms.
 *
 * @since 20180726
 */
// add_filter( 'gform_tabindex', '__return_false' );

// add_filter( 'gform_field_content', 'bfg_gform_filter_textarea_rows', 10, 5 );
/**
 * Change the 'rows' attribute for Gravity Forms <textarea>s.
 *
 * @since 20180726
 */
function bfg_gform_filter_textarea_rows($content, $field, $value, $lead_id, $form_id) {

	if( is_admin() )
		return $content;

	return str_replace( "rows='10'", "rows='8'", $content );

}

// add_filter( 'gform_field_content', 'bfg_gform_filter_select_field_html', 10, 2 );
/**
 * Wrap Gravity Forms <select>s with a <div> and SVG icon.
 *
 * @since 20180726
 */
function bfg_gform_filter_select_field_html($html, $field) {

	if( is_admin() )
		return $html;

	$html = str_replace( '<select', '<div class="styled-select"><select', $html );

	return str_replace( '</select>', '</select>' . bfg_get_inline_icon('angle-down') . '</div>', $html );

}

// add_filter( 'gform_submit_button', 'bfg_gform_filter_submit_button_tag', 10, 2 );
/**
 * Switch the Gravity Forms <input type="submit"> button to a <button type="submit">, for easier styling.
 *
 * @since 20180726
 */
function bfg_gform_filter_submit_button_tag($button_input, $form) {

	if( is_admin() )
		return $button_input;

	$count = preg_match( '/value=\'(.+?)\'/', $button_input, $matches );
	if( $count !== 1 )
		return $button_input;

	$button_input = str_replace( '<input', '<button', $button_input );
	$button_input = str_replace( ' />', '>', $button_input );
	$button_input = str_replace( 'gform_button', 'gform_button btn', $button_input );

	// Also remove inline JS
	// $button_input = preg_replace( '/onclick=\'(.+?)\'/', '', $button_input );
	// $button_input = preg_replace( '/onkeypress=\'(.+?)\'/', '', $button_input );

	$button_input .= $matches[1];
	$button_input .= '</button>';

	return $button_input;

}

/*
 * Remove Gravity Forms inline <script> tags. To remove all GF JS, remove the submit JS in 'bfg_gform_filter_submit_button_tag' and consider deregistering jQuery
 *
 * @since 20180726
 */
// add_filter( 'gform_init_scripts_footer', '__return_true' );
// add_filter( 'gform_footer_init_scripts_filter', '__return_false' );
