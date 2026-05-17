<?php

function generic_outdoor_theme_enqueue_styles() {
    wp_enqueue_style('generic-outdoor-style', get_stylesheet_uri(), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'generic_outdoor_theme_enqueue_styles');

function generic_outdoor_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'generic-outdoor-theme'),
    ));
}
add_action('after_setup_theme', 'generic_outdoor_theme_setup');
