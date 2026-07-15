<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Base class providing helper methods for rendering custom page template fields.
 *
 * Expects extending classes to set `$post` and `$post_id` properties.
 */
abstract class BFG_Abstract_Page_Template {
	/**
	 * Get a field's value, either from post meta or from a parent array (e.g. a repeater row).
	 *
	 * @param string     $key    The meta key, or array key within $parent.
	 * @param array|bool $parent The parent array to read from, or false to read from post meta.
	 *
	 * @return mixed The field value, or an empty string if not found.
	 */
	private function get_value($key, $parent) {

		if( $parent === false ) {
			$value = get_post_meta( $this->post_id, $key, true );
		} else {
			$value = $parent[$key] ?? '';
		}

		return $value;

	}

	/**
	 * Echo a field's value wrapped in an HTML tag, or as a paragraph with a class.
	 *
	 * @param string     $key    The meta key, or array key within $parent.
	 * @param string     $tag    An HTML tag name (e.g. 'h2'), or a '.'-prefixed class name (e.g. '.lead').
	 * @param array|bool $parent The parent array to read from, or false to read from post meta.
	 *
	 * @return void
	 */
	protected function display_node($key, $tag, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		// $tag is expected to be a trusted, developer-supplied literal: either an
		// HTML tag name ('h2') or a '.'-prefixed class name ('.lead').
		if( str_starts_with($tag, '.') ) {
			echo '<p class="' . esc_attr( mb_ltrim($tag, '.') ) . '">' . wp_kses_data( mb_trim($value) ) . '</p>';

			return;
		}

		echo '<' . $tag . '>' . wp_kses_data( mb_trim($value) ) . '</' . $tag . '>';

	}

	/**
	 * Echo a field's value run through wpautop().
	 *
	 * @param string     $key    The meta key, or array key within $parent.
	 * @param array|bool $parent The parent array to read from, or false to read from post meta.
	 *
	 * @return void
	 */
	protected function display_text($key, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		echo wpautop($value);

	}

	/**
	 * Echo an icon field's value via bfg_get_icon().
	 *
	 * @param string     $key    The meta key, or array key within $parent.
	 * @param array|bool $parent The parent array to read from, or false to read from post meta.
	 *
	 * @return void
	 */
	protected function display_icon($key, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		echo bfg_get_icon($value);

	}

	/**
	 * Echo a button link, using one field for the button text and one for the URL.
	 *
	 * @param string     $text_key The meta key (or array key within $parent) for the button text.
	 * @param string     $url_key  The meta key (or array key within $parent) for the button URL.
	 * @param array|bool $parent   The parent array to read from, or false to read from post meta.
	 *
	 * @return void
	 */
	protected function display_button($text_key, $url_key, $parent = false) {

		$button_text = $this->get_value($text_key, $parent);
		$button_url  = $this->get_value($url_key, $parent);

		if( empty($button_text) || empty($button_url) )
			return;

		echo '<a href="' . esc_url( $button_url ) . '" class="btn">' . esc_html( mb_trim( $button_text ) ) . '</a>';

	}

	/**
	 * Echo an image field's value via bfg_get_image().
	 *
	 * @param string     $key    The meta key, or array key within $parent.
	 * @param int        $width  Display width in pixels.
	 * @param int        $height Display height in pixels.
	 * @param bool       $crop   Whether to hard crop to the given dimensions.
	 * @param array|bool $parent The parent array to read from, or false to read from post meta.
	 * @param array      $atts   Additional attributes to add to the image tag.
	 *
	 * @return void
	 */
	protected function display_image($key, $width, $height, $crop = true, $parent = false, $atts = array()) {

		$image_id = $this->get_value($key, $parent);
		if( empty($image_id) )
			return;

		echo bfg_get_image(
			$image_id,
			$width,
			$height,
			$crop,
			$atts
		);

	}
}
