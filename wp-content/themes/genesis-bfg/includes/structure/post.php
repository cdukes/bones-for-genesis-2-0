<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Remove the injected styles for the [gallery] shortcode.
 *
 * @since 1.x
 */
add_filter( 'gallery_style', 'bfg_gallery_style' );
function bfg_gallery_style($css) {

	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

/**
 * Allow pages to have excerpts.
 *
 * @since 2.2.5
 */
add_post_type_support( 'page', 'excerpt' );

/**
 * Allow pages to have <footer>s.
 *
 * @since 20180210
 */
// add_post_type_support( 'page', 'genesis-entry-meta-after-content' );

/**
 * Customize the excerpt text, when using the <!--more--> tag.
 *
 * See: http://my.studiopress.com/snippets/post-excerpts/
 *
 * @since 2.0.16
 */
add_filter( 'the_content_more_link', 'bfg_more_tag_excerpt_link' );
function bfg_more_tag_excerpt_link() {

	return ' <a class="more-link" href="' . get_permalink() . '">' . __( 'Read more &rarr;', 'bfg' ) . '</a>';
}

/**
 * Customize the excerpt text, when using automatic truncation.
 *
 * See: http://my.studiopress.com/snippets/post-excerpts/
 *
 * @since 2.0.16
 */
add_filter( 'excerpt_more', 'bfg_truncated_excerpt_link' );
add_filter( 'get_the_content_more_link', 'bfg_truncated_excerpt_link' );
function bfg_truncated_excerpt_link() {

	return '... <a class="more-link" href="' . get_permalink() . '">' . __( 'Read more &rarr;', 'bfg' ) . '</a>';
}

// remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
// add_filter( 'genesis_post_info', 'bfg_post_info' );
/**
 * Customize the post info text.
 *
 * See:http://www.briangardner.com/code/customize-post-info/
 *
 * @since 2.0.0
 */
function bfg_post_info() {

	return '[post_date] ' . __( 'by', 'bfg' ) . ' [post_author_posts_link] [post_comments] [post_edit]';
	// Friendly note: use [post_author] to return the author's name, without an archive link
}

// remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// add_filter( 'genesis_post_meta', 'bfg_post_meta' );
/**
 * Customize the post meta text.
 *
 * See:http://www.briangardner.com/code/customize-post-meta/
 *
 * @since 2.0.0
 */
function bfg_post_meta() {

	return '[post_categories before="' . __( 'Filed Under: ', 'bfg' ) . '"] [post_tags before="' . __( 'Tagged: ', 'bfg' ) . '"]';
}

/**
 * Customize the post navigation prev text
 * (Only applies to the 'Previous/Next' Post Navigation Technique, set in Genesis > Theme Options).
 *
 * @since 2.0.0
 */
add_filter( 'genesis_prev_link_text', 'bfg_prev_link_text' );
function bfg_prev_link_text($text) {

	return html_entity_decode( '&#10216;' ) . ' ';
}

/**
 * Customize the post navigation next text
 * (Only applies to the 'Previous/Next' Post Navigation Technique, set in Genesis > Theme Options).
 *
 * @since 2.0.0
 */
add_filter( 'genesis_next_link_text', 'bfg_next_link_text' );
function bfg_next_link_text($text) {

	return ' ' . html_entity_decode( '&#10217;' );
}

/**
 * Remove the post edit links (maybe you just want to use the admin bar).
 *
 * @since 2.0.9
 */
add_filter( 'edit_post_link', '__return_false' );

/**
 * Hide the author box.
 *
 * @since 2.0.18
 */
// add_filter( 'get_the_author_genesis_author_box_single', '__return_false' );
// add_filter( 'get_the_author_genesis_author_box_archive', '__return_false' );

/**
 * Adjust the default WP password protected form to support keeping the input and submit on the same line.
 *
 * @since 2.2.18
 */
add_filter( 'the_password_form', 'bfg_password_form' );
function bfg_password_form($post = 0) {

	$post       = get_post( $post );
	$label      = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );
	$output     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">';
		$autofocus = is_singular() ? 'autofocus' : '';
		$output .= '<input name="post_password" id="' . $label . '" type="password" spellcheck="false" size="20" placeholder="' . __( 'Password', 'bfg' ) . '" ' . $autofocus . '>';
		$output .= '<input type="submit" name="' . __( 'Submit', 'bfg' ) . '" value="' . esc_attr__( 'Submit', 'bfg' ) . '">';
	$output  .= '</form>';

	return $output;
}
