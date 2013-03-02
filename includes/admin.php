<?php
function bfg_disable_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
}


function bfg_remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates' );
    unregister_widget( 'Genesis_Featured_Page' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
    unregister_widget( 'Genesis_Featured_Post' );
    unregister_widget( 'Genesis_Latest_Tweets_Widget' );
}


function bfg_hidden_meta_boxes($hidden) {
	global $current_screen;
	if( 'post' == $current_screen->id ) {
		$hidden = array( 'postexcerpt', 'trackbacksdiv', 'postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv' );
	} elseif( 'page' == $current_screen->id ) {
		$hidden = array( 'postcustom', 'commentstatusdiv', 'commentsdiv', 'slugdiv', 'authordiv' );
	}
	return $hidden;
}


function bfg_remove_layout_meta_boxes() {
    remove_post_type_support( 'post', 'genesis-layouts' );
    remove_post_type_support( 'page', 'genesis-layouts' );
}


function bfg_remove_tinymce_tags($arr){
	$arr['theme_advanced_blockformats'] = 'p,h2,h3,h4,blockquote';
	return $arr;
}


function bfg_remove_profile_fields( $fields ) {
	unset($fields['aim']);
	unset($fields['yim']);
	unset($fields['jabber']);

	return $fields;
}


function bfg_login_logo() {
	echo '<style type="text/css">';
		echo 'body.login div#login h1 a {';
			echo 'background: url(' . get_stylesheet_directory_uri() . '/images/login-logo.png) no-repeat;';
			echo 'padding-bottom: 30px;';
			echo 'width: 320px;';
			echo 'height: 68px;';
		echo '}';
	echo '</style>';
}


function bfg_login_logo_url() {
    return home_url();
}


function bfg_login_logo_url_title() {
    return get_bloginfo( 'name' );
}


function bfg_login_redirect( $redirect_to, $request, $user ){
    if( is_array( $user->roles ) ) {
        if( in_array( 'administrator', $user->roles ) ) {
            return admin_url();
        } else {
            return home_url();
        }
    }
}


function bfg_from_email_address( $email ) {
	$wpfrom = get_option('admin_email');
	return $wpfrom;
}


function bfg_from_email_name( $email ){
	$wpfrom = get_option('blogname');
	return $wpfrom;
}