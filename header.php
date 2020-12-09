<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<?php do_action( 'capslock_open_head' ); ?>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php capclock_the_page_title(); ?></title>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="site-content">
    <header class="site-header">

    </header>
    <div class="page-content">
