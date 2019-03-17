<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'genesis_attr_body', 'bfg_ajax_url_attribute' );
/**
 * Add the AJAX URL as a `data-*` attribute on `<body>`, instead of an inline script, for better CSP compatibility.
 *
 * @since 2.3.46
 */
function bfg_ajax_url_attribute($atts) {

	$atts['data-ajax_url'] = add_query_arg(
		array(
			'action' => ':action',
		),
		admin_url( 'admin-ajax.php' )
	);

	return $atts;

}

add_filter( 'body_class', 'bfg_no_js_body_class' );
/**
 * Add a no-js class to the <body> tag.
 *
 * @since 2.3.51
 */
function bfg_no_js_body_class($classes) {

	$classes[] = 'no-js';
	$classes[] = 'no-svg';

	return $classes;

}

/*
 * Remove the header
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
// remove_action( 'genesis_header', 'genesis_do_header' );
// remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

/*
 * Remove the site title and/or description
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
