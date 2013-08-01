<?php
add_filter( 'the_content', 'bfg_remove_ptags_on_images' );
/**
 * Remove <p> tags from around images
 *
 * See: http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 *
 * @since 1.x
 */
function bfg_remove_ptags_on_images( $content ){

	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );

}

add_filter( 'gallery_style', 'bfg_gallery_style' );
/**
 * Remove the injected styles for the [gallery] shortcode
 *
 * @since 1.x
 */
function bfg_gallery_style( $css ) {

	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );

}

// add_filter( 'genesis_post_info', 'bfg_post_info' );
/**
 * Customize the post info text
 *
 * See:http://www.briangardner.com/code/customize-post-info/
 *
 * @since 2.0.0
 */
function bfg_post_info() {

	return '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';

}

// add_filter( 'genesis_post_meta', 'bfg_post_meta' );
/**
 * Customize the post meta text
 *
 * See:http://www.briangardner.com/code/customize-post-meta/
 *
 * @since 2.0.0
 */
function bfg_post_meta() {

	return '[post_categories before="Filed Under: "] [post_tags before="Tagged: "]';

}

// add_filter ( 'genesis_prev_link_text' , 'bfg_prev_link_text' );
/**
 * Customize the post navigation prev text
 * (Only applies to the 'Previous/Next' Post Navigation Technique, set in Genesis > Theme Options)
 *
 * @since 2.0.0
 */
function bfg_prev_link_text( $text ) {

    return html_entity_decode('&#10216;') . ' ';

}

// add_filter ( 'genesis_next_link_text' , 'bfg_next_link_text' );
/**
 * Customize the post navigation next text
 * (Only applies to the 'Previous/Next' Post Navigation Technique, set in Genesis > Theme Options)
 *
 * @since 2.0.0
 */
function bfg_next_link_text( $text ) {

    return ' ' . html_entity_decode('&#10217;');

}

// add_filter( 'genesis_older_link_text', 'bfg_older_link_text' );
/**
 * Customize the post navigation 'older' text
 * (Only applies to the 'Older/Newer' Post Navigation Technique, set in Genesis > Theme Options)
 *
 * @since 2.0.5
 */
function bfg_older_link_text() {

	return html_entity_decode('&#10216;') . ' Older';

}

// add_filter( 'genesis_newer_link_text', 'bfg_newer_link_text' );
/**
 * Customize the post navigation 'newer' text
 * (Only applies to the 'Older/Newer' Post Navigation Technique, set in Genesis > Theme Options)
 *
 * @since 2.0.5
 */
function bfg_newer_link_text() {

	return 'Newer ' . html_entity_decode('&#10217;');

}

/**
 * Remove the post title
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_post_title', 'genesis_do_post_title' );

/**
 * Remove the post edit links (maybe you just want to use the admin bar)
 *
 * @since 2.0.9
 */
// add_filter( 'edit_post_link', '__return_false' );