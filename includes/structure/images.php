<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Get image size name
 *
 * @since 20220829
 */
function bfg_get_image_size_name($width, $height, $crop = false) {

	return 'bfg-' . $width . 'x' . $height . '-' . ($crop ? 'true' : 'false');

}

/*
 * Resize image
 *
 * @since 20220829
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
	if( $size['width'] < $width )
		return;

	if( $size['height'] < $height )
		return;

	if( is_wp_error($editor) )
		return $editor;

	$resize = $editor->resize( $width, $height, $crop );
	if( is_wp_error($resize) )
		return $resize;

	$file = $editor->save();
	if( is_wp_error($file) )
		return $file;

	$meta['sizes'][$size_name] = array(
		'file'      => $file['file'],
		'width'     => $file['width'],
		'height'    => $file['height'],
		'mime-type' => $file['mime-type'],
	);

	wp_update_attachment_metadata( $image_id, $meta );

}

/*
 * Resize image and return HTML
 *
 * @since 20220829
 */
function bfg_get_image($image_id, $width, $height, $crop = false, $atts = array()) {

	$mime_type = get_post_mime_type($image_id);
	if( in_array($mime_type, array('application/pdf'), true) )
		return;

	if( $mime_type === 'image/svg+xml' ) {
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

		$atts['src']    = wp_get_attachment_url( $image_id );
		$atts['alt']    = esc_attr($alt);
		$atts['width']  = $width;
		$atts['height'] = $height;

		$atts = array_merge( $atts, wp_get_loading_optimization_attributes( 'img', $atts, 'wp_get_attachment_image' ) );

		ob_start();
		?>
		<img
			<?php
			foreach( $atts as $key => $value )
				echo $key . '="' . $value . '" ';
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

/*
 * Resize image and return url
 *
 * @since 20220829
 */
function bfg_get_image_url($image_id, $width, $height, $crop = false) {

	$response = bfg_process_image($image_id, $width, $height, $crop);
	if( is_wp_error($response) )
		return '';

	$size_name = bfg_get_image_size_name($width, $height, $crop);

	$src = wp_get_attachment_image_src( $image_id, $size_name );

	return $src[0] ?? false;

}
