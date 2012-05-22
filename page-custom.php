<?php
/*
Template Name: Custom Page Example
*/

/*
This is a custom page template. You can
add functions here and they will only be
called on this page. You can also overwrite 
page layout options, remove sidebars, or
enqueue page specific scripts.

This is an example of a custom page. Feel free to edit
this one or just use it as an example on how to create
your own. :D

*/

// force page layout to be full width
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

// remove comments (you can do this in the wp admin too, but it's nice to be safe)
remove_action( 'genesis_comments', 'genesis_do_comments' );

// remove sidebar (you can also remove sidebar alt if you have that active too)
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// inserting custom page content into genesis template
add_action( 'genesis_before_post', 'bfg_custom_page_example' ); 

// creating custom page content
function bfg_custom_page_example() { ?>
	<div class="alert help">
		<p>This is a custom page example!</p>
	</div>

<?php
}



// do genesis
genesis();  

?>