<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'genesis_attr_search-form', 'bfg_unset_role_attribute' );
add_filter( 'genesis_attr_sidebar-primary', 'bfg_unset_role_attribute' );
/**
 * Remove unnecessary role attributes.
 *
 * @since 2.3.17
 *
 * See: https://validator.w3.org/
 */
function bfg_unset_role_attribute($attributes) {

	if( isset($attributes['role']) )
		unset($attributes['role']);

	return $attributes;

}

// add_action( 'init', 'bfg_disable_genesis_schema' );
/**
 * Disable Genesis schema, such as if using Yoast SEO.
 *
 * @since 20190513
 *
 * See: https://www.billerickson.net/yoast-schema-with-genesis/#remove-genesis-schema
 */
function bfg_disable_genesis_schema() {

	$contexts = array(
		'head',
		'body',
		'site-header',
		'site-title',
		'site-description',
		'breadcrumb',
		'breadcrumb-link-wrap',
		'breadcrumb-link-wrap-meta',
		'breadcrumb-link',
		'breadcrumb-link-text-wrap',
		'search-form',
		'search-form-meta',
		'search-form-input',
		'nav-primary',
		'nav-secondary',
		'nav-header',
		'nav-link-wrap',
		'nav-link',
		'entry',
		'entry-image',
		'entry-image-widget',
		'entry-image-grid-loop',
		'entry-author',
		'entry-author-link',
		'entry-author-name',
		'entry-time',
		'entry-modified-time',
		'entry-title',
		'entry-content',
		'comment',
		'comment-author',
		'comment-author-link',
		'comment-time',
		'comment-time-link',
		'comment-content',
		'author-box',
		'sidebar-primary',
		'sidebar-secondary',
		'site-footer',
	);

	foreach( $contexts as $context )
		add_filter( 'genesis_attr_' . $context, 'bfg_remove_schema_attributes', 20 );

}

function bfg_remove_schema_attributes($props) {

	$attrs = array(
		'itemprop',
		'itemtype',
		'itemscope',
	);

	foreach( $attrs as $attr ) {
		if( !isset($props[$attr]) )
			continue;

		unset($props[$attr]);
	}

	return $props;

}
