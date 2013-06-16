<?php
add_filter( 'login_headerurl', 'bfg_login_headerurl' );
/**
 * Makes the login screen's logo link to your homepage, instead of to WordPress.org.
 *
 * @since 2.0.0
 */
function bfg_login_headerurl() {

    return home_url();

}

add_filter( 'login_headertitle', 'bfg_login_headertitle' );
/**
 * Makes the login screen's logo title attribute your site title, instead of 'WordPress'.
 *
 * @since 2.0.0
 */
function bfg_login_headertitle() {

    return get_bloginfo( 'name' );

}

// add_action( 'login_enqueue_scripts', 'bfg_replace_login_logo' );
/**
 * Replaces the login screen's WordPress logo with the 'login-logo.png' in your child theme images folder.
 *
 * Disabled by default. Make sure you have a login logo before using this function!
 *
 * Updated 2.0.1: Assumes SVG logo by default
 *
 * @since 2.0.0
 */
function bfg_replace_login_logo() {

	?><style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/login-logo.svg) !important;
			/* background-size: 274px 63px; */		<?php // Adjust to the dimensions of your logo. WP Default: 274px 63px ?>
			/* padding-bottom: 15px; */		<?php // Useful for spacing your logo from the form below. Default: 15px ?>
		}
	</style>
<?php

}

add_filter( 'wp_mail_from_name', 'bfg_mail_from_name' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress site name, instead of from 'WordPress'.
 *
 * @since 2.0.0
 */
function bfg_mail_from_name() {

	return get_option( 'blogname' );

}

// add_filter( 'wp_mail_from', 'bfg_wp_mail_from' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress admin email address.
 *
 * Disabled by default, in case you don't want to reveal your admin email.
 *
 * @since 2.0.0
 */
function bfg_wp_mail_from() {

	return get_option( 'admin_email' );

}

add_action( 'wp_before_admin_bar_render', 'bfg_remove_wp_icon_from_admin_bar' );
/**
 * Removes the WP icon from the admin bar
 *
 * See: http://wp-snippets.com/remove-wordpress-logo-admin-bar/
 *
 * @since 2.0.0
 */
function bfg_remove_wp_icon_from_admin_bar() {

    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');

}

// add_filter( 'admin_footer_text', 'bfg_admin_footer_text' );
/**
 * Modify the admin footer text
 *
 * See: http://wp-snippets.com/change-footer-text-in-wp-admin/
 *
 * @since 2.0.0
 */
function bfg_admin_footer_text () {

	echo 'YOUR TEXT HERE.';

}