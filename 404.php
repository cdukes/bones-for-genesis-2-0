<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
remove_action( 'genesis_loop', 'genesis_404' );
add_action( 'genesis_loop', 'bfg_404' );
/**
 * Better default 404 text
 *
 * See: https://yoast.com/404-error-pages-wordpress/
 *
 * @since 2.3.2
 */
function bfg_404() {

	global $wp_query;

	echo '<article class="entry">';

		printf( '<h1 class="entry-title">%s</h1>', __( 'Not found, error 404', 'genesis' ) );

		echo '<div class="entry-content">';

			?>
			<p>Let's help you find what you came here for:</p>

			<?php
			$s = preg_replace( '/(.*)-(html|htm|php|asp|aspx)$/', '$1', $wp_query->query_vars['name'] );
			$s = str_replace( '-', ' ', $s );

			$args = array(
				'post_type' => array('post', 'page'),
				's' => $s
			);

			$posts = get_posts( $args );
			if( count($posts) > 0 ) {
				echo '<p>Were you looking for <strong>one of these</strong> posts or pages?</p>';
				echo '<ul>';
					foreach( $posts as $post )
						echo '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
				echo '</ul>';
				echo '<p>If not, don\'t worry, here\'s a few more tips for you to find it:</p>';
			}
			?>

			<ol>
				<li>
					<strong>Search</strong> for it:
					<?php echo get_search_form(); ?>
				</li>
				<li>
					<strong>If you typed in a URL...</strong> make sure the spelling, cApitALiZaTiOn, and punctuation are correct. Then, try reloading the page.
				</li>
				<li>
					<strong>Start over again</strong> at the <a href="<?php get_bloginfo('url');?>">homepage</a> (and please contact us to say what went wrong, so we can fix it).
				</li>
			</ol>
			<?php

		echo '</div>';

	echo '</article>';

}

genesis();
