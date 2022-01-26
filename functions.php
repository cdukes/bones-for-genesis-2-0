<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists( 'BFG' ) ) {

final class BFG {
	private static $instance;

	private static $classes = array(
		'custom-page-template',
	);

	/**
	 * BFG Constructor.
	 */
	public function __construct() {

		$this->define_constants();
		$this->includes();

	}

	public static function get_instance() {

		if( self::$instance === null )
			self::$instance = new self();

		return self::$instance;

	}

	/**
	 * Child theme constants.
	 */
	private function define_constants() {

		define( 'CHILD_THEME_TEXT_DOMAIN', 'bfg' );

		$use_production_assets = wp_get_environment_type() === 'production';
		define( 'BFG_PRODUCTION', $use_production_assets );

		// Never show errors on production
		// https://stackoverflow.com/questions/9242903/php-hide-all-errors
		if( BFG_PRODUCTION && !defined('WP_DEBUG') ) {
			error_reporting(0);
			ini_set('display_errors', 0);
		}

	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {

		// Initialize Genesis
		require_once get_template_directory() . '/lib/init.php';

		// Composer
		require_once CHILD_DIR . '/vendor/autoload.php';

		// Developer Tools
		require_once CHILD_DIR . '/includes/developer-tools.php';

		// Genesis
		require_once CHILD_DIR . '/includes/genesis.php';				// Customizations to Genesis-specific functions

		// Admin
		require_once CHILD_DIR . '/includes/admin/admin-functions.php';	// Customization to admin functionality
		require_once CHILD_DIR . '/includes/admin/admin-views.php';		// Customizations to the admin area display
		require_once CHILD_DIR . '/includes/admin/admin-branding.php';	// Admin view customizations that specifically involve branding
		require_once CHILD_DIR . '/includes/admin/admin-options.php';	// For adding/editing theme options to Genesis

		// Structure (corresponds to Genesis's lib/structure)
		require_once CHILD_DIR . '/includes/structure/comments.php';
		require_once CHILD_DIR . '/includes/structure/footer.php';
		require_once CHILD_DIR . '/includes/structure/gravity-forms.php';
		require_once CHILD_DIR . '/includes/structure/head.php';
		require_once CHILD_DIR . '/includes/structure/header.php';
		require_once CHILD_DIR . '/includes/structure/icons.php';
		require_once CHILD_DIR . '/includes/structure/layout.php';
		require_once CHILD_DIR . '/includes/structure/loops.php';
		require_once CHILD_DIR . '/includes/structure/menu.php';
		require_once CHILD_DIR . '/includes/structure/post.php';
		require_once CHILD_DIR . '/includes/structure/search.php';
		require_once CHILD_DIR . '/includes/structure/sidebar.php';

		// Shame
		require_once CHILD_DIR . '/includes/shame.php';					// For new code snippets that haven't been sorted and commented yet

		require_once CHILD_DIR . '/includes/classes/abstracts/template.php';

		// Classes
		foreach( self::$classes as $key )
			$this->{$key} = require_once CHILD_DIR . '/includes/classes/' . $key . '.php';

	}
}

}

function BFG() {

	return BFG::get_instance();

}

// Global for backwards compatibility.
$GLOBALS['bfg'] = BFG();
