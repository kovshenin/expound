<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Expound
 */

/**
 * Add theme support for various Jetpack features.
 */
function expound_infinite_scroll_setup() {

	// Infinite Scroll: http://jetpack.me/support/infinite-scroll/
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );

	// Featured Content: http://jetpack.me/support/featured-content/
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'expound_get_featured_posts',
		'max_posts' => 26,
	) );
}
add_action( 'after_setup_theme', 'expound_infinite_scroll_setup' );