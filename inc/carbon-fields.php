<?php

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', function () {
	Container::make( 'theme_options', __( 'Theme Options' ) )
		->add_fields( array(
			Field::make( 'text', 'crb_text', 'Text Field' )
				->set_help_text('Help text'),
		) );

	Container::make( 'post_meta', __( 'User Settings' ) )
		->where( 'post_type', '=', 'post' )
		->add_tab( __( 'Profile' ), array(
			Field::make( 'text', 'crb_first_name', __( 'First Name' ) ),
			Field::make( 'separator', 'crb_separator', __( 'Separator' ) ),
			Field::make( 'rich_text', 'crb_position', __( 'Position' ) ),
		) )
		->add_tab( __( 'Notification' ), array(
			Field::make( 'textarea', 'crb_email', __( 'Notification Email' ) ),
			Field::make( 'image', 'crb_image', __( 'Image' ) ),
		) )
		->add_tab( 'Repeater', [
			Field::make( 'complex', 'crb_slider', __( 'Slider' ) )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Slide Title' ) ),
					Field::make( 'image', 'photo', __( 'Slide Photo' ) ),
				) )
		] );

	Block::make( __( 'My Shiny Gutenberg Block' ) )
		->add_fields( array(
			Field::make( 'text', 'heading', __( 'Block Heading' ) ),
			Field::make( 'image', 'image', __( 'Block Image' ) ),
			Field::make( 'rich_text', 'content', __( 'Block Content' ) ),
		) )
		->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
		->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
			?>

			<div class="block">
				<div class="block__heading">
					<h1><?php echo esc_html( $fields['heading'] ); ?></h1>
				</div>
				<div class="block__image">
					<?php echo wp_get_attachment_image( $fields['image'], 'full' ); ?>
				</div>
				<div class="block__content">
					<?php echo apply_filters( 'the_content', $fields['content'] ); ?>
				</div>
			</div>

			<?php
		} );
} );

add_action( 'after_setup_theme', function() {
	require_once CAPSLOCK_THEME_DIR . 'vendor/autoload.php';
	\Carbon_Fields\Carbon_Fields::boot();
} );
