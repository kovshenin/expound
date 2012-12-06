<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mag
 * @since Mag 1.0
 */

get_header(); ?>

		<?php if ( is_home() && ! is_paged() ) : ?>
		<div class="site-intro">
			<p>
				WP Magazine — это онлайн журнал посвящённый системе управления контентом WordPress. Здесь вы найдёте
				много полезной информации, как для начинающих, так и для опытных разработчиков.
			</p>
		</div>
		<?php endif; // home & not paged ?>

		<?php
			if ( is_home() && ! is_paged() ) // condition should be same as in pre_get_posts
				get_template_part( 'featured-content' );
		?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php mag_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>