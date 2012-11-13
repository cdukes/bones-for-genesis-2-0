<?php
/*
Author: Eddie Machado
URL: htp://themble.com/genesis/bones/

We changed a few things in the comments and
made them lighter, faster, and more mobile 
friendly. feel free to customize them as you 
see fit. :)
*/



// CUSTOM COMMENT LAYOUT *******************************
/*
We're going to use a custom comment layout to really make
our mobile-first layout faster. You can also use the 
callback function below to customize the look of your
comments.
*/

function bfg_comment_callback($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	$bgauthemail = get_comment_author_email();
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class('clearfix'); ?>>
		<div class="comment-author vcard">
			
			<?php /*
			    this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			    echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			*/ ?>
			<!-- custom gravatar call -->
			<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>&s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="http://themble-clients.s3.amazonaws.com/blueglass/nothing.gif" />
			<!-- end custom gravatar call -->
			
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
			<span class="says">says:</span>
		</div>
		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date(),  get_comment_time()) ?></a>
		</div>
		<div class="comment-content">
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="help">
          			<p><?php _e('Your comment is awaiting moderation.') ?></p>
          		</div>
			<?php endif; ?>
			<?php comment_text() ?>
		</div>
		<div class="reply clearfix">
			<?php edit_comment_link(__('Edit'),'  ','') ?>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
			
			
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!


// CUSTOM PINGBACK LAYOUT ********************************
/*
Let's just display the link to the pingback without all the
garbage that comes with it. Thanks to Gary Jones for this code.
*/
function bfg_list_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ) ?>
	</li>
	<?php
}

// CUSTOM COMMENT FORM LAYOUT **************************
/*
We're moving the labels above the fields because it
feels more natural for forms and is especially 
helpful when working on mobile devices w/ limited space.
*/

function bfg_custom_comment_form() {
	$args = array(
	'fields' => array(
		'author' =>	'<p class="comment-form-author">' .
					'<label for="author">' . __( 'Name', 'genesis' ) . '</label> ' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' placeholder="Type Your Name Here" />' .
						( $req ? '<span class="required">*</span>' : '' ) .
					'</p>',

		'email' =>	'<p class="comment-form-email">' .
					'<label for="email">' . __( 'Email: Not Published', 'genesis' ) . '</label> ' .
					'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' placeholder="Email Goes Here" />' .
						( $req ? '<span class="required">*</span>' : '' ) .
					'</p>',

		'url' =>	'<p class="comment-form-url">' .
					'<label for="url">' . __( 'Website', 'genesis' ) . '</label>' .
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" placeholder="Website URL Here" />' .
					'</p>'
	),

	'comment_field' =>	'<p class="comment-form-comment">' .
						'<label for="comment">' . __( 'Comment', 'genesis' ) . '</label>' .
						'<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true" placeholder="Add Your Comment Here"></textarea>' .
						'</p>',
	
	// change the title for the comments section
	'title_reply' => __( 'Join the Discussion', 'genesis' ),
	
	// change the text in the button for the comment form
	'label_submit' => __( 'Submit Comment', 'genesis' ),
	
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	
	);
	return $args;
}


// CUSTOM PING ARGUMENTS *********************************
/*
Big thanks to Gary Jones for this helpful function to
customize the pingbacks.

more info: http://code.garyjones.co.uk/change-trackback-format/
*/
function bfg_ping_list_args( $args ) {
	$custom_args = array( 'callback' => 'bfg_list_pings' );
	return array_merge( $args, $custom_args );
}

?>