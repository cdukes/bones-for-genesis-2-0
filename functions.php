<?php

namespace BFG;

if( !\defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Child theme constants.
 */
\define( __NAMESPACE__ . '\SLUG', \mb_strtolower(__NAMESPACE__) );

\define( 'CHILD_THEME_NAME', 'Bones for Genesis 2.0' );
\define( 'CHILD_THEME_URL', 'https://github.com/cdukes/bones-for-genesis-2-0' );
\define( 'CHILD_THEME_TEXT_DOMAIN', \mb_strtolower(__NAMESPACE__) );

$use_production_assets = get_option('options__' . SLUG . '_is_production');
$use_production_assets = !empty($use_production_assets);
\define( __NAMESPACE__ . '\PRODUCTION', $use_production_assets );

$assets_version = get_option('options__' . SLUG . '_version');
$assets_version = !empty($assets_version) ? absint($assets_version) : null;
\define( __NAMESPACE__ . '\VERSION', $assets_version );

// Never show errors on production
// https://stackoverflow.com/questions/9242903/php-hide-all-errors
if( PRODUCTION ) {
	\error_reporting(0);
	\ini_set('display_errors', 0);
}

/**
 * Include required core files used in admin and on the frontend.
 */

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
require_once CHILD_DIR . '/includes/structure/schema.php';
require_once CHILD_DIR . '/includes/structure/search.php';
require_once CHILD_DIR . '/includes/structure/sidebar.php';

// Shame
require_once CHILD_DIR . '/includes/shame.php';					// For new code snippets that haven't been sorted and commented yet

require_once CHILD_DIR . '/includes/classes/abstracts/template.php';

// Classes
require_once CHILD_DIR . '/includes/classes/custom-page-template.php';
