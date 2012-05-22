<?php
/*
Child Theme Name: Bones for Genesis
Author: Eddie Machado
URL: htp://themble.com/genesis/bones/

For more information, check the log.txt file.
*/
	
/************* REGISTER CHILD THEME (You can Change This) ******/
define( 'CHILD_THEME_NAME', 'Bones for Genesis' );
define( 'CHILD_THEME_URL', 'http://www.themble.com/genesis/bones' );


// THEME SETUP TIME **************************************

// we're going to fire this off when we activate the child theme
add_action('genesis_setup','bfg_theme_setup', 15);

/*
we're putting all our core stuff in this function so
things are neater and WordPress runs quicker. I just
made that last part up, but it sounded good huh?
*/
function bfg_theme_setup() {
	
	/*
	this is where we clean up wordpress and genesis and
	remove things we don't really need and add things
	like our stylesheets and javascript libraries.
	be very careful when editing this file
	*/
	include_once( CHILD_DIR . '/library/bones.php');
	
	/* 
	bones for genesis uses some custom comment markup
	and in order to keep this file minimal, we're moving
	it to another file. to edit comments, check out this file:
	*/
	include_once( CHILD_DIR . '/library/comments.php');
	
	/*
	if you're using custom post types, you can use this example
	to create your own. You can also use the example templates
	if you want to customize the look of your custom post type
	pages
	*/
	include_once( CHILD_DIR . '/library/custom-post-types.php');
	
	/*
	if you want to customize the backend for your clients, use this
	admin file to keep your functions neat and clean.
	*/
	include_once( CHILD_DIR . '/library/admin.php'); 
	
	// don't update theme (it's custom right? so you don't need updates)
	add_filter( 'http_request_args', 'bfg_dont_update', 5, 2 );
	
	// THEME SUPPORT *************************************
	// adding custom background support
	add_custom_background();
	// adding post format support 
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ));
	// adding support for post format images
	add_theme_support( 'genesis-post-format-images' );
	
	// adding custom header support (change width if you change the width of the container)
	// add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 90 ) );
	
	// if you want widgets in the footer, you can use this 
	// add_theme_support( 'genesis-footer-widgets', 3 );
	
	// CUSTOMIZING GENESIS *******************************
	// adding the mobile friendly meta
	add_action( 'genesis_meta', 'bfg_viewport_meta' );
	
	/*
	you can unregister layouts if your child theme will mantain
	the same layout on every page and you don't want to offer
	your clients the option to change.
	*/
	// genesis_unregister_layout( 'content-sidebar' );
	// genesis_unregister_layout( 'sidebar-content' );
	// genesis_unregister_layout( 'content-sidebar-sidebar' );
	// genesis_unregister_layout( 'sidebar-sidebar-content' );
	// genesis_unregister_layout( 'sidebar-content-sidebar' );
	// genesis_unregister_layout( 'full-width-content' );
	
	/*
	if you want to remove some of the default widgets that come
	with genesis, you can use this function.
	*/
	// add_action( 'widgets_init', 'remove_genesis_widgets', 20 );
	
	// SCRIPTS, STYLES, & WP_HEAD ************************
	// remove default stylesheet
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	// enqueue base scripts and styles
	add_action('wp_enqueue_scripts', 'bfg_scripts_and_styles', 999);
	// who uses the rsd link anyway? axe it
	remove_action( 'wp_head', 'rsd_link' );                    
	// remove Windows Live Writer
	remove_action( 'wp_head', 'wlwmanifest_link' );                       
	// index link
	remove_action( 'wp_head', 'index_rel_link' );                         
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
	// Links for Adjacent Posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
	// remove WP version
	remove_action( 'wp_head', 'wp_generator' );  
	
	// cleaning up wordpress (it's pretty messy)
	// remove p around images
	add_filter('the_content', 'bfg_filter_ptags_on_images');
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'bfg_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action('wp_head', 'bfg_remove_recent_comments_style', 1);
	// clean up gallery output in wp
	add_filter('gallery_style', 'bfg_gallery_style');
	
	
	// CHILD THEME IMAGE SIZES ***************************
	add_image_size( 'bfg_large_img', 620, 240, TRUE );
	add_image_size( 'bfg_medium_img', 225, 225, TRUE );
	add_image_size( 'bfg_small_img', 45, 45, TRUE );
	/* 
	to add more sizes, simply copy a line from above 
	and change the dimensions & name. As long as you
	upload a "featured image" as large as the biggest
	set width or height, all the other sizes will be
	auto-cropped.
	
	To call a different size, simply change the text
	inside the thumbnail function.
	
	For example, to call the 225 x 225 sized image, 
	we would use the function:
	<?php the_post_thumbnail( 'bfg_medium_img' ); ?>
	
	You can change the names and dimensions to whatever
	you like.
	*/
	
	// CONTENT AREA **************************************
	
	
	// COMMENTS & PINKBACKS ******************************
	// custom comment layout
	add_filter( 'genesis_comment_form_args','bfg_custom_comment_form' );
	// trackback argument & layout
	add_filter( 'genesis_ping_list_args', 'bfg_ping_list_args' );
	// comments & trackbacks
	add_filter( 'genesis_comment_list_args', 'bfg_comment_list_args' );
	

	// FOOTER AREA ***************************************
	// custom back to top text
	add_filter( 'genesis_footer_backtotop_text', 'bfg_backtotop_text' );
	// footer credit & attribution text
	add_filter('genesis_footer_creds_text', 'bfg_footer_cred');
	

} /* DO NOT DELETE (YOUR CHILD THEME WILL IMPLODE!) */



// UNREGISTER GENESIS WIDGETS ****************************
/*
to use this function, make sure to uncomment it out in 
the theme setup function above.
*/
function remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates' );
    unregister_widget( 'Genesis_Featured_Page' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
    unregister_widget( 'Genesis_Featured_Post' );
    unregister_widget( 'Genesis_Latest_Tweets_Widget' );
}




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



/*


// USING GENESIS HOOKS /**********************************

The Genesis Framework uses hooks to move content around.
Instead of listing them all out, I'll show you a quick example
so you can get a quick idea of how they work.

In this example, we're going to move the nav from underneath the
header to above the header. A very common practice. 

First we identify the element or function we want to move. We can
view a list of all the hooks here:
http://dev.studiopress.com/hook-reference

Once we identify the one we want to target, we remove the action:

remove_action( 'genesis_after_header', 'genesis_do_nav' ); 

Great, now it's gone. But we want it to display somewhere else. So
let's add it back in before the header:

add_action('genesis_before_header', 'genesis_do_nav'); 

That's it. reload your page and you should see it in it's new 
position. For an easier visual look of all the hooks in action,
check out this page:
http://www.nothingcliche.com/genesis-theme-framework-visual-hook-reference/

Here's an example function with an alert. Try to add this
example function in different spots to see where they land
in your child theme. It can help you visualize better.

*/

function genesis_do_example() {
	// enter your function here
?>	<div class="alert help">
		<p>This is an example function. Please replace this with your own custom function.</p>
	</div>
<?php } 

/*
To add it, just use the above example and replace the last function
with "genesis_do_example". So to add this example above the header,
you would use:

add_action('genesis_before_header', 'genesis_do_example'); 


// USING GENESIS FILTERS /******************************

Aside from hooks, Genesis uses filters to replace the 
content contained inside functions. While not as
flexible as hooks, filters can add an extra layer of
detail to your child themes.

You can find a list of all the filters here:
http://dev.studiopress.com/filter-reference

Let's use a live example to show how filters work. We're
going to change the attribution text as well as the 
"Back to Top" link located in the footer.
*/

// changing the footer attribution
function bfg_footer_cred($bfg_ft) {
    $bfg_ft = '&copy; ' . date("Y") . ' ' . get_bloginfo("name") .' &middot; Built Using <a href="http://themble.com/genesis/bones">Bones for Genesis</a>.';
    return $bfg_ft;
}

// customizing text from back to top link
function bfg_backtotop_text($backtotop) {
	// simply replace what's inside the "..."
    $backtotop = '[footer_backtotop text="Back To Top"]';
    return $backtotop;
}

/*
We added the add_filter function to the after theme setup 
function up top. 

That's it. It's way more complex than using hooks and sometimes
it can be pretty darn confusing to be quite honest. Luckily,
you can get by using mostly hooks.


// CUSTOM CHILD THEME FUNCTIONS /***********************
/*
Here's where you can add your functions for you 
child theme. remember to add / remove your actions
up top in the theme setup function so we can keep 
things organized.
*/










?>