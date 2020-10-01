<?php

defined( 'ABSPATH' ) || exit;

final class CAPSLOCK_Cache {

	private $data = array();

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {}
	private function __clone(){}
	private function __wakeup(){}

	public function add( $key, $value, $group = '', $overrewrite = true ) {
		if ( $this->isset( $key, $group ) && ! $overrewrite ) {
			return $this;
		}

		return $this->_set( $key, $value, $group );
	}

	public function get( $key, $group = '', $default_value = null ) {
		if ( ! $this->isset( $key, $group ) ) {
			return is_null( $default_value ) ? null : $default_value;
		}

		return empty( $group ) ? $this->data[$key] : $this->data[$group][$key];
	}

	public function update( $key, $value, $group = '' ) {
		if ( $this->isset( $key, $group ) ) {
			$this->_set( $key, $value, $group );
		}

		return $this;
	}

	public function isset( $key, $group = '' ) {
		return empty( $group ) ? isset( $this->data[$key] ) : isset( $this->data[$group][$key] );
	}

	private function _set( $key, $value, $group = '' ) {
		if ( empty( $group ) ) {
			$this->data[$key] = $value;
		} else {
			$this->data[$group][$key] = $value;
		}

		return $this;
	}
}

$GLOBALS['CAPSLOCK_Cache'] = CAPSLOCK_Cache::instance();