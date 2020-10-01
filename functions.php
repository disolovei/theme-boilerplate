<?php
/**
 * Constants definition.
 */
define( 'CAPSLOCK_THEME_VERSION', '0.8' );
define( 'CAPSLOCK_IS_PROD_ENV', false );
define( 'CAPSLOCK_THEME_DIR_URI', get_template_directory_uri() . '/' );
define( 'CAPSLOCK_THEME_ASSETS_DIR', CAPSLOCK_THEME_DIR_URI . 'assets/' );

function capslock_is_prod() {
    return CAPSLOCK_IS_PROD_ENV;
}

/**
 * Include dependencies.
 */
include_once 'inc/helpers.php';
include_once 'inc/template-functions.php';
//include_once 'inc/shortcodes.php';
// include_once 'inc/register-entities.php';
include_once 'inc/theme-setup.php';

/**
 * Optional files.
 */
// include_once 'inc/breadcrumbs.php';
// include_once 'inc/check-required-plugins.php';
include_once 'inc/classes/class-capslock-cache.php';
include_once 'inc/cache.php';
include_once 'inc/acf-cache.php';

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

/**
 * Include scripts
 */
function capslock_enqueue_scripts() {
	wp_enqueue_style(
	    'main',
        CAPSLOCK_THEME_ASSETS_DIR . 'css/' . capslock_diff_by_env( 'main.min.css', 'main.css' ),
        null,
        capslock_diff_by_env( CAPSLOCK_THEME_VERSION, time() )
    );

	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );

//	wp_register_script(  'jquery', CAPSLOCK_THEME_ASSETS_DIR . 'js/modules/jquery.min.js', null, '1.7.2' );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script(
	    'main-defer-async',
        CAPSLOCK_THEME_ASSETS_DIR . 'js/' . capslock_diff_by_env( 'main.min.js', 'main.js' ),
//        ['jquery'],
        null,
        capslock_diff_by_env( CAPSLOCK_THEME_VERSION, time() ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'capslock_enqueue_scripts' );

function capslock_defer_async_script( $tag, $handle ) {
	if ( false !== strpos( $handle, '-async' ) ) {
		$tag = str_replace( '<script', '<script async', $tag );
	}

	if ( false !== strpos( $handle, '-defer' ) ) {
		$tag = str_replace( '<script', '<script defer', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'capslock_defer_async_script', 20, 2 );