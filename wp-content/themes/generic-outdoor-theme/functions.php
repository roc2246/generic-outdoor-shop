<?php

// Uncomment the following code to register a custom REST API endpoint for search functionality

require get_theme_file_path('/inc/search-route.php');

// FOR CUSTOM REST API ENDPOINTS, UNCOMMENT THE FOLLOWING CODE

// function generic_outdoor_theme_custom_rest() {
//   register_rest_field('post', 'authorName', array(
//     'get_callback' => function() {return get_the_author();}
//   ));
// }

// add_action('rest_api_init', 'generic_outdoor_theme_custom_rest');

function generic_outdoor_theme_enqueue_styles()
{
    wp_enqueue_style('generic-outdoor-style', get_theme_file_uri('/build/index.css'), array(), filemtime(get_theme_file_path('/build/index.css')));

    $script_asset = include get_theme_file_path('/build/index.asset.php');
    wp_enqueue_script(
        'generic-outdoor-js',
        get_theme_file_uri('/build/index.js'),
        $script_asset['dependencies'],
        $script_asset['version'],
        true
    );

    wp_localize_script('generic-outdoor-js', 'wpSite', array(
        'root_url' => get_site_url(),
    ));
}
add_action('wp_enqueue_scripts', 'generic_outdoor_theme_enqueue_styles');

function generic_outdoor_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'generic-outdoor-theme'),
    ));
}
add_action('after_setup_theme', 'generic_outdoor_theme_setup');

if (!function_exists('pageBanner')) {
    function pageBanner($args = array())
    {
        $args = wp_parse_args($args, array(
            'title' => is_archive() ? post_type_archive_title('', false) : get_the_title(),
            'subtitle' => '',
        ));

        ?>
        <div class="page-banner">
            <div class="page-banner__content">
                <h1 class="page-banner__title"><?php echo esc_html($args['title']); ?></h1>
                <?php if (!empty($args['subtitle'])): ?>
                    <p class="page-banner__subtitle"><?php echo esc_html($args['subtitle']); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
