<?php

defined( 'ABSPATH' ) || exit;

final class Capslock_Asset {

	public static function register_script( $handle, $src, $deps = [], $ver = false, $in_footer = false, $preload = false ) {
		if ( true === $preload ) {
			$preload_src = $src . ( $ver ? '?ver=' . $ver : '' );
			Capslock_Theme()->get_preloader()->add_preload_resource( $handle, $preload_src, 'script' );
		}

		wp_register_style( $handle, $src, $deps, $ver, $in_footer );
	}

	public static function register_style( $handle, $src, $deps = [], $ver = false, $media = 'all', $preload = false ) {
		if ( true === $preload ) {
			$preload_link = $src . ( $ver ? '?ver=' . $ver : '' );
			Capslock_Theme()->get_preloader()->add_preload_resource( $handle, $preload_link, 'style' );
		}

		wp_register_style( $handle, $src, $deps, $ver, $media );
	}

	public static function get_style_url( $filename, $with_version = false ) {
		return sprintf( CAPSLOCK_THEME_ASSETS_URI . 'css/%s%s', $filename . Capslock_Helper::diff_by_env( '.min.css', '.css' ), $with_version ? '?ver=' . Capslock_Helper::get_script_version() : '' );
	}

	public static function get_style_page_url( $filename, $page = '', $with_version = false ) {
		return sprintf( CAPSLOCK_THEME_ASSETS_URI . 'css/pages/%s/%s.%s%s', $page ? $page : $filename, $filename, Capslock_Helper::diff_by_env( 'min.css', 'css' ), $with_version ? '?ver=' . Capslock_Helper::get_script_version() : '' );
	}

	public static function get_style_module_url( $filename, $with_version = false ) {
		return sprintf( CAPSLOCK_THEME_ASSETS_URI . 'css/modules/%s.min.css%s', $filename, $with_version ? '?ver=' . Capslock_Helper::get_script_version() : '' );
	}

	public static function get_script_url( $filename, $with_version = false ) {
		return sprintf( CAPSLOCK_THEME_ASSETS_URI . 'js/%s%s', $filename . Capslock_Helper::diff_by_env( '.min.js', '.js' ), $with_version ? '?ver=' . Capslock_Helper::get_script_version() : '' );
	}

	public static function get_script_module_url( $filename, $with_version = false ) {
		return sprintf( CAPSLOCK_THEME_ASSETS_URI . 'js/modules/%s.min.js%s', $filename, $with_version ? '?ver=' . Capslock_Helper::get_script_version() : '' );
	}

	public static function get_asset_img_url( $img_name_with_ext ) {
		return CAPSLOCK_THEME_ASSETS_URI . "img/{$img_name_with_ext}";
	}

	public static function get_thumbnail_url( $common_file, $file = '' ) {
		$upload_dir = wp_get_upload_dir();

		if ( '' === $file ) {
			return trailingslashit( $upload_dir['baseurl'] ) . $common_file;
		}


		return trailingslashit( $upload_dir['baseurl'] ) . trailingslashit( dirname( $common_file ) ) . $file;
	}
}
