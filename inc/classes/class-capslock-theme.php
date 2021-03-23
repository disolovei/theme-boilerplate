<?php

defined( 'ABSPATH' ) || exit;

final class Capslock_Theme {

	const VERSION = '0.87.3';

	const ENV = 'prod';

	protected $preloader = null;

	protected static $instance = null;

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function is_prod() {
		return 'prod' === Capslock_Theme::ENV;
	}

	public function get_preloader() {
		return $this->preloader;
	}

	protected function __construct() {
		new Capslock_AJAX();

		$this->preloader = Capslock_Resource_Preloader::get_instance();
	}

	public function __wakeup() {
		throw new \Exception("Cannot unserialize a singleton.");
	}
}

function Capslock_Theme() {
	return Capslock_Theme::get_instance();
}
