<?php
/*
Template Name: Full-width Template

Description: Use this page template to hide the sidebar. Alternatively
you can simply remove all widgets from your sidebar to hide it on
all pages.
*/

add_filter( 'expound_force_full_width', '__return_true' );
get_template_part( 'page' );