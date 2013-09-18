<?php
/**
 * BuddyPress Compatibility
 */

function expound_bp_css() {
    wp_enqueue_style( 'expound-buddypress', get_template_directory_uri() . '/css/buddypress.css' );
}
add_action( 'wp_enqueue_scripts', 'expound_bp_css' );