<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get image size name.
 *
 * @since 20220829
 *
 * @param int  $width  Image width in pixels.
 * @param int  $height Image height in pixels.
 * @param bool $crop   Whether to hard crop to the given dimensions.
 *
 * @return string The generated image size name.
 */
function bfg_get_image_size_name($width, $height, $crop = false) {

	return 'bfg-' . $width . 'x' . $height . '-' . ($crop ? 'true' : 'false');

}

/**
 * Resize image.
 *
 * @since 20220829
 *
 * @param int  $image_id The attachment ID.
 * @param int  $width    Target width in pixels.
 * @param int  $height   Target height in pixels.
 * @param bool $crop     Whether to hard crop to the given dimensions.
 *
 * @return WP_Error|void A WP_Error on failure; otherwise no return value.
 */
function bfg_process_image($image_id, $width, $height, $crop = false) {

	if( empty($width) || empty($height) )
		return new WP_Error( 'invalid_size', sprintf( __('Invalid dimensions: %dx%d', CHILD_THEME_TEXT_DOMAIN), $width, $height ) );

	$size_name = bfg_get_image_size_name($width, $height, $crop);

	$meta = wp_get_attachment_metadata( $image_id );
	if( isset( $meta['sizes'][$size_name] ) )
		return;

	$path = get_attached_file( $image_id );
	if( empty($path) )
		return new WP_Error( 'not_found', __('Image not found', CHILD_THEME_TEXT_DOMAIN) );

	$editor = wp_get_image_editor( $path );
	if( is_wp_error( $editor ) )
		return $editor;

	$size = $editor->get_size();

	// Source is smaller than the requested crop: don't upscale. No custom size is
	// created, so callers fall back to the full-size image.
	if( (int) $size['width'] < $width || (int) $size['height'] < $height )
		return;

	// Source already matches exactly: full-size is the correct image, so skip.
	if( (int) $size['width'] === $width && (int) $size['height'] === $height )
		return;

	$resize = $editor->resize( $width, $height, $crop );
	if( is_wp_error($resize) )
		return $resize;

	$file = $editor->save();
	if( is_wp_error($file) )
		return $file;

	// Re-read metadata after the (potentially slow) resize/save to narrow the
	// window for clobbering a size added by a concurrent request.
	$meta = wp_get_attachment_metadata( $image_id );
	if( !is_array( $meta ) )
		$meta = array();

	$meta['sizes'][$size_name] = array(
		'file'      => $file['file'],
		'width'     => $file['width'],
		'height'    => $file['height'],
		'mime-type' => $file['mime-type'],
	);

	wp_update_attachment_metadata( $image_id, $meta );

}

/**
 * Resize image and return HTML.
 *
 * @since 20220829
 *
 * @param int   $image_id The attachment ID.
 * @param int   $width    Target width in pixels.
 * @param int   $height   Target height in pixels.
 * @param bool  $crop     Whether to hard crop to the given dimensions.
 * @param array $atts     Additional attributes to add to the image tag.
 *
 * @return string The image HTML, or an empty string on failure.
 */
function bfg_get_image($image_id, $width, $height, $crop = false, $atts = array()) {

	$mime_type = get_post_mime_type($image_id);
	if( in_array($mime_type, array('application/pdf'), true) )
		return;

	// Default to lazy loading
	if( !isset($atts['loading']) )
		$atts['loading'] = 'lazy';

	if( $mime_type === 'image/svg+xml' ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		if( empty($width) && empty($height) ) {
			$path = get_attached_file($image_id);
			if( file_exists($path) ) {
				// Only the opening <svg> tag is needed; avoid reading large files whole.
				$data = '';
				$fh   = fopen($path, 'rb');
				if( $fh ) {
					$data = fread($fh, 8192);
					fclose($fh);
				}

				preg_match('/<svg\s(.+?)>/s', $data, $matches);
				if( !empty($matches[1]) ) {
					preg_match('/width="([\d.]+)/', $matches[1], $w);
					if( !empty($w[1]) )
						$width = round((float) $w[1]);

					preg_match('/height="([\d.]+)/', $matches[1], $h);
					if( !empty($h[1]) )
						$height = round((float) $h[1]);
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

		$atts['src']    = wp_get_attachment_url( $image_id );
		$atts['alt']    = $alt;
		$atts['width']  = $width;
		$atts['height'] = $height;

		ob_start();
		?>
		<img
			<?php
			foreach( $atts as $key => $value )
				echo esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
			?>
		>
		<?php
		return ob_get_clean();
	}

	$response = bfg_process_image($image_id, $width, $height, $crop);
	if( is_wp_error($response) )
		return '';

	$size_name = bfg_get_image_size_name($width, $height, $crop);

	return wp_get_attachment_image( $image_id, $size_name, false, $atts );

}

/**
 * Resize image and return url.
 *
 * @since 20220829
 *
 * @param int  $image_id The attachment ID.
 * @param int  $width    Target width in pixels.
 * @param int  $height   Target height in pixels.
 * @param bool $crop     Whether to hard crop to the given dimensions.
 *
 * @return string The image URL, or an empty string on failure.
 */
function bfg_get_image_url($image_id, $width, $height, $crop = false) {

	$response = bfg_process_image($image_id, $width, $height, $crop);
	if( is_wp_error($response) )
		return '';

	$size_name = bfg_get_image_size_name($width, $height, $crop);

	$src = wp_get_attachment_image_src( $image_id, $size_name );

	return $src[0] ?? '';

}
