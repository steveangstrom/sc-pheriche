<?php

/* SPEED UP AND TRIM FAT
 and remove un-needed scripts and fonts, etc*/

 /* Unregister blocks */



remove_theme_support( 'core-block-patterns' );// kill redundant factory block patterns
remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );

//add_filter( 'astra_enable_default_fonts', '__return_false' ); // kill redundant fonts


// Remove each style one by one

add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles', 20 );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
  unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' ); // kill and Woo styles.

function slug_disable_woocommerce_block_styles() {
  wp_dequeue_style( 'wc-block-style' );
}
add_action( 'wp_enqueue_scripts', 'slug_disable_woocommerce_block_styles',20 );


add_action('wp_default_scripts', function ($scripts) {
  // kill redundant jquery migrate
    if (!empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
    }
});

/* TIDY UP MARKETING AND ANALYTICS OF WOO */
function sc_remove_menu_pages() {
  //https://plugintests.com/plugins/wporg/woocommerce/tips
  remove_menu_page('edit-comments.php'); // remove analytics main tree.
	remove_menu_page('wc-admin&path=/analytics/overview'); // remove analytics main tree.
	remove_menu_page('woocommerce-marketing');  //Hide "Marketing".
  remove_menu_page('woocommerce');  //Hide "WooCommerce"
	remove_submenu_page('woocommerce', 'wc-status');	//Hide "WooCommerce → Status".
	remove_submenu_page('woocommerce', 'wc-addons');	//Hide "WooCommerce → Extensions".
}
add_action( 'admin_menu', 'sc_remove_menu_pages', 100 );

	/**
	 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	//add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}


	add_action( 'init', 'disable_emojis' );


	function disable_emojis_tinymce( $plugins ) {
	        if ( is_array( $plugins ) ) {
                return array_diff( $plugins, array( 'wpemoji' ) );
        }
        return array();
	}

/*
	add_filter('allowed_block_types', function($block_types, $post) {
	$allowed_pubs_types = [
		'core/paragraph',
		'core/heading',
		'core/image',
		'core/list',
		'core/pullquote',
		'core/table',
		'core/image',
		'core/gallery',
		'core/audio',
		'core/video',
		'core/spacer',
		'core/youtube'
	];
	if ($post->post_type == 'sc_publications') {
		return $allowed_pubs_types;
	}
	return $block_types;
}, 10, 2);*/