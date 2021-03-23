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
add_action( 'wp_enqueue_scripts', function() {
	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );
	wp_deregister_style( 'wp-block-library' );

	wp_register_style( 'main-async', capslock_get_style_url( 'main' ), [], capslock_get_script_version() );

	wp_register_script(  'jquery', capslock_get_script_module_url( 'jquery' ), null, '1.7.2' );
	wp_register_script(  'main-defer-async', capslock_get_script_url( 'main' ), null, capslock_get_script_version(), true );

	wp_enqueue_script( 'main-defer-async' );
} );


add_action( 'wp_footer', function() {
	wp_enqueue_style( 'main-async' );
} );


add_action( 'capslock_open_head', function() {
	//Preload rules
} );


add_filter( 'script_loader_tag', function( $tag, $handle ) {
	if ( false !== strpos( $handle, '-async' ) ) {
		$tag = str_replace( '<script', '<script async="true"', $tag );
	}

	if ( false !== strpos( $handle, '-defer' ) ) {
		$tag = str_replace( '<script', '<script defer="true"', $tag );
	}

	return $tag;
}, 10, 2 );

add_filter( 'style_loader_tag', function( $tag, $handle, $href ) {
	if ( false !== strpos( $handle, '-async' ) ) {
		return '<link rel="preload" href="' . $href . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"><noscript>' . $tag . '</noscript>';
	}

	return $tag;
}, 10, 3 );

add_filter( 'body_class', function( $classes ) {
	if ( capslock_is_webp_supported() ) {
		$classes[''] = 'with-webp';
	}

	return $classes;
} );
