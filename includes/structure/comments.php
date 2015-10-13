<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Remove comments frontend. Useful if replacing WP commenting with Disqus.
 *
 * @since 2.0.10
 */
// remove_action( 'genesis_comments', 'genesis_do_comments' );
// remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );

/*
 * Remove pings frontend.
 *
 * @since 2.0.16
 */
// remove_action( 'genesis_pings', 'genesis_do_pings' );

/*
 * Remove the entire comments area frontend, including comments, reply form, and pings.
 *
 * @since 2.0.16
 */
// remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );

