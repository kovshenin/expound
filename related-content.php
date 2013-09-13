<?php 
/**
 * @package Expound
 */
do_action( 'expound_related_posts_before' );
$related_posts = expound_get_related_posts();
?>
<?php if ( $related_posts->have_posts() ) : ?>
<div class="related-content">
	<h3 class="related-content-title"><?php _e( 'Related posts', 'expound' ); ?></h3>
	<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'expound-mini' ); ?></a>
			</div>
			<?php endif; ?>

			<header class="entry-header">
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'expound' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			</header><!-- .entry-header -->

		</article>

	<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
<?php endif; // have_posts() ?>
<?php do_action( 'expound_related_posts_after' ); ?>
