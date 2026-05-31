<?php
/*
Plugin Name: Generic Outdoor MU Post Types
Description: Must-use plugin that registers the site-wide Product and Service custom post types.
Version: 1.0
Author: Generic Outdoor

This MU plugin registers two custom post types used across the site:
- `product` (Products)
- `service` (Services)

Customization:
To change labels, supports, visibility, or other registration args,
add a filter on `generic_outdoor_product_args` or `generic_outdoor_service_args`.

Example (in a site-specific plugin or theme `functions.php`):

add_filter( 'generic_outdoor_product_args', function( $args ) {
    $args['rewrite'] = array( 'slug' => 'shop-products' );
    $args['supports'][] = 'excerpt';
    return $args;
} );

add_filter( 'generic_outdoor_service_args', function( $args ) {
    $args['menu_icon'] = 'dashicons-admin-tools';
    return $args;
} );
*/

if (!defined('WPINC')) {
    die;
}

add_action('admin_notices', function () {
    echo '<div class="notice notice-success is-dismissible"><p>Generic Outdoor MU plugin active.</p></div>';
});

// Add site-wide tweaks below

/**
 * Register custom post types: Products and Services
 */
function generic_outdoor_register_post_types()
{
    // Products
    $product_args = array(
        'capability_type' => 'product',
        'map_meta_cap' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'thumbnail'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'products'),
        'labels' => array(
            'name' => 'Products',
            'add_new_item' => 'Add New Product',
            'edit_item' => 'Edit Product',
            'all_items' => 'All Products',
            'singular_name' => 'Product',
        ),
        'menu_icon' => 'dashicons-cart',
    );
    /**
     * Filter product registration args.
     *
     * @param array $product_args Array of arguments for register_post_type.
     */
    $product_args = apply_filters('generic_outdoor_product_args', $product_args);
    register_post_type('product', $product_args);

    // Services
    $service_args = array(
        'capability_type' => 'service',
        'map_meta_cap' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'thumbnail'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'services'),
        'labels' => array(
            'name' => 'Services',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
            'all_items' => 'All Services',
            'singular_name' => 'Service',
        ),
        'menu_icon' => 'dashicons-hammer',
    );
    /**
     * Filter service registration args.
     *
     * @param array $service_args Array of arguments for register_post_type.
     */
    $service_args = apply_filters('generic_outdoor_service_args', $service_args);
    register_post_type('service', $service_args);
}

function register_product_taxonomy()
{
    register_taxonomy('product_type', 'product', array(
        'label' => 'Product Type',
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true, // IMPORTANT for API
        'rewrite' => array('slug' => 'product-type'),
    ));
}
add_action('init', 'register_product_taxonomy');

/**
 * Register custom post types: Products and Services
 *
 * This function registers two post types with basic arguments suitable for
 * editing via the REST API and the admin UI. If you need to modify the
 * registration arguments, use the filters documented above (`generic_outdoor_product_args`
 * and `generic_outdoor_service_args`).
 */
add_action('init', 'generic_outdoor_register_post_types');
