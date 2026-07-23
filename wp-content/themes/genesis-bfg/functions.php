<?php
/**
 * Theme bootstrap: defines constants and requires every include file.
 *
 * @package BFG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'CHILD_THEME_TEXT_DOMAIN', 'bfg' );

$use_production_assets = 'production' === wp_get_environment_type();
define( 'BFG_PRODUCTION', $use_production_assets );

// Initialize Genesis
require_once get_template_directory() . '/lib/init.php';

// Composer
require_once CHILD_DIR . '/vendor/autoload.php';

// Developer Tools
require_once CHILD_DIR . '/includes/developer-tools.php';

// Genesis
require_once CHILD_DIR . '/includes/genesis.php';               // Customizations to Genesis-specific functions

// Admin
require_once CHILD_DIR . '/includes/admin/admin-functions.php'; // Customization to admin functionality
require_once CHILD_DIR . '/includes/admin/admin-views.php';     // Customizations to the admin area display
require_once CHILD_DIR . '/includes/admin/admin-branding.php';  // Admin view customizations that specifically involve branding
require_once CHILD_DIR . '/includes/admin/admin-options.php';   // For adding/editing theme options to Genesis
require_once CHILD_DIR . '/includes/admin/admin-security.php';  // Password/account hardening (e.g. pwned password checks)

// Structure (corresponds to Genesis's lib/structure)
require_once CHILD_DIR . '/includes/structure/comments.php';
require_once CHILD_DIR . '/includes/structure/footer.php';
require_once CHILD_DIR . '/includes/structure/gravity-forms.php';
require_once CHILD_DIR . '/includes/structure/head.php';
require_once CHILD_DIR . '/includes/structure/header.php';
require_once CHILD_DIR . '/includes/structure/icons.php';
require_once CHILD_DIR . '/includes/structure/images.php';
require_once CHILD_DIR . '/includes/structure/layout.php';
require_once CHILD_DIR . '/includes/structure/loops.php';
require_once CHILD_DIR . '/includes/structure/menu.php';
require_once CHILD_DIR . '/includes/structure/post.php';
require_once CHILD_DIR . '/includes/structure/search.php';
require_once CHILD_DIR . '/includes/structure/sidebar.php';

// Shame
require_once CHILD_DIR . '/includes/shame.php';                 // For new code snippets that haven't been sorted and commented yet

// Classes
require_once CHILD_DIR . '/includes/classes/abstracts/template.php';
require_once CHILD_DIR . '/includes/classes/custom-page-template.php';
