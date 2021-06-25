<?php
/**
 * angstrom Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package angstrom
 * @since 1.0.0
 */

include_once('dequeue.php');
/********************************************************/


add_theme_support( 'menus' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );
 // add_theme_support('custom-spacing');
 add_theme_support( 'editor-styles' );
add_editor_style('css/sceditorstyle.css');

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


function child_enqueue_styles() {
	wp_enqueue_style( 'angstrom-theme-css', get_stylesheet_directory_uri() . '/style.css' );
  wp_enqueue_style( 'sc-frontend-style', get_stylesheet_directory_uri() . '/css/frontend-styles.css'  );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


function staffcollege_styles() {
  wp_enqueue_style( 'sc-css-vars', get_stylesheet_directory_uri() . '/css/sc-vars.css'  );
  wp_enqueue_style( 'sc-guten-style', get_stylesheet_directory_uri() . '/css/layout-styles.css'  );

  wp_enqueue_script( 'script',  get_stylesheet_directory_uri() . '/js/dom-inclusions.js');
}
add_action( 'enqueue_block_assets', 'staffcollege_styles' );

function google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'google_fonts' );


/* MENUS - REGISTER LOCATIONS */
function pher_custom_new_menu() {
  register_nav_menus(
    array(
      'sc-small-menu' => __( 'Small Menu' ),
      'sc-large-menu' => __( 'Large Menu' )
    )
  );
}
add_action( 'init', 'pher_custom_new_menu' );

/***********/


// -- Editor Color Palette
// -- Disable Custom Colors
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Blue', 'staffcollege' ),
		'slug'  => 'blue',
		'color'	=> '#59BACC',
	),
	array(
		'name'  => __( 'Green', 'staffcollege' ),
		'slug'  => 'green',
		'color' => '#58AD69',
	),
)
);