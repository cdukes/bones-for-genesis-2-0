<?php

namespace BFG;

if( !\defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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

/*
 * Remove 'Recent Comments' widget injected styles.
 *
 * @since 1.x
 */
add_filter( 'show_recent_comments_widget_style', '__return_false' );
