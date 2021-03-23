<?php

defined( 'ABSPATH' ) || exit;

final class Capslock_Resource_Preloader {

	protected $preload_resources = [];

	protected static $instance = null;

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'capslock_open_head', [$this, 'preload'] );
	}

	public function add_preload_resource( $handle, $resource_link, $preload_as, $type = '', $crossorigin = 'anonymous' ) {
		if ( $this->is_too_late() ) {
			return;
		}

		$this->preload_resources[$handle] = new Capslock_Preload_Resource(
			compact(
				'resource_link',
				'preload_as',
				'type',
				'crossorigin'
			)
		);
	}

	public function preload_resources_exists() {
		return count( $this->preload_resources ) !== 0;
	}

	public function preload() {
		if ( $this->is_too_late() ) {
			return;
		}

		if ( ! self::preload_resources_exists() ) {
			return;
		}

		foreach( $this->preload_resources as $handle => $resource ) {
			$resource->preload();
		}

		$this->preload_resources = [];
	}

	private function is_too_late() {
		return did_action( 'capslock_open_head' ) !== 0 && ! doing_action( 'capslock_open_head' );
	}
}
