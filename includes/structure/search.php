<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// add_filter( 'genesis_search_text', 'bfg_search_text' );
/**
 * Customize the search form input box text.
 *
 * See: http://www.briangardner.com/code/customize-search-form/
 *
 * @since 2.0.0
 */
function bfg_search_text() {

	return esc_attr( __( 'Search Text Goes Here...', CHILD_THEME_TEXT_DOMAIN ) );

}

// add_filter( 'genesis_search_button_text', 'bfg_search_button_text' );
/**
 * Customize the search form input button text.
 *
 * See: http://www.briangardner.com/code/customize-search-form/
 *
 * @since 2.0.0
 */
function bfg_search_button_text($text) {

	return esc_attr( __( 'Click Here...', CHILD_THEME_TEXT_DOMAIN ) );

}

add_filter( 'genesis_attr_search-form-input', 'bfg_search_form_input', 10, 3 );
/**
 * Make the search form input required, to prevent accidental empty search submits.
 *
 * @since 20210407
 */
function bfg_search_form_input($attributes, $context, $args) {

	$attributes['required'] = true;

	return $attributes;

}

add_filter( 'genesis_markup_search-form-submit', 'bfg_search_form_submit', 10, 2 );
/**
 * Make the search form submit a <button>.
 *
 * @since 20200826
 */
function bfg_search_form_submit($false, $args) {

	ob_start();
	?>
	<button
		type="submit"
		class="btn"
	>
		<?php echo $args['params']['value']; ?>
	</button>
	<?php
	return ob_get_clean();

}

add_action( 'do_robots', 'bfg_block_bots_from_search' );
/**
 * Block bots from crawling robots.txt
 *
 * See: https://www.relevanssi.com/knowledge-base/spam-search-blocking/
 *
 * @since 20210702
 */
function rlv_block_botbfg_block_bots_from_searchs_robots_txt() {

	?>
User-agent: *
Disallow: /search/
Disallow: /?s=
	<?php

}
