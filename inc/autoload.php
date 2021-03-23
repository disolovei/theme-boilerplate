<?php

defined( 'ABSPATH' ) || exit;

function capslock_autoload( $class ) {
	if ( false === strpos( $class, 'Capslock_' ) ) {
		return;
	}

	$file_name = 'class-' . str_replace( ['_', '\\'], ['-', DIRECTORY_SEPARATOR], strtolower( $class ) ) . '.php';
	$file_path = CAPSLOCK_THEME_DIR . "inc/classes/{$file_name}";

	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	}
}
spl_autoload_register( 'capslock_autoload' );
