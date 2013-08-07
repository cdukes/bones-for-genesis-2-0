<?php

/**
 * Remove comments frontend. Useful if replacing WP commenting with Disqus.
 *
 * @since 2.0.10
 */
remove_action( 'genesis_comments', 'genesis_do_comments' );