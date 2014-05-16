<?php

if ( ! function_exists( 'twofifty_title' ) ) :
function twofifty_title( $title = '' ) {
  return $title . get_bloginfo('name');
}
endif;

if ( ! function_exists( 'twofifty_setup' ) ) :

function twofifty_setup() {

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Bottom navigation menu', 'twofifty' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video', 'gallery'
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

  // Make sure blog title goes in page title
  add_filter( 'wp_title', 'twofifty_title', 10, 1 );
}
endif; // twofifty_setup
add_action( 'after_setup_theme', 'twofifty_setup' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twofifty_scripts() {

  if ( is_front_page() ) {
    wp_enqueue_style( '250-frontpage-style', get_stylesheet_uri() );
  } else {
    wp_enqueue_style( '250-default-style', get_template_directory_uri() . '/article-style.css' );
  }

  // jquery
  wp_enqueue_script( 'jquery', get_template_directory_uri() . '/jquery.min.js' );
  wp_enqueue_script( 'slideshow', get_template_directory_uri() . '/slideshow.js', 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'twofifty_scripts' );
