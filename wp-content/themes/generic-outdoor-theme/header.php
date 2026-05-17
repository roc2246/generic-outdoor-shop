<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
<header class="site-header">
    <div class="site-branding">
        <?php if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
        <p class="site-description"><?php bloginfo('description'); ?></p>
    </div>
    <nav class="site-navigation">
        <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
    </nav>
</header>
