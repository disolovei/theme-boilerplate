<?php

/**
 * Constants definition.
 */
define( 'CAPSLOCK_THEME_DIR_URI', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'CAPSLOCK_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'CAPSLOCK_THEME_ASSETS_URI', trailingslashit( CAPSLOCK_THEME_DIR_URI . 'assets' ) );

include_once CAPSLOCK_THEME_DIR . 'inc/classes/class-capslock-theme.php';

$GLOBALS['Capslock_Theme'] = Capslock_Theme::get_instance();

/**
 * Theme supports setup.
 */
add_theme_support( 'html5', [
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
	'script',
	'style',
] );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
add_theme_support( 'align-wide' );
add_theme_support( 'responsive-embeds' );

/**
 * Remove default actions.
 */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );

add_action( 'wp_enqueue_scripts', function() {
	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );
	wp_deregister_style( 'wp-block-library' );
} );
