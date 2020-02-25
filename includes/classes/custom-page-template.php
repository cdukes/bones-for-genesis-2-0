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

		// remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );
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
	if( 'page_templates/page_custom.php' !== get_page_template_slug() )
		return;

	new BFG_Custom_Page($post);

}
