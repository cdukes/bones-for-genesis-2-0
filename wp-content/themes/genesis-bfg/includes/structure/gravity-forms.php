<?php
/**
 * Gravity Forms markup and behavior customizations.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Disable view counting.
 *
 * @since 20180730
 */
// add_filter( 'gform_disable_view_counter', '__return_true' );

/**
 * Disable legacy markup.
 *
 * @since 20220627
 */
// add_filter( 'gform_enable_legacy_markup', '__return_false' );

/**
 * Remove all 'tabindex' attributes from Gravity Forms.
 *
 * @since 20180726
 */
// add_filter( 'gform_tabindex', '__return_false' );

/**
 * Disable Gravity Forms CSS.
 *
 * @since 20240201
 */
// add_filter( 'gform_disable_css', '__return_true' );

// add_filter( 'gform_field_content', 'bfg_gform_filter_textarea_rows', 10, 5 );
/**
 * Change the 'rows' attribute for Gravity Forms <textarea>s.
 *
 * @since 20180726
 *
 * @param string $content The field's rendered HTML.
 * @param object $field   The current field object.
 * @param string $value   The field value.
 * @param int    $lead_id The entry ID.
 * @param int    $form_id The form ID.
 *
 * @return string Filtered HTML.
 */
function bfg_gform_filter_textarea_rows( $content, $field, $value, $lead_id, $form_id ) {

	if ( is_admin() ) {
		return $content;
	}

	return str_replace( "rows='10'", "rows='8'", $content );
}

// add_filter( 'gform_field_content', 'bfg_gform_filter_select_field_html', 10, 2 );
/**
 * Wrap Gravity Forms <select>s with a <div> and SVG icon.
 *
 * @since 20180726
 *
 * @param string $html  The field's rendered HTML.
 * @param object $field The current field object.
 *
 * @return string Filtered HTML.
 */
function bfg_gform_filter_select_field_html( $html, $field ) {

	if ( is_admin() ) {
		return $html;
	}

	$html = str_replace( '<select', '<div class="styled-select"><select', $html );

	return str_replace( '</select>', '</select>' . bfg_get_icon( 'angle-down' ) . '</div>', $html );
}

// add_filter( 'gform_submit_button', 'bfg_gform_filter_submit_button_tag', 10, 2 );
/**
 * Switch the Gravity Forms <input type="submit"> button to a <button type="submit">, for easier styling.
 *
 * @since 20180726
 *
 * @param string $button_input The submit button's rendered HTML.
 * @param array  $form         The current form object.
 *
 * @return string Filtered HTML.
 */
function bfg_gform_filter_submit_button_tag( $button_input, $form ) {

	if ( is_admin() ) {
		return $button_input;
	}

	preg_match( '/(<button[^>]*>)(.*?)(<\/button>)/is', $button_input, $matches );

	if ( $matches ) {
		$button_input = str_replace( $matches[0], $matches[1] . '<span>' . $matches[2] . '</span>' . $matches[3], $button_input );
	}

	return str_replace( 'gform_button', 'gform_button btn', $button_input );

	// Also remove inline JS
	// $button_input = preg_replace( '/onclick=\'(.+?)\'/', '', $button_input );
	// $button_input = preg_replace( '/onkeypress=\'(.+?)\'/', '', $button_input );
}

// add_filter( 'gform_form_validation_errors_markup', 'bfg_gform_form_validation_errors_markup', 10, 2 );
/**
 * Replace validation errors <h2> with <p>.
 *
 * @since 20210728
 *
 * @param string $html The validation errors summary HTML.
 * @param array  $form The current form object.
 *
 * @return string Filtered HTML.
 */
function bfg_gform_form_validation_errors_markup( $html, $form ) {

	return str_replace( 'h2', 'p', $html );
}

/**
 * Remove Gravity Forms inline <script> tags. To remove all GF JS, remove the submit JS in 'bfg_gform_filter_submit_button_tag' and consider deregistering jQuery.
 *
 * @since 20180726
 */
// add_filter( 'gform_init_scripts_footer', '__return_true' );
// add_filter( 'gform_footer_init_scripts_filter', '__return_false' );

// add_action( 'gform_after_save_form', 'bfg_gform_after_save_form', 10, 3 );
/**
 * Apply data management defaults when a form is first created.
 *
 * @since 20260909
 *
 * @param array $form_meta      The saved form meta.
 * @param bool  $is_new         True if this save created the form.
 * @param array $deleted_fields The IDs of any fields which have been deleted.
 */
function bfg_gform_after_save_form( $form_meta, $is_new, $deleted_fields ) {

	if ( ! $is_new ) {
		return;
	}

	$form_meta['personalData']['retention'] = array(
		'policy'              => 'delete',
		'retain_entries_days' => '90',
	);

	GFAPI::update_form( $form_meta );
}

// add_filter( 'gform_entry_is_spam', 'bfg_gform_entry_is_spam', 10, 3 );
/**
 * Flag Cyrillic submissions as spam.
 *
 * @since 20240313
 *
 * @param bool  $is_spam Whether the entry is currently flagged as spam.
 * @param array $form    The current form object.
 * @param array $entry   The submitted entry values.
 *
 * @return bool Filtered value.
 */
function bfg_gform_entry_is_spam( $is_spam, $form, $entry ) {

	foreach ( $entry as $value ) {
		if ( empty( $value ) ) {
			continue;
		}

		if ( ! preg_match( '/[\p{Cyrillic}]/u', $value ) ) {
			continue;
		}

		return true;
	}

	return $is_spam;
}
