<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'bfg_404' );
/**
 * Better default 404 text.
 *
 * See: https://yoast.com/404-error-pages-wordpress/
 *
 * @since 2.3.2
 */
function bfg_404() {

	global $wp_query;

	echo '<article class="entry">';

		printf( '<h1 class="entry-title">%s</h1>', apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', CHILD_THEME_TEXT_DOMAIN ) ) );

		echo '<div class="entry-content">';

			?>
			<p><?php echo __( "Let's help you find what you came here for:", CHILD_THEME_TEXT_DOMAIN ); ?></p>

			<?php
			$s = preg_replace( '/(.*)-(html|htm|php|asp|aspx)$/', '$1', $wp_query->query_vars['name'] );
			$s = str_replace( '-', ' ', $s );

			$args = array(
				'post_type' => array('post', 'page'),
				's'         => $s,
			);

			$posts = get_posts( $args );
			if( count($posts) > 0 ) {
				echo '<p>' . __( 'Were you looking for <strong>one of these</strong> posts or pages?', CHILD_THEME_TEXT_DOMAIN ) . '</p>';
				echo '<ul>';
					foreach( $posts as $post )
						echo '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
				echo '</ul>';
				echo '<p>' . __( "If not, don't worry, here's a few more tips for you to find it:", CHILD_THEME_TEXT_DOMAIN ) . '</p>';
			}
			?>

			<ol>
				<li>
					<?php echo __( '<strong>Search</strong> for it:', CHILD_THEME_TEXT_DOMAIN ); ?>
					<?php echo get_search_form(); ?>
				</li>
				<li>
					<?php echo __( '<strong>If you typed in a URL...</strong> make sure the spelling, cApitALiZaTiOn, and punctuation are correct. Then, try reloading the page.', CHILD_THEME_TEXT_DOMAIN ); ?>
				</li>
				<li>
					<?php
					printf(
						__( '<strong>Start over again</strong> at the <a href="%s">homepage</a> (and please contact us to say what went wrong, so we can fix it).', CHILD_THEME_TEXT_DOMAIN ),
						get_bloginfo('url')
					)
					?>
				</li>
			</ol>
			<?php

		echo '</div>';

	echo '</article>';

}

genesis();
