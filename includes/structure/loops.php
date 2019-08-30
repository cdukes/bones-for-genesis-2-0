<?php

namespace BFG;

if( !\defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_filter( 'wpseo_breadcrumb_separator', __NAMESPACE__ . '\\wpseo_breadcrumb_separator' );
/**
 * Replace the Yoast SEO breadcrumb separator character with an SVG icon.
 *
 * @since 20180406
 */
function wpseo_breadcrumb_separator($sep) {

	return get_inline_icon('angle-right');

}
