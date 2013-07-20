<?php
/**
 * Theme Customizer
 *
 * @package Expound
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function expound_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'expound_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function expound_customize_preview_js() {
	wp_enqueue_script( 'expound_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130708', true );
}
add_action( 'customize_preview_init', 'expound_customize_preview_js' );
