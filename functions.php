<?php
/**
 * Include dependencies.
 */
include_once 'inc/helpers.php';
include_once 'inc/template-functions.php';
include_once 'inc/theme-setup.php';

/**
 * Include scripts
 */
add_action( 'wp_enqueue_scripts', 'capslock_enqueue_scripts' );
function capslock_enqueue_scripts() {
	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );
	wp_deregister_style( 'wp-block-library' );

	wp_register_style( 'main-async', capslock_get_style_url( 'main' ), [], capslock_get_script_version() );

	wp_register_script(  'jquery', capslock_get_script_module_url( 'jquery' ), null, '1.7.2' );
	wp_register_script(  'main-defer-async', capslock_get_script_url( 'main' ), null, capslock_get_script_version(), true );

	wp_enqueue_script( 'main-defer-async' );
}

add_action( 'wp_footer', 'capslock_wp_footer' );
function capslock_wp_footer() {
	wp_enqueue_style( 'main-async' );
}

add_action( 'capslock_open_head', 'capslock_preload_assets' );
function capslock_preload_assets() {

}

add_filter( 'script_loader_tag', 'capslock_defer_async_script', 20, 2 );
function capslock_defer_async_script( $tag, $handle ) {
	if ( false !== strpos( $handle, '-async' ) ) {
		$tag = str_replace( '<script', '<script async="true"', $tag );
	}

	if ( false !== strpos( $handle, '-defer' ) ) {
		$tag = str_replace( '<script', '<script defer="true"', $tag );
	}

	return $tag;
}

add_filter( 'style_loader_tag', 'capslock_style_loader_tag', 10, 3 );
function capslock_style_loader_tag( $tag, $handle, $href ) {
	if ( false !== strpos( $handle, '-async' ) ) {
		return '<link rel="preload" href="' . $href . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"><noscript>' . $tag . '</noscript>';
	}

	return $tag;
}

add_filter( 'body_class', 'capslock_webp_check_support' );
function capslock_webp_check_support( $classes ) {
	if ( capslock_is_webp_supported() ) {
		$classes[''] = 'with-webp';
	}

	return $classes;
}
