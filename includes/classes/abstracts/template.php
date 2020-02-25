<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BFG_Abstract_Page_Template {
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

		echo '<' . $tag . '>' . trim($value) . '</' . $tag . '>';

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

		echo bfg_get_inline_icon($value);

	}

	protected function display_button($text_key, $url_key, $parent = false) {

		$button_text = $this->get_value($text_key, $parent);
		$button_url  = $this->get_value($url_key, $parent);

		if( empty($button_text) || empty($button_url) )
			return;

		echo '<a href="' . esc_url( $button_url ) . '" class="btn">' . trim( $button_text ) . '</a>';

	}

	protected function display_image($key, $width, $height, $parent = false) {

		$image_id = $this->get_value($key, $parent);
		if( empty($image_id) )
			return;

		$mime_type = get_post_mime_type($image_id);
		switch($mime_type) {
			case 'image/svg+xml':
				$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

				?>
				<img src="<?php echo wp_get_attachment_url( $image_id ); ?>" alt="<?php echo esc_attr($alt); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
				<?php
				break;
			default:
				if( function_exists('ipq_get_theme_image') ) {
					echo ipq_get_theme_image(
						$image_id,
						array(
							array($width, $height, true),
						)
					);
				} else {
					echo wp_get_attachment_image( $image_id, array($width, $height) );
				}

				break;
		}

	}
}
