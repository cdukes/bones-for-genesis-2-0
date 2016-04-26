<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Only show the admin bar to users who can at least use Posts
 *
 * @since 2.0.0
 */
add_filter( 'show_admin_bar', 'bfg_maybe_hide_admin_bar', 99 );
function bfg_maybe_hide_admin_bar( $default ) {

	return current_user_can( 'edit_posts' ) ? $default : false;

}

add_action( 'admin_menu', 'bfg_remove_dashboard_widgets' );
/**
 * Disable some or all of the default admin dashboard widgets.
 *
 * See: http://digwp.com/2010/10/customize-wordpress-dashboard/
 *
 * @since 1.x
 */
function bfg_remove_dashboard_widgets() {

	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );				// Right Now
	// remove_meta_box( 'dashboard_activity', 'dashboard', 'core' );				// Activity
	// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );			// Comments
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );				// Incoming Links
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );					// Plugins
	// remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );				// Quick Press
	// remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );			// Recent Drafts
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );					// WordPress Blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );					// Other WordPress News
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );					// WordPress SEO by Yoast

}

add_action('widgets_init', 'bfg_unregister_default_widgets');
/**
 * Disable some or all of the default widgets.
 *
 * @since 2.0.0
 */
function bfg_unregister_default_widgets() {

	// unregister_widget( 'WP_Widget_Pages' );
	// unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Meta' );
	// unregister_widget( 'WP_Widget_Search' );
	// unregister_widget( 'WP_Widget_Text' );
	// unregister_widget( 'WP_Widget_Categories' );
	// unregister_widget( 'WP_Widget_Recent_Posts' );
	// unregister_widget( 'WP_Widget_Recent_Comments' );
	// unregister_widget( 'WP_Widget_RSS' );
	// unregister_widget( 'WP_Widget_Tag_Cloud' );
	// unregister_widget( 'WP_Nav_Menu_Widget' );

}

add_filter( 'default_hidden_meta_boxes', 'bfg_hidden_meta_boxes', 2 );
/**
 * Change which meta boxes are hidden by default on the post and page edit screens.
 *
 * @since 2.0.0
 */
function bfg_hidden_meta_boxes( $hidden ) {

	global $current_screen;
	if( 'post' === $current_screen->id ) {
		$hidden = array('postexcerpt', 'trackbacksdiv', 'postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv');
		// Other hideable post boxes: genesis_inpost_scripts_box, commentsdiv, categorydiv, tagsdiv, postimagediv
	} elseif( 'page' === $current_screen->id ) {
		$hidden = array('postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv', 'postimagediv');
		// Other hideable post boxes: genesis_inpost_scripts_box, pageparentdiv
	}

	return $hidden;

}

// add_action( 'admin_footer-post-new.php', 'bfg_media_manager_default_view' );
// add_action( 'admin_footer-post.php', 'bfg_media_manager_default_view' );
/**
 * Change the media manager default view to 'upload', instead of 'library'.
 *
 * See: http://wordpress.stackexchange.com/questions/96513/how-to-make-upload-filesselected-by-default-in-insert-media
 *
 * @since 2.0.11
 */
function bfg_media_manager_default_view() {

	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
		});
	</script>
	<?php

}

// add_filter( 'posts_where', 'bfg_restrict_attachment_viewing' );
/**
 * Prevent authors and contributors from seeing media that isn't theirs.
 *
 * See: http://wordpress.org/support/topic/restrict-editors-from-viewing-media-that-others-have-uploaded
 *
 * @since 2.0.20
 */
function bfg_restrict_attachment_viewing( $where ) {

	global $current_user;
	if(
		is_admin() &&
		!current_user_can('edit_others_posts') &&
		isset($_POST['action']) &&
		$_POST['action'] === 'query-attachments'
	) {
		$where .= ' AND post_author=' . $current_user->data->ID;
	}

	return $where;

}

// add_action( 'admin_init', 'bfg_add_editor_style' );
/*
 * Add a stylesheet for TinyMCE
 *
 * @since 2.0.0
 */
function bfg_add_editor_style() {

	$use_production_assets = genesis_get_option('bfg_production_on');
	$use_production_assets = !empty($use_production_assets);
	$src                   = $use_production_assets ? '/build/css/editor-style.min.css' : '/build/css/editor-style.css';
	add_editor_style( get_stylesheet_directory_uri() . $src );

}

add_filter( 'tiny_mce_before_init', 'bfg_tiny_mce_before_init' );
/**
 * Modifies the TinyMCE settings array.
 *
 * See: https://core.trac.wordpress.org/ticket/29360
 *
 * @since 2.0.0
 */
function bfg_tiny_mce_before_init( $options ) {

	$options['element_format']   = 'html'; // See: http://www.tinymce.com/wiki.php/Configuration:element_format
	$options['schema']           = 'html5-strict'; // Only allow the elements that are in the current HTML5 specification. See: http://www.tinymce.com/wiki.php/Configuration:schema
	$options['block_formats']    = 'Paragraph=p;Header 2=h2;Header 3=h3;Header 4=h4;Blockquote=blockquote'; // Restrict the block formats available in TinyMCE. See: http://www.tinymce.com/wiki.php/Configuration:block_formats
	$options['wp_autoresize_on'] = false;

	return $options;

}

add_filter( 'mce_buttons', 'bfg_tinymce_buttons' );
/**
 * Enables some commonly used formatting buttons in TinyMCE. A good resource on customizing TinyMCE: http://www.wpexplorer.com/wordpress-tinymce-tweaks/.
 *
 * @since 2.0.15
 */
function bfg_tinymce_buttons( $buttons ) {

	$buttons[] = 'wp_page';															// Post pagination
	return $buttons;

}

add_filter( 'user_contactmethods', 'bfg_user_contactmethods' );
/**
 * Updates the user profile contact method fields for today's popular sites.
 *
 * See: http://wpmu.org/shun-the-plugin-100-wordpress-code-snippets-from-across-the-net/
 *
 * @since 2.0.0
 */
function bfg_user_contactmethods( $fields ) {

	// $fields['facebook'] = 'Facebook';												// Add Facebook
	// $fields['twitter'] = 'Twitter';												// Add Twitter
	// $fields['linkedin'] = 'LinkedIn';												// Add LinkedIn
	unset( $fields['aim'] );														// Remove AIM
	unset( $fields['yim'] );														// Remove Yahoo IM
	unset( $fields['jabber'] );														// Remove Jabber / Google Talk
	return $fields;

}

// add_action( 'admin_menu', 'bfg_remove_dashboard_menus' );
/**
 * Remove default admin dashboard menus.
 *
 * @since 2.0.0
 */
function bfg_remove_dashboard_menus() {

	remove_menu_page('index.php'); // Dashboard tab
	remove_menu_page('edit.php'); // Posts
	remove_menu_page('upload.php'); // Media
	remove_menu_page('edit.php?post_type=page'); // Pages
	remove_menu_page('edit-comments.php'); // Comments
	remove_menu_page('genesis'); // Genesis
	remove_menu_page('themes.php'); // Appearance
	remove_menu_page('plugins.php'); // Plugins
	remove_menu_page('users.php'); // Users
	remove_menu_page('tools.php'); // Tools
	remove_menu_page('options-general.php'); // Settings

}

add_filter( 'login_errors', 'bfg_login_errors' );
/**
 * Prevent the failed login notice from specifying whether the username or the password is incorrect.
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function bfg_login_errors() {

	return __( 'Invalid username or password.', CHILD_THEME_TEXT_DOMAIN );

}

add_action( 'admin_head', 'bfg_hide_admin_help_button' );
/**
 * Hide the top-right help pull-down button by adding some CSS to the admin <head>.
 *
 * See: http://speckyboy.com/2011/04/27/20-snippets-and-hacks-to-make-wordpress-user-friendly-for-your-clients/
 *
 * @since 2.0.0
 */
function bfg_hide_admin_help_button() {

	?><style type="text/css">
		#contextual-help-link-wrap {
			display: none !important;
		}
	</style>
	<?php

}

/**
 * Deregister Genesis parent theme page templates.
 *
 * See: http://wptheming.com/2014/04/features-wordpress-3-9/
 *
 * @since 2.2.8
 */
// add_filter( 'theme_page_templates', 'bfg_deregister_page_templates' );
function bfg_deregister_page_templates( $templates ) {

	unset($templates['page_archive.php']);
	unset($templates['page_blog.php']);

	return $templates;

}

add_action( 'admin_bar_menu', 'bfg_admin_menu_plugins_node' );
/**
 * Add a plugins link to the appearance admin bar menu.
 *
 * @since 2.2.9
 */
function bfg_admin_menu_plugins_node( $wp_admin_bar ) {

	if( !current_user_can('install_plugins') )
		return;

	$node = array(
		'parent' => 'appearance',
		'id'     => 'plugins',
		'title'  => __( 'Plugins', CHILD_THEME_TEXT_DOMAIN ),
		'href'   => admin_url('plugins.php'),
	);

	$wp_admin_bar->add_node( $node );

}

add_action( 'do_meta_boxes', 'bfg_remove_meta_boxes' );
/**
 * Remove WP default meta boxes. You should always unhook 'Custom Fields', since it can be a large query.
 *
 * @since 2.3.30
 */
function bfg_remove_meta_boxes() {

	// Post
	// remove_meta_box( 'authordiv', 'post', 'normal' );
	// remove_meta_box( 'categorydiv', 'post', 'side' );
	// remove_meta_box( 'commentsdiv', 'post', 'normal' );
	// remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
	remove_meta_box( 'postcustom', 'post', 'normal' );
	// remove_meta_box( 'postexcerpt', 'post', 'normal' );
	// remove_meta_box( 'postimagediv', 'post', 'side' );
	// remove_meta_box( 'revisionsdiv', 'post', 'normal' );
	// remove_meta_box( 'slugdiv', 'post', 'normal' );
	// remove_meta_box( 'submitdiv', 'post', 'side' );
	// remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
	// remove_meta_box( 'trackbacksdiv', 'post', 'normal' );

	// Page
	// remove_meta_box( 'authordiv', 'page', 'normal' );
	// remove_meta_box( 'commentstatusdiv', 'page', 'normal' );
	// remove_meta_box( 'pageparentdiv', 'page', 'side' );
	remove_meta_box( 'postcustom', 'page', 'normal' );
	// remove_meta_box( 'postimagediv', 'page', 'side' );
	// remove_meta_box( 'slugdiv', 'page', 'normal' );
	// remove_meta_box( 'submitdiv', 'page', 'side' );

}
