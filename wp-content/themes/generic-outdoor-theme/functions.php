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

if ( ! function_exists( 'pageBanner' ) ) {
    function pageBanner( $args = array() ) {
        $args = wp_parse_args( $args, array(
            'title'    => is_archive() ? post_type_archive_title( '', false ) : get_the_title(),
            'subtitle' => '',
        ) );

        ?>
        <div class="page-banner">
            <div class="page-banner__content">
                <h1 class="page-banner__title"><?php echo esc_html( $args['title'] ); ?></h1>
                <?php if ( ! empty( $args['subtitle'] ) ) : ?>
                    <p class="page-banner__subtitle"><?php echo esc_html( $args['subtitle'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
