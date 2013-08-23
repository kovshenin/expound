<?php

add_action( 'wp_enqueue_scripts', 'expound_bp_css' );
function expound_bp_css(){
    wp_enqueue_style( 'expound-buddypress', get_stylesheet_directory_uri() . '/css/bp.css' );
}