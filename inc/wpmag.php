<?php
/**
 * WP Magazine extras
 */
add_filter( 'shortcode_atts_caption', 'wpmag_shortcode_atts_caption' );
function wpmag_shortcode_atts_caption( $attr ) {
	global $content_width;

	if ( isset( $attr['width'] ) && $attr['width'] < $content_width )
		$attr['width'] -= 4;

	return $attr;
}