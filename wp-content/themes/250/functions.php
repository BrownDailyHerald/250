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
		'image', 'video', 'gallery', 'link'
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

/* Meta box for byline! */
function add_author_meta_box() {
  add_meta_box(
    'custom_author',
    __('Custom Author', 'twofifty'),
    'author_meta_callback',
    'post'
  );
}

add_action( 'add_meta_boxes', 'add_author_meta_box' );

function author_meta_callback( $post ) {
  // Add an nonce field so we can check for it later.
	wp_nonce_field( 'custom_author_meta_box', 'custom_author_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_custom_author', true );

	echo '<label for="custom_author">';
	_e( 'Enter the author, or leave blank to use default.', 'twofifty' );
	echo '</label> ';
	echo '<br /><input type="text" id="custom_author" name="custom_author" placeholder="Josiah Carberry" value="' . esc_attr( $value ) . '" size="25" />';
}

function custom_author_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Verify nonce, avoid updating on autosave, check user permissions
	if ( ! isset( $_POST['custom_author_meta_box_nonce'] ) ||
       ! wp_verify_nonce( $_POST['custom_author_meta_box_nonce'], 'custom_author_meta_box' ) ||
        ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || 
        (isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id )) ||
        ! current_user_can ( 'edit_post', $post_id ) ||
        ! isset( $_POST['custom_author'] ) ) {
		return;
	}
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['custom_author'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_custom_author', $my_data );
}
add_action( 'save_post', 'custom_author_save_meta_box_data' );
