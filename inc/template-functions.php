<?php
function capclock_get_page_title() {
	$page_title = get_bloginfo( 'name' );
	$wp_title   = wp_title( '', false );
	return $wp_title ? $wp_title . ' | ' . $page_title : $page_title;
}

function capclock_the_page_title() {
	echo capclock_get_page_title();
}

function capslock_get_template_part( $slug, $name ) {
	get_template_part( "template-parts/$slug", $name );
}