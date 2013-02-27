<?php
add_action( 'genesis_setup','bfg_theme_setup', 15);
function bfg_theme_setup() {
	// Customizing Genesis
	include_once( CHILD_DIR . '/includes/admin.php' );
	include_once( CHILD_DIR . '/includes/genesis_save_custom_fields_fix.php' );
	add_action( 'admin_menu', 'bfg_disable_dashboard_widgets' );
	add_action( 'widgets_init', 'bfg_remove_genesis_widgets', 20 );
	add_filter( 'default_hidden_meta_boxes', 'bfg_hidden_meta_boxes', 2);
	// add_action( 'init', 'bfg_remove_layout_meta_boxes' );
	add_filter( 'tiny_mce_before_init', 'bfg_remove_tinymce_tags' );
	add_filter('user_contactmethods', 'bfg_remove_profile_fields');
	//add_action( 'login_enqueue_scripts', 'bfg_login_logo' );
	add_filter( 'login_headerurl', 'bfg_login_logo_url' );
	add_filter( 'login_headertitle', 'bfg_login_logo_url_title' );
	//add_filter('login_redirect', 'bfg_login_redirect', 10, 3);

	// genesis_unregister_layout( 'content-sidebar' );
	// genesis_unregister_layout( 'sidebar-content' );
	// genesis_unregister_layout( 'content-sidebar-sidebar' );
	// genesis_unregister_layout( 'sidebar-sidebar-content' );
	// genesis_unregister_layout( 'sidebar-content-sidebar' );
	// genesis_unregister_layout( 'full-width-content' );
	// unregister_sidebar( 'header-right' );
	// unregister_sidebar( 'sidebar-alt' );
	// unregister_sidebar( 'sidebar' );

	// add_theme_support( 'custom-background' );
	// add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ));
	// add_theme_support( 'genesis-post-format-images' );
	// add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 90 ) );
	// add_theme_support( 'genesis-footer-widgets', 3 );

	show_admin_bar( false );

	// Bones
	include_once( CHILD_DIR . '/includes/bones.php' );
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	add_action( 'wp_enqueue_scripts', 'bfg_scripts_and_styles', 999);
	add_filter( 'style_loader_tag', 'bfg_ie_conditional', 10, 2 );
	add_action( 'genesis_meta', 'bfg_viewport_meta' );
	add_filter( 'http_request_args', 'bfg_dont_update', 5, 2 );
	add_filter( 'the_content', 'bfg_filter_ptags_on_images' );
	add_filter( 'wp_head', 'bfg_remove_wp_widget_recent_comments_style', 1 );
	add_action( 'wp_head', 'bfg_remove_recent_comments_style', 1);
	add_filter( 'gallery_style', 'bfg_gallery_style' );
	//add_filter( 'genesis_pre_load_favicon', 'bfg_load_favicon' );

	// Head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
}
?>