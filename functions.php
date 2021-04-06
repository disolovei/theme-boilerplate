<?php
/**
 * Include dependencies.
 */
include_once 'inc/autoload.php';
include_once 'inc/theme-setup.php';
include_once 'inc/template-functions.php';
//include_once 'inc/carbon-fields.php';

/**
 * Include scripts
 */
add_action( 'capslock_open_head', function() {
	Capslock_Asset::register_style( 'main-async', Capslock_Asset::get_style_url( 'main' ), [], Capslock_Helper::get_script_version(), '', true );

	wp_enqueue_script(  'jquery', Capslock_Asset::get_script_module_url( 'jquery' ), null, '1.7.2', true );
	Capslock_Asset::register_script(  'main-defer-async', Capslock_Asset::get_script_url( 'main' ), null, Capslock_Helper::get_script_version(), true, true );

	wp_enqueue_script( 'main-defer-async' );
}, 1 );


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
	if ( Capslock_Helper::is_webp_supported() ) {
		$classes[''] = 'with-webp';
	}

	return $classes;
} );
