<?php
/*
Child Theme Name: Bones for Genesis
Author: Eddie Machado
URL: htp://themble.com/genesis/bones/

Change the above info to reflect the
name, author, and url of your child
theme.
*/

/************* BEGIN GENESIS (DO NOT DELETE) *************/
require_once( get_template_directory() . '/lib/init.php' );

/************* REGISTER CHILD THEME (DO NOT DELETE) ******/
define( 'CHILD_THEME_NAME', 'Bones for Genesis' );
define( 'CHILD_THEME_URL', 'http://www.themble.com/genesis/bones' );

/************* ADDING FEATURE SUPPORT ********************/

/* adding custom background support */
add_custom_background();

/* adding custom header support (change width if you change the width of the container) */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 90 ) );

/* adding 3-column footer widget support (change the number if you want more columns) */
add_theme_support( 'genesis-footer-widgets', 3 );

/* adding post format support */
add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ));
add_theme_support( 'genesis-post-format-images' );

/* adding modernizr & selectevizr & custom scripts */
function bfg_scripts() { 
	wp_enqueue_script('bfg_modernizr', CHILD_URL.'/library/js/libs/modernizr.complete.min.js', array('jquery'), TRUE);
	wp_enqueue_script('bfg_custom_scripts', CHILD_URL.'/library/js/scripts.js', array('jquery'), '0', TRUE);
}
add_action('wp_enqueue_scripts', 'bfg_scripts');


/************* CUSTOM POST TYPE EXAMPLE *****************/
/*
Adding custom post types can be a bit confusing, but I've
supplied an easy to follow example which walks you
through the process. You can also check out a video 
tutorial here:
http://themble.com/support/custom-post-type-video-walkthrough/

If you don't want to use the custom post type, just
comment it out or delete it.
*/
require_once('library/custom-post-type.php');


/************* CHILD THEME IMAGE SIZES ******************/
add_image_size( 'bfg_large_img', 620, 240, TRUE );
add_image_size( 'bfg_medium_img', 225, 225, TRUE );
add_image_size( 'bfg_tiny_img', 45, 45, TRUE );


/************* UNREGISTER SITE LAYOUTS ******************/
// genesis_unregister_layout( 'content-sidebar' );
// genesis_unregister_layout( 'sidebar-content' );
// genesis_unregister_layout( 'content-sidebar-sidebar' );
// genesis_unregister_layout( 'sidebar-sidebar-content' );
// genesis_unregister_layout( 'sidebar-content-sidebar' );
// genesis_unregister_layout( 'full-width-content' );


/************* UNREGISTER GENESIS WIDGETS ***************/
/*
function remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates' );
    unregister_widget( 'Genesis_Featured_Page' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
    unregister_widget( 'Genesis_Featured_Post' );
    unregister_widget( 'Genesis_Latest_Tweets_Widget' );
}
*/

// add_action( 'widgets_init', 'remove_genesis_widgets', 20 );


/************* ADD ANOTHER SIDEBAR **********************/

/*
This is also commented out so you can add it at your
own discretion.
*/

/*
genesis_register_sidebar(array(
	'name'=>'Sidebar Alt',
	'id' => 'sidebar-alt',
	'description' => 'An Example Sidebar.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => "</div>",
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => "</h4>"
));
*/


/************* ADDING LESS SUPPORT **********************/
/*
LESS is an AMAZING stylesheet language that takes CSS
to the next level. Take a few minutes to peek inside
the library/less folder to see a plethora of new files.
LESS, you say, but isn't that complicated? Nope. It does take
a few minutes to wrap your head around, but it will all
be worth it. Need a quick intro? Here are a few quick reads:

http://coding.smashingmagazine.com/2011/09/09/an-introduction-to-less-and-comparison-to-sass/

I would HIGHLY RECOMMEND, if you are going to be working with
LESS, that you DO NOT parse it using the javascript file. It can
be a HUGE performance hit and it kind of defeats the whole reasoning
behind using LESS.

That being said, here are a few MUST HAVE TOOLS if you're planning
on going the LESS route: (You really only need one of them)

CodeKit: (Highly Recommended)
http://incident57.com/codekit/

LESS App:
http://incident57.com/less/

LESS Coda Plugin: 
http://incident57.com/coda/

SimpLESS: (Windows Users)
http://wearekiss.com/simpless

These applications compile LESS into minified, valid CSS. This
way you can keep your production LESS file easy to read and your
CSS minified and speedy. Simply set the output to the
library/css folder and you are all set. It's a thing of beauty.

Remember, once you download Bones for Genesis, it's up to you how 
to use it, so go nuts. Set things up and develop in a way that's 
easiest for you. If LESS is still a bit confusing for you, then 
you can simply use the default stylesheet.

If you're ready to dive into the world of LESS, than remove the
comment brackets from the function below and take a gander at the
new setup.

*/

/* (remove this line to activate the LESS setup)

function bfg_less_styles() {
	echo '<link rel="stylesheet" type="text/css" href="'. CHILD_URL . '/library/css/base.css">';
	echo '<link rel="stylesheet" type="text/css" href="'. CHILD_URL . '/library/css/style.css" media="(min-width:600px)">';
	echo '<!--[if (lt IE 9) & (!IEMobile)]>';
	echo '<link rel="stylesheet" href="'. CHILD_URL . '/library/css/ie.css">';
	echo '<![endif]-->';
}

// remove the default stylesheet
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
// add the new stylesheets
add_action( 'genesis_meta', 'bfg_less_styles' );

** (remove this line to activate the LESS setup) */

/*

So let me take a few minutes to explain what's going on up there.
First you call the base mobile stylesheet for every device, THEN
if a device is LARGER than 600 (you can change that, if you like),
the second stylesheet gets called in.

IE won't understand media="" though, so we need to add the
seperate IE stylesheet below that.

Yes, I hear you saying that an extra request affects load times,
but this is only for larger devices. The benefit here is that
mobile devices get ONLY what they need and are MUCH faster.
Instead of downloading loads of CSS for the larger devices they
won't even use, they only download what they need. Nice, huh?

To edit the styles, just edit the appropriately named file. It may
take some time to get used to, but it will all be worth it.

*/

/************* CHILD THEME FUNCTIONS ********************/

/*
Here are a few example functions for you to start with.
They are a great reference point for you to create 
your own functions and expiriments. Have Fun!
*/

// adding tweet button to single post pages only
function bfg_tweet_button() {
	if ( ! is_page() ) {
		echo '<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>';
	}
}

function bfg_tweet_script() {
	if ( ! is_page() ) {
		/* 
		I could also add this above in the bfg_scripts function, to keep things organized,
		but I thought it would work better here to serve as an example of how to add scripts.
		*/
		wp_enqueue_script( 'tweet-button', 'http://platform.twitter.com/widgets.js', array(), '', true );
	}
}

/* remove the two lines in front of the lines below to activate it */
// add_action('genesis_before_post_content', 'bfg_tweet_button');
// add_action('wp_enqueue_scripts', 'bfg_tweet_script');


// move your scripts & stylesheets to CDN (Content Devlivery Network)
/*
This one is commented out as it requires some setup. Here is how to move
just your stylesheet. You can do the same for jQuery and any other
scripts you'd like. 

function bfg_scripts_cdn() {
	wp_enqueue_style('bfg_scripts_cdn', 'http://cdn.url.com/style.css', array(), 'screen');
}
/* now remove the default stylesheet and replace it with the cdn one */
/*
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'genesis_meta', 'bfg_scripts_cdn' );
*/


// 

// an example function (you can use this to view hook locations)
function genesis_do_example() {
	// enter your function here
?>	<div class="help">
		<p>This is an example function. Please replace this with your own custom function.</p>
	</div>
<?php } /* end of function

/************* MOVING ELEMENTS USING HOOKS **************/

/* 
to move an element, you need the function name and the 
location of the hook. Here's an example:

/* remove it from it's current spot */
// remove_action( 'genesis_after_header', 'genesis_do_nav' ); 
/* put it where you want it */
// add_action('genesis_before_header', 'genesis_do_nav'); 

/*
Here are a list of the hooks for easy reference. To use one,
simple change "genesis_do_example" with the function and
remove the "//" from in front.

For a visual layout, check out this page:
http://www.nothingcliche.com/genesis-theme-framework-visual-hook-reference/

Also, for more on hooks, visit the official Genesis page:
http://dev.studiopress.com/hook-reference

Use the "do_example" function above to see where each 
hook is. simply remove the two "//" in front of any
add_action below and save. There will be an alert
on your site in the appropriate spot.
*/

/* the first hook genesis executes */
// add_action('genesis_pre', 'genesis_do_example');

/* executed after the constants have been defined */
// add_action('genesis_pre_framework', 'genesis_do_example');

/* runs before any of the child theme functions */
// add_action('genesis_init', 'genesis_do_example');

/* outputs the doctitle (executes between tags */
// add_action('genesis_title', 'genesis_do_example');

/* fired inside the <head> and used for meta info */
// add_action('genesis_meta', 'genesis_do_example');

/* executes immediately after the opening <body> tag */
// add_action('genesis_before', 'genesis_do_example');

/* executed right before the #header div */
// add_action('genesis_before_header', 'genesis_do_example');

/* executed inside the #header div */
// add_action('genesis_header', 'genesis_do_example');

/* the site title in the header */
// add_action('genesis_site_title', 'genesis_do_example');

/* the site description */
// add_action('genesis_site_description', 'genesis_do_example');

/* executed after the header after the #header div */
// add_action('genesis_after_header', 'genesis_do_example');

/* executed before the #content-sidebar-wrap div -->
// add_action('genesis_before_content_sidebar_wrap', 'genesis_do_example');

/* executed before #content div */
// add_action('genesis_before_content', 'genesis_do_example');

/* executes before the loop (outside of the loop) */
// add_action('genesis_before_loop', 'genesis_do_example');

/* the actual loop */
// add_action('genesis_loop', 'genesis_do_example');

/* executes before the post_class() div */
// add_action('genesis_before_post', 'genesis_do_example');

/* executes before the post title */
// add_action('genesis_before_post_title', 'genesis_do_example');

/* outputs the post title */
// add_action('genesis_post_title', 'genesis_do_example');

/* executes after the post title */
// add_action('genesis_after_post_title', 'genesis_do_example');

/* executes before the .entry_content div */
// add_action('genesis_before_post_content', 'genesis_do_example');

/* outputs the post content */
// add_action('genesis_post_content', 'genesis_do_example');

/* executes after the .entry_content div */
// add_action('genesis_after_post_content', 'genesis_do_example');

/* executes after the post_class() div */
// add_action('genesis_after_post', 'genesis_do_example');

/* after the endwhile in the loop */
// add_action('genesis_after_endwhile', 'genesis_do_example');

/* after the else in the loop */
// add_action('genesis_after_else', 'genesis_do_example');

/* executes after the loop (outside the loop) */
// add_action('genesis_after_loop', 'genesis_do_example');

/* executes before the #comments div */
// add_action('genesis_before_comments', 'genesis_do_example');

/* outputs the entire comment block */
// add_action('genesis_comments', 'genesis_do_example');

/* executes inside the .comment-list ol */
// add_action('genesis_list_comments', 'genesis_do_example');

/* executes before an individual comment */
// add_action('genesis_before_comment', 'genesis_do_example');

/* executes after an individual comment */
// add_action('genesis_after_comment', 'genesis_do_example');

/* executes after the #comments div */
// add_action('genesis_after_comments', 'genesis_do_example');

/* executes before the #pings div */
// add_action('genesis_before_pings', 'genesis_do_example');

/* outputs the pings */
// add_action('genesis_pings', 'genesis_do_example');

/* executes inside the .ping-list ol */
// add_action('genesis_list_pings', 'genesis_do_example');

/* executes after the #pings div */
// add_action('genesis_after_pings', 'genesis_do_example');

/* executes before the comment form */
// add_action('genesis_before_comment_form', 'genesis_do_example');

/* outputs the comment form */
// add_action('genesis_comment_form', 'genesis_do_example');

/* executes after the comment form */
// add_action('genesis_after_comment_form', 'genesis_do_example');

/* executed after the #content div */
// add_action('genesis_after_content', 'genesis_do_example');

/* outputs the sidebar */
// add_action('genesis_sidebar', 'genesis_do_example');

/* inside the sidebar before the first widget */
// add_action('genesis_before_sidebar_widget_area', 'genesis_do_example');

/* inside the sidebar after the last widget */
// add_action('genesis_after_sidebar_widget_area', 'genesis_do_example');

/* outputs the alt sidebar */
// add_action('genesis_sidebar_alt', 'genesis_do_example');

/* inside the alt sidebar before the first widget */
// add_action('genesis_before_sidebar_alt_widget_area', 'genesis_do_example');

/* inside the alt sidebar after the last widget */
// add_action('genesis_after_sidebar_alt_widget_area', 'genesis_do_example');

/* executed after the #content-sidebar-wrap div */
// add_action('genesis_after_content_sidebar_wrap', 'genesis_do_example');

/* before the #footer div */
// add_action('genesis_before_footer', 'genesis_do_example');

/* inside the #footer div */
// add_action('genesis_footer', 'genesis_do_example');

/* after the #footer div */
// add_action('genesis_after_footer', 'genesis_do_example');

/* executes immediately before the closing </body> tag */
// add_action('genesis_after', 'genesis_do_example');


/************* GENESIS FILTERS ************************/

/*
These are examples of commonly used filters.
Using filters are a way to change some of the
things (like text) in the Genesis framework.
Here are a few examples.
*/

// Customizes Footer text
function bfg_footer_cred($bfg_ft) {
    $bfg_ft = '&copy; ' . date("Y") . ' ' . get_bloginfo("name") .' &middot; Built Using <a href="http://themble.com/genesis/bones">Bones for Genesis</a>.';
    return $bfg_ft;
}

// apply it to genesis
add_filter('genesis_footer_creds_text', 'bfg_footer_cred');


/*
Here are a few common filters if you're interested
in adding any custom changes. There are a LOT more
that I didn't list here, these are just a few of
the common ones.

You can find a list of all the filters here:
http://dev.studiopress.com/filter-reference
*/

// genesis_header_scripts /* outputs header scripts */

// genesis_author_box_gravatar_size /* change size of author box gravatar */
// genesis_author_box_title /* change author box title */

// genesis_title_comments /* comments title */
// genesis_comments_closed_text /* displays when comments are closed */
// genesis_no_comments_text /* displays when there are no comments */
// genesis_title_pings /* pings title */

// genesis_footer_backtotop_text /* back to top text */
// genesis_footer_creds_text /* credit text (used in example) */
// genesis_footer_scripts /* drop footer scripts here */


/************* ADMIN & DASHBOARD CUSTOMIZATION **********/

require_once('library/admin.php'); // admin customization