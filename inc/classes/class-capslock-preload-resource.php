<?php

defined( 'ABSPATH' ) || exit;

class Capslock_Preload_Resource {

	protected $link = '';

	protected $preload_as = '';

	protected $type = '';

	protected $crossorigin = '';

	public function __construct( $args = [] ) {
		if ( ! is_array( $args ) ) {
			return;
		}

		if ( ! empty( $args['resource_link'] ) ) {
			$this->link = esc_attr( $args['resource_link'] );
		}

		if ( ! empty( $args['preload_as'] ) ) {
			$this->preload_as = esc_attr( $args['preload_as'] );
		}

		if ( ! empty( $args['type'] ) ) {
			$this->type = esc_attr( $args['type'] );
		}

		if ( ! empty( $args['crossorigin'] ) ) {
			$this->crossorigin = esc_attr( $args['crossorigin'] );
		}
	}

	public function preload() {
		if ( ! ( $this->link && $this->preload_as ) ) {
			return;
		}

		printf(
			'<link rel="preload" href="%s" as="%s"%s crossorigin="%s">' . "\n",
			$this->link,
			$this->preload_as,
			$this->type ? ' type="' . $this->type . '"' : '',
			$this->crossorigin
		);
	}
}
