<?php

/**
 * Constants definition.
 */
define( 'CAPSLOCK_THEME_VERSION', '0.8' );
define( 'CAPSLOCK_THEME_ENV', 'development' );
//define( 'CAPSLOCK_THEME_ENV', 'production' );
define( 'CAPSLOCK_THEME_DIR_URI', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'CAPSLOCK_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'CAPSLOCK_THEME_ASSETS_URI', trailingslashit( CAPSLOCK_THEME_DIR_URI . 'assets' ) );
define( 'CAPSLOCK_SCRIPT_VERSION', 'production' === CAPSLOCK_THEME_ENV ? CAPSLOCK_THEME_VERSION : time() );

function capslock_is_prod() {
	return 'production' === CAPSLOCK_THEME_ENV;
}

function capslock_diff_by_env( $prod_value = '', $stage_value = '' ) {
	return capslock_is_prod() ? $prod_value : $stage_value;
}

function capslock_get_style_url( $filename ) {
	return CAPSLOCK_THEME_ASSETS_URI .  'css/' . $filename . capslock_diff_by_env( '.min.css', '.css' );
}

function capslock_get_style_module_url( $filename ) {
	return CAPSLOCK_THEME_ASSETS_URI .  'css/modules/' . $filename . '.min.css';
}

function capslock_get_script_url( $filename ) {
	return CAPSLOCK_THEME_ASSETS_URI .  'js/' . $filename . capslock_diff_by_env( '.min.js', '.js' );
}

function capslock_get_script_module_url( $filename ) {
	return CAPSLOCK_THEME_ASSETS_URI .  'js/modules/' . $filename . '.min.js';
}

function capslock_get_script_version() {
	return CAPSLOCK_SCRIPT_VERSION;
}

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
