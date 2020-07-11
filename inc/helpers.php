<?php
function capslock_is_blog() {
	return (int)get_option( 'page_for_posts', -1 ) === get_queried_object_id();
}

function capslock_is_ajax() {
	return function_exists( 'wp_doing_ajax' ) ? wp_doing_ajax() : ( defined( 'DOING_AJAX' ) && DOING_AJAX );
}

function capclock_return_if_true( $condition, $value, $otherwise_return = null ) {
	return $condition ? $value : $otherwise_return;
}

function capclock_echo_if_true( $condition, $value, $otherwise_return = null ) {
	echo capclock_return_if_true( $condition, $value, $otherwise_return );
}