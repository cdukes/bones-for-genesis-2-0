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

		echo wpautop($value);

	}

	protected function display_icon($key, $parent = false) {

		$value = $this->get_value($key, $parent);

		if( empty($value) )
			return;

		echo bfg_get_icon($value);

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

	protected function display_image($key, $width, $height, $crop = true, $parent = false) {

		$image_id = $this->get_value($key, $parent);
		if( empty($image_id) )
			return;

		$mime_type = get_post_mime_type($image_id);
		switch($mime_type) {
			case 'image/svg+xml':
				$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

				if( empty($width) && empty($height) ) {
					$path = get_attached_file($image_id);
					if( file_exists($path) ) {
						$data = file_get_contents($path);

						preg_match('/<svg (.+?)>/', $data, $matches);
						if( !empty($matches[1]) ) {
							preg_match('/width="(\d+)"/', $matches[1], $w);
							if( !empty($w[1]) )
								$width = absint($w[1]);

							preg_match('/height="(\d+)"/', $matches[1], $h);
							if( !empty($h[1]) )
								$height = absint($h[1]);
						}

						if( empty($width) || empty($height) ) {
							preg_match('/viewBox="([\d\.]+) ([\d\.]+) ([\d\.]+) ([\d\.]+)"/', $data, $box);
							if( !empty($box) ) {
								$width  = round((float) $box[3] - (float) $box[1]);
								$height = round((float) $box[4] - (float) $box[2]);
							}
						}
					}
				}

				?>
				<img src="<?php echo wp_get_attachment_url( $image_id ); ?>" alt="<?php echo esc_attr($alt); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" loading="<?php echo $this->get_lazy_loading_attr(); ?>">
				<?php
				break;
			default:
				echo bfg_get_image(
					$image_id,
					$width,
					$height,
					$crop,
					array(
						'loading' => $this->get_lazy_loading_attr(),
					)
				);

				break;
		}

		++$this->image_count;

	}
}
