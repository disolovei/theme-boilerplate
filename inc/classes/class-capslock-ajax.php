<?php

defined( 'ABSPATH' ) || exit;

final class Capslock_AJAX {
	const NONCE_FIELD_NAME = 'capslock-theme-nonce';

	public function __construct() {
		//Register ajax actions
	}

	private function verify_nonce( $error_message = '' ) {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], Capslock_AJAX::NONCE_FIELD_NAME ) ) {
			wp_die( $error_message );
		}
	}
}
