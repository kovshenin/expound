<?php

add_action('wp_print_styles', 'expound_bp_css');
function expound_bp_css(){
    if(is_admin()){
        return;
    }

    wp_enqueue_style('expound-buddypress', get_stylesheet_directory_uri() . '/css/bp.css');
}