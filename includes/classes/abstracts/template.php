<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class BFG_Abstract_Page_Template {
	/**
	 * Defines the number of display_image() images that shouldn't be lazy loaded on the page
	 * Set to 0 to lazy load all images
	 *
	 * @since 20220126
	 */
	protected $omit_threshold = 1;

	protected $image_count = 0;

	private function get_value($key, $parent) {

		if( $parent === false ) {
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

	private function get_lazy_loading_attr() {

		if( !wp_lazy_loading_enabled( 'img', 'wp_get_attachment_image' ) )
			return 'eager';

		if( $this->omit_threshold === 0 )
			return 'lazy';

		if( $this->image_count < $this->omit_threshold )
			return 'eager';

		return 'lazy';

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
				<img src="<?php echo wp_get_attachment_url( $image_id ); ?>" alt="<?php echo esc_attr($alt); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" loading="<?php echo $this->get_lazy_loading_attr(); ?>">
				<?php
				break;
			default:
				if( function_exists('ipq_get_theme_image') ) {
					echo ipq_get_theme_image(
						$image_id,
						array(
							array($width, $height, true),
						),
						array(
							'loading' => $this->get_lazy_loading_attr(),
						)
					);
				} else {
					echo wp_get_attachment_image(
						$image_id,
						array($width, $height),
						false,
						array(
							'loading' => $this->get_lazy_loading_attr(),
						)
					);
				}

				break;
		}

		++$this->image_count;

	}
}
