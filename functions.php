<?php
/**
 * Mag functions and definitions
 *
 * @package Mag
 * @since Mag 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Mag 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 610; /* pixels */

if ( ! function_exists( 'mag_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Mag 1.0
 */
function mag_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Mag, use a find and replace
	 * to change 'mag' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mag', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 220, 126, true );
	add_image_size( 'mag-featured', 460, 260, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mag' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // mag_setup
add_action( 'after_setup_theme', 'mag_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Mag 1.0
 */
function mag_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'mag' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'mag_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function mag_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'style-less', get_stylesheet_directory_uri() . '/mag.css' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'mag_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );


add_filter('post_class', 'mag_post_class' );
function mag_post_class( $classes ) {
	if ( has_post_thumbnail() )
		$classes[] = 'has-post-thumbnail';
	return $classes;
}

add_action( 'pre_get_posts', 'mag_pre_get_posts' );
function mag_pre_get_posts( $query ) {
	if ( ! $query->is_main_query() )
		return;

	if ( $query->is_home() && ! $query->is_paged() ) { // condition should be same as in index.php
		$query->set( 'ignore_sticky_posts', true );

		$exclude_ids = array();
		$featured_posts = mag_get_featured_posts();
		foreach ( $featured_posts->posts as $post )
			$exclude_ids[] = $post->ID;

		$query->set( 'post__not_in', $exclude_ids );
	}
}

function mag_get_featured_posts() {
	global $wp_query;

	$sticky = get_option( 'sticky_posts' );

	if ( empty( $sticky ) )
		return new WP_Query();

	$args = array(
		'posts_per_page' => 5,
		'post__in' => $sticky,
		'ignore_sticky_posts' => true,
	);

	/*if ( is_category() )
		$args['category_name'] = get_query_var( 'category_name' );*/

	return new WP_Query( $args );
}


function mag_display_credits() {
	echo '&copy; ' . date( 'Y' ) . ' Копирование материалов без разрешения автора запрещено. WordPress и WordCamp являются зарегистрированными торговыми марками и принадлежат фонду <a href="http://wordpressfoundation.org">WordPress Foundation</a>. Читайте правила использования торговых марок. Работает на <a href="http://wordpress.org">WordPress</a>.';
}
add_action( 'mag_credits', 'mag_display_credits' );