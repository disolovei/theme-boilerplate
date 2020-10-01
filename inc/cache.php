<?php

include_once 'classes/class-capslock-cache.php';

function capslock_cache() {
	return CAPSLOCK_Cache::instance();
}

function capslock_cache_add( $key, $value, $group = '', $overrewrite = true ) {
	capslock_cache()->add( $key, $value, $group, $overrewrite );
}

function capslock_cache_get( $key, $group = '', $default_value = null ) {
	return capslock_cache()->get( $key, $group, $default_value );
}

function capslock_cache_update( $key, $value, $group = '' ) {
	capslock_cache()->update( $key, $value, $group );
}

function capslock_cache_isset( $key, $group = '' ) {
	capslock_cache()->isset( $key, $group );
}