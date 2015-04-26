<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
// add_action( 'genesis_before_loop', 'bfg_do_taxonomy_title_description', 15 );
/**
 * Fallback to the term title/description, if the Genesis term meta fields aren't filled out.
 *
 * @since 2.0.19
 */
function bfg_do_taxonomy_title_description() {

	global $wp_query;

	if( !is_category() && !is_tag() && !is_tax() )
		return;

	if( get_query_var( 'paged' ) >= 2 )
		return;

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

	if( !$term || !isset( $term->meta ) )
		return;

	$headline = $intro_text = '';

	$headline = $term->meta['headline'] ? sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->meta['headline'] ) ) : sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->name ) );

	$intro_text = $term->meta['intro_text'] ? apply_filters( 'genesis_term_intro_text_output', $term->meta['intro_text'] ) : apply_filters( 'genesis_term_intro_text_output', $term->description );

	if ( $headline || $intro_text )
		printf( '<div class="archive-description taxonomy-description">%s</div>', $headline . $intro_text );

}
