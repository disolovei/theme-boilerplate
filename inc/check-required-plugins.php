<?php
/**
 * 
 */
function capslock_check_required_plugins() {
	$required_plugins = [
		[
			'name'	=> 'Contact Form 7',
			'file'	=> 'contact-form-7/wp-contact-form-7.php',
			'link'	=> 'https://uk.wordpress.org/plugins/contact-form-7',
		],
		[
			'name'	=> 'Advanced Custom Fields',
			'file'	=> 'advanced-custom-fields/acf.php',
			'link'	=> 'https://uk.wordpress.org/plugins/contact-form-7',
		],
	];

	if ( ! function_exists( 'is_plugin_active' ) ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
    }
    
    $admin_notice_text = '';

	foreach ( $required_plugins as $plugin ) {
		if ( ! empty( $plugin['file'] ) && ! is_plugin_active( $plugin['file'] ) ) {
            $admin_notice_text .= sprintf( 
                '<a href="%s" target="_blank">%s</a>, ', 
                ! empty( $plugin['link'] ) ? $plugin['link'] : '#',
                $plugin['name']
            );
		}
    }
    
    if ( $admin_notice_text ) {
        add_action( 'admin_notices', function() use ( $admin_notice_text ) {
            echo '<div class="notice notice-warning is-dismissible"><p>Theme requires next plugins ' . rtrim( $admin_notice_text, ', ' ) . '. Please download and install their.</p></div>';
        } );
    }
}
add_action( 'after_setup_theme', 'capslock_check_required_plugins' );