<?php
// Initialize Genesis
include_once( get_template_directory() . '/lib/init.php' );

// Child theme definitions
define( 'CHILD_THEME_NAME', 'Bones for Genesis 2.0' );
define( 'CHILD_THEME_URL', 'http://bonesforgenesis.com/' );
define( 'CHILD_THEME_VERSION', '2.0.18' );

// Developer Tools
// include_once( CHILD_DIR . '/includes/developer-tools.php' );		// DO NOT USE THESE ON A LIVE SITE

// Genesis
include_once( CHILD_DIR . '/includes/genesis.php' );				// Customizations to Genesis-specific functions

// Admin
include_once( CHILD_DIR . '/includes/admin/admin-functions.php' );	// Customization to admin functionality
include_once( CHILD_DIR . '/includes/admin/admin-views.php' );		// Customizations to the admin area display
include_once( CHILD_DIR . '/includes/admin/admin-branding.php' );	// Admin view customizations that specifically involve branding
include_once( CHILD_DIR . '/includes/admin/admin-options.php' );	// For adding/editing theme options to Genesis

// Structure (corresponds to Genesis's lib/structure)
include_once( CHILD_DIR . '/includes/structure/archive.php' );
include_once( CHILD_DIR . '/includes/structure/comments.php' );
include_once( CHILD_DIR . '/includes/structure/footer.php' );
include_once( CHILD_DIR . '/includes/structure/header.php' );
include_once( CHILD_DIR . '/includes/structure/layout.php' );
include_once( CHILD_DIR . '/includes/structure/loops.php' );
include_once( CHILD_DIR . '/includes/structure/menu.php' );
include_once( CHILD_DIR . '/includes/structure/post.php' );
include_once( CHILD_DIR . '/includes/structure/search.php' );
include_once( CHILD_DIR . '/includes/structure/sidebar.php' );

// Shame
include_once( CHILD_DIR . '/includes/shame.php' );					// For new code snippets that haven't been sorted and commented yet