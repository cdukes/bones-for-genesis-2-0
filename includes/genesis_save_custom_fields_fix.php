<?php
remove_action( 'save_post', 'genesis_inpost_seo_save', 1, 2 );
add_action( 'save_post', 'genesis_inpost_seo_save_fixed', 1, 2 );
/**
 * Save the SEO settings when we save a post or page.
 *
 * Some values get sanitized, the rest are pulled from identically named subkeys
 * in the $_POST['genesis_seo'] array.
 *
 * @since 0.1.3
 *
 * @uses genesis_save_custom_field() Perform checks and saves post meta / custom
 *                                   field data to a post or page.
 *
 * @param integer  $post_id Post ID.
 * @param stdClass $post    Post object.
 *
 * @return mixed Returns post id if permissions incorrect, null if doing autosave,
 *               ajax or future post, false if update or delete failed, and true
 *               on success.
 */
function genesis_inpost_seo_save_fixed( $post_id, $post ) {

	if ( ! isset( $_POST['genesis_seo'] ) )
		return;

	/** Merge user submitted options with fallback defaults */
	$data = wp_parse_args( $_POST['genesis_seo'], array(
		'_genesis_title'         => '',
		'_genesis_description'   => '',
		'_genesis_keywords'      => '',
		'_genesis_canonical_uri' => '',
		'redirect'               => '',
		'_genesis_noindex'       => 0,
		'_genesis_nofollow'      => 0,
		'_genesis_noarchive'     => 0,
		'_genesis_scripts'       => '',
	) );

	/** Sanitize the title, description, and tags */
	foreach ( (array) $data as $key => $value )
		if ( in_array( $key, array( '_genesis_title', '_genesis_description', '_genesis_keywords' ) ) )
			$data[ $key ] = esc_html( strip_tags( $value ) );

	/** Save custom field data */
	genesis_save_custom_fields_fixed( $data, 'genesis_inpost_seo_save', 'genesis_inpost_seo_nonce', $post, $post_id );

}

remove_action( 'save_post', 'genesis_inpost_layout_save', 1, 2 );
add_action( 'save_post', 'genesis_inpost_layout_save_fixed', 1, 2 );
/**
 * Saves the layout options when we save a post / page.
 *
 * Since there's no sanitizing of data, the values are pulled from identically
 * named keys in $_POST.
 *
 * @since 0.2.2
 *
 * @uses genesis_save_custom_field() Perform checks and saves post meta / custom
 *                                   field data to a post or page.
 *
 * @param integer  $post_id Post ID.
 * @param stdClass $post    Post object.
 *
 * @return mixed Returns post id if permissions incorrect, null if doing autosave,
 *               ajax or future post, false if update or delete failed, and true
 *               on success.
 *
 * @todo Sanitize classes
 */
function genesis_inpost_layout_save_fixed( $post_id, $post ) {

	if ( ! isset( $_POST['genesis_layout'] ) )
		return;

	$data = wp_parse_args( $_POST['genesis_layout'], array(
		'_genesis_layout'            => '',
		'_genesis_custom_body_class' => '',
		'_genesis_post_class'        => '',
	) );

	genesis_save_custom_fields_fixed( $data, 'genesis_inpost_layout_save', 'genesis_inpost_layout_nonce', $post, $post_id );

}


/**
 * Saves post meta / custom field data for a post or page.
 *
 * It verifies the nonce, then checks we're not doing autosave, ajax or a future
 * post request. It then checks the current user's permissions, before finally
 * either updating the post meta, or deleting the field if the value was not
 * truthy.
 *
 * By passing an array of fields => values from the same metabox (and therefore same nonce)
 * into the $data argument, repeated checks against the nonce, request and
 * permissions are avoided.
 *
 * @since 1.9.0
 *
 * @param array        $data         Key/Value pairs of data to save in '_field_name' => 'value' format.
 * @param string       $nonce_action Nonce action for use with wp_verify_nonce().
 * @param string       $nonce_name   Name of the nonce to check for permissions.
 * @param integer      $post_id      ID of the post to save custom field value to.
 * @param stdClass     $post         Post object.
 *
 * @return mixed Returns null if permissions incorrect, doing autosave,
 *               ajax or future post, false if update or delete failed, and true
 *               on success.
 */
function genesis_save_custom_fields_fixed( $data, $nonce_action, $nonce_name, $post, $post_id ) {

	/**	Verify the nonce */
	if ( ! isset( $_POST[ $nonce_name ] ) || ! wp_verify_nonce( $_POST[ $nonce_name ], $nonce_action ) )
		return;

	/**	Don't try to save the data under autosave, ajax, or future post. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		return;
	if ( defined( 'DOING_CRON' ) && DOING_CRON )
		return;

	/* Don't save if WP is creating a revision (same as DOING_AUTOSAVE?) */
	if ( 'revision' == $post->post_type )
		return;

	/**	Check the user allowed to edit the post or page */
	//if ( ( 'page' == $post->post_type && ! current_user_can( 'edit_page' ) ) || ! current_user_can( 'edit_post' ) )
	if ( ! current_user_can( 'edit_post', $post->ID ) )
		return;

	/** Cycle through $data, insert value or delete field */
	foreach ( (array) $data as $field => $value ) {
		/** Save $value, or delete if the $value is empty */
		if ( $value )
			update_post_meta( $post_id, $field, $value );
		else
			delete_post_meta( $post_id, $field );
	}

}