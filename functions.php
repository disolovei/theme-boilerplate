<?php

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
remove_action( 'template_redirect', 'wp_shortlink_header', 11);
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'template_redirect', 'rest_output_link_header', 11 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'wp_resource_hints', 2 );

/**
 * Work with scrips and styles.
 */

if ( ! current_theme_supports( 'html5', 'script' ) ) {
	function capslock_remove_script_tag_type( $tag ) {
		return preg_replace( '/ type=(\'|\")text\/javascript\1/', '', $tag );
	}
	add_filter( 'script_loader_tag', 'capslock_remove_script_tag_type' );
}

if ( ! current_theme_supports( 'html5', 'style' ) ) {
	function capslock_remove_style_tag_type( $tag ) {
		return preg_replace( '/ type=(\'|\")text\/style\1/', '', $tag );
	}
	add_filter( 'style_loader_tag', 'capslock_remove_style_tag_type' );
}

function capslock_enqueue_script() {
	$template_directory_uri = trailingslashit( get_template_directory_uri() );

	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );
	wp_register_script(  'jquery', $template_directory_uri . '/assets/' );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'capslock_enqueue_script' );

/**
 * Include dependencies.
 */
include_once 'inc/helpers.php';
include_once 'inc/template-functions.php';
include_once 'inc/shortcodes.php';
include_once 'inc/register-entities.php';
include_once 'inc/breadcrumbs.php';