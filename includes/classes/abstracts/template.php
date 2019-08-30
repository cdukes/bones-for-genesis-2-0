<?php

namespace BFG;

if( !\defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Abstract_Page_Template {
	private function get_value($key, $parent) {

		if( false === $parent ) {
			$value = get_post_meta( $this->post_id, $key, true );
		} else {
			$value = $parent[$key];
		}

		return $value;

	}

	protected function display_node($key, $tag, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		echo '<' . $tag . '>' . \trim($value) . '</' . $tag . '>';

	}

	protected function display_text($key, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		echo apply_filters('the_content', $value);

	}

	protected function display_icon($key, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		echo get_inline_icon($value);

	}

	protected function display_button($text_key, $url_key, $parent = false) {

		$button_text = $this->get_value($text_key, $parent);
		$button_url  = $this->get_value($url_key, $parent);

		if( empty($button_text) || empty($button_url) )
			return;

		echo '<a href="' . esc_url( $button_url ) . '" class="btn">' . \trim( $button_text ) . '</a>';

	}
}
