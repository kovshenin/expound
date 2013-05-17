<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Mag
 */

if ( ! function_exists( 'mag_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function mag_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mag' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mag' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mag' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mag' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mag' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // mag_content_nav

if ( ! function_exists( 'mag_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function mag_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mag' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mag' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'mag' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'mag' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'mag' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'mag' ), '<span class="edit-link">', '<span>' ); ?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
			<?php
				comment_reply_link( array_merge( $args,array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				) ) );
			?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for mag_comment()

if ( ! function_exists( 'mag_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mag_posted_on() {
	$human_time = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'mag' );
	$regular_time = get_the_time( get_option( 'date_format' ) );

	$output_time = sprintf( '%s <span style="display:none;">%s</span>', $human_time, $regular_time );

	if ( current_time( 'timestamp' ) > get_the_time( 'U' ) + 60 * 60 * 24 * 14 )
		$output_time = $regular_time;

	// translators: 1: who, 2: when
	printf( __( '%1$s / %2$s', 'mag' ),
		sprintf( '<a class="author" rel="author" href="%s">%s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() ),
		sprintf( '<a class="entry-date" href="%s">%s</a>', esc_url( get_permalink() ), $output_time )
	);
}
endif;

/**
 * @todo fix l10n
 */
function mag_posted_in() {

        $human_time = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'mag' );
        $regular_time = get_the_time( get_option( 'date_format' ) );

        $output_time = sprintf( '%s <span style="display:none;">%s</span>', $human_time, $regular_time );

        if ( current_time( 'timestamp' ) > get_the_time( 'U' ) + 60 * 60 * 24 * 14 )
                $output_time = $regular_time;

	if ( ! is_single() ) {
		// translators: 1: when, 2: where (category)
		printf( __( '%1$s in %2$s.', 'mag' ),
			sprintf( '<a class="entry-date" href="%s">%s</a>', esc_url( get_permalink() ), $output_time ),
			get_the_category_list( ', ' )
		);
	} else {
		// translators: 1: when, 2: where (category)
		printf( __( '%1$s in %2$s.', 'mag' ),
			sprintf( '<a class="entry-date" href="%s">%s</a>', esc_url( get_permalink() ), esc_html( get_the_time( get_option( 'date_format' ) ) ) ),
			get_the_category_list( ', ' )
		);

		echo ' ';
			the_tags( __( 'Tags: ', 'mag' ), ', ' );
	}
}

/**
 * Returns true if a blog has more than 1 category
 */
function mag_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so mag_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so mag_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in mag_categorized_blog
 */
function mag_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'mag_category_transient_flusher' );
add_action( 'save_post', 'mag_category_transient_flusher' );
