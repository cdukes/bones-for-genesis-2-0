<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_loop', 'bfg_do_breadcrumbs' );
/*
 * Use WordPress SEO's breadcrumbs when available
 *
 * @since 2.3.11
 */
function bfg_do_breadcrumbs() {

	if( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<p class="breadcrumbs">', '</p>' );
	} else {
		genesis_do_breadcrumbs();
	}

}
