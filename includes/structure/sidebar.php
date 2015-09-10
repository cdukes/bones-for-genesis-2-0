<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Remove the sidebar
 *
 * @since 2.0.10
 */
// remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

/*
 * Remove the secondarysidebar
 *
 * @since 2.2.24
 */
// remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );

/*
 * Allow shortcodes in text widgets
 *
 * @since 2.0.0
 */
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'wp_head', 'bfg_remove_recent_comments_widget_styles', 1 );
/**
 * Remove 'Recent Comments' widget injected styles.
 *
 * @since 1.x
 */
function bfg_remove_recent_comments_widget_styles() {

	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}

}
