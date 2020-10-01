<?php

if ( ! defined( 'ACF' ) || ! function_exists( 'capslock_cache' ) ) {
	return;
}

define( 'CAPSLOCK_ACF_CACHE_KEY', 'acf' );

function capslock_acf_cache_get( $field_name, $post_id, $default_value = '', $force = false ) {
	$post_fields = capslock_cache_get( $post_id, CAPSLOCK_ACF_CACHE_KEY, array() );

	if ( ! $force && ! empty( $post_fields[$field_name] ) ) {
		return $post_fields[$field_name];
	}

	$field_value = get_field( $field_name, $post_id );

	$post_fields[$field_name] = $field_value;

	capslock_cache_add( $post_id, $post_fields, CAPSLOCK_ACF_CACHE_KEY );

	return ! empty( $field_value ) ? $field_value : $default_value;
}

function capslock_acf_get_field( $field_name, $post_id = 0, $force = false ) {
	if ( ! is_numeric( $post_id ) || 0 >= $post_id ) {
		$post_id = get_the_ID();
	}



	if ( $force ) {
		capslock_acf_get_fields( $post_id );
	}

	return capslock_acf_cache_get( $field_name, $post_id );
}

function capslock_acf_get_fields( $post_id = 0, $force = false ) {
	if ( ! is_numeric( $post_id ) || 0 >= $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! $force && $fields = capslock_cache_get( $post_id, CAPSLOCK_ACF_CACHE_KEY ) ) {
		return $fields;
	}

	capslock_cache_add( $post_id, get_fields( $post_id ), CAPSLOCK_ACF_CACHE_KEY );

	return capslock_cache_get( $post_id, CAPSLOCK_ACF_CACHE_KEY, array() );
}

function capslock_acf_the_field( $field_name, $post_id = 0 ) {
	echo capslock_acf_get_field( $field_name, $post_id );
}