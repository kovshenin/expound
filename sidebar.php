<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Expound
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'expound_sidebar_before' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php do_action( 'expound_sidebar_after' ); ?>
	</div><!-- #secondary -->