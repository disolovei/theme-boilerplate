<?php

defined( 'ABSPATH' ) || exit;

final class Capslock_Helper {

	public static function is_blog() {
		return (int)get_option( 'page_for_posts', -1 ) === get_queried_object_id();
	}

	public static function is_ajax() {
		return function_exists( 'wp_doing_ajax' ) ? wp_doing_ajax() : ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	}

	public static function is_prod() {
		return Capslock_Theme()->is_prod();
	}

	public static function is_webp_supported() {
		return false !== strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) || false !== strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/' );
	}

	public static function diff_by_env( $prod_value = '', $stage_value = '' ) {
		return self::is_prod() ? $prod_value : $stage_value;
	}

	public static function get_script_version() {
		return Capslock_Theme::ENV === 'prod' ? Capslock_Theme::VERSION : time();
	}
}
