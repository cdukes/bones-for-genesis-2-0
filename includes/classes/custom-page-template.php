<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Starter class for a custom template template.
 * Include template code here so that it can be routed using the 'wp' action, which isn't available in the page template file.
 *
 * @since 20180728
 */
class BFG_Custom_Page extends BFG_Abstract_Page_Template {
	protected $post;

	protected $post_id;

	public function __construct($post) {

		// Save global $post as a class property, to avoid calling the global later, and for use in the template abstract
		$this->post = $post;

		// Save the post_id as a class property, for easy access
		$this->post_id = $this->post->ID;

		/**
		 * WP 5.9's wp_omit_loading_attr_threshold() only applies to images in post_content
		 * For a custom page, it may make sense to disable wp_omit_loading_attr_threshold()
		 *
		 * @since 20220126
		 */
		// add_filter( 'wp_omit_loading_attr_threshold', '__return_false' );

		add_action( 'genesis_entry_content', array($this, 'display_content') );

	}

	public function display_content() {

		// Custom template content
		// See Abstract_Page_Template for helper methods

	}
}

add_action( 'wp', 'bfg_init_custom_page' );
/**
 * Delay template routing until the 'wp' action, so that the WP conditional functions are accessible.
 *
 * @since 20180728
 */
function bfg_init_custom_page() {

	global $post;

	// Stop if not a single page
	if( !is_singular( 'page' ) )
		return;

	// Stop if not the target page template
	if( get_page_template_slug() !== 'page_templates/page_custom.php' )
		return;

	new BFG_Custom_Page($post);

}
