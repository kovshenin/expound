<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Expound
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->