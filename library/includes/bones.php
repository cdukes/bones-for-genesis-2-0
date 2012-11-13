<?php
/*
Author: Eddie Machado
URL: htp://themble.com/genesis/bones/

Don't delete or edit this file unless you know
what you're doing. If you mess something up in 
here, you'll break the theme.
*/

/*********************
SCRIPTS & ENQEUEING
*********************/

// loading modernizr and jquery, and reply script 
function bfg_scripts_and_styles() {
  
    // modernizr (without media query polyfill)
    wp_register_script( 'bfg-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
 
    // register mobile stylesheet
    wp_register_style( 'bfg-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

    // ie-only style sheet
    wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );
    
    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
    
    // adding scripts file in the footer
    wp_register_script( 'bfg-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
    
    /*
    now let's enqueue the scripts and styles into the wp_head function.
    for more information on how this works, check out this post:
    http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes
    */
    wp_enqueue_script( 'bfg-modernizr' ); 
    wp_enqueue_style( 'bfg-stylesheet' );
    wp_enqueue_style('bones-ie-only');
    /*
    I reccomend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' ); 
    // deregister the superfish scripts
    wp_deregister_script( 'superfish' );
    wp_deregister_script( 'superfish-args' );
    wp_enqueue_script( 'bfg-js' ); 
    
} /* end scripts and styles function */

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function bones_ie_conditional( $tag, $handle ) {
    if ( 'bones-ie-only' == $handle )
        $tag = '<!--[if lte IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
    return $tag;
}

/*
the responsive meta tag should be added to the genesis
core shortly, so keep tabs on that. I also added Google
Chrome Frame support & some other "mobile friendly"
meta tags. they're pretty rad.
*/
function bfg_viewport_meta() {
	echo '<!-- bones for genesis: adding google chrome frame support -->';
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
	echo '<!-- bones for genesis: mobile meta :) -->';
	echo '<meta name="HandheldFriendly" content="True">';
	echo '<meta name="MobileOptimized" content="320">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}


/*
if you name your child theme something that already exists in the
wordpress repo, then you may get an alert offering a "theme update"
for a theme that's not even yours. Weird, I know. Anyway, here's a
fix for that.

credit: Mark Jaquith
http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
*/
function bfg_dont_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}

/*
This remove the p from around imgs. For more checkout:
http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
*/
function bfg_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*
wordpress LOVES to inject css into the header. 
we're going to stop that since it's gross and we
want our code to be as clean as possible
*/

// remove WP version from RSS
function bfg_rss_version() { return ''; }

// removed recent comment widget styles
function bfg_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
	
// remove CSS from recent comments widget
function bfg_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove CSS from gallery
function bfg_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


// CUSTOM BREADCRUMBS /***********************************
/*
We've added a clearfix on the breadcrumbs container, but you
can go even more in-depth and change the text for each
argument.
*/

function bfg_breadcrumb_args( $args ) {
    $args['home'] = 'Home';                                    // home text
    $args['sep'] = ' &raquo; ';                                // the seperator between links
    $args['list_sep'] = ', ';                                  // Genesis 1.5 and later
    $args['prefix'] = '<div class="breadcrumb clearfix">';     // the breadcrumbs container
 	$args['suffix'] = '</div>';
    $args['heirarchial_attachments'] = true;                   // Genesis 1.5 and later
    $args['heirarchial_categories'] = true;                    // Genesis 1.5 and later
    $args['display'] = true;
    $args['labels']['prefix'] = '';                          
    $args['labels']['author'] = 'Archives for ';               // the author archives
    $args['labels']['category'] = 'Archives for ';             // the category archives (Genesis 1.6 and later)
    $args['labels']['tag'] = 'Archives for ';                  // the tag archives
    $args['labels']['date'] = 'Archives for ';                 // the date archives
    $args['labels']['search'] = 'Search for ';                 // the search archives
    $args['labels']['tax'] = 'Archives for ';                  // taxonomy archives
    $args['labels']['post_type'] = 'Archives for ';            // custom post type archives
    $args['labels']['404'] = 'Not found: ';                    // 404 breadcrumbs       (Genesis 1.5 and later)
    return $args;
}

?>