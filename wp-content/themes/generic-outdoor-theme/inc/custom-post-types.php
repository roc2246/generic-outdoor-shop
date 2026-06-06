<?php
/**
 * Custom Post Types & Taxonomies
 *
 * Register custom post types and taxonomies for Products and Services
 */

function generic_outdoor_register_post_types() {
	register_post_type( 'product', array(
		'labels' => array(
			'name'          => __( 'Products', 'generic-outdoor-theme' ),
			'singular_name' => __( 'Product', 'generic-outdoor-theme' ),
			'add_new'       => __( 'Add New Product', 'generic-outdoor-theme' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'        => true,
		'rest_base'           => 'products',
		'menu_icon'           => 'dashicons-shopping-cart',
		'rewrite'             => array( 'slug' => 'products' ),
	) );

	register_post_type( 'service', array(
		'labels' => array(
			'name'          => __( 'Services', 'generic-outdoor-theme' ),
			'singular_name' => __( 'Service', 'generic-outdoor-theme' ),
			'add_new'       => __( 'Add New Service', 'generic-outdoor-theme' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'        => true,
		'rest_base'           => 'services',
		'menu_icon'           => 'dashicons-briefcase',
		'rewrite'             => array( 'slug' => 'services' ),
	) );
}
add_action( 'init', 'generic_outdoor_register_post_types' );

function generic_outdoor_register_taxonomies() {
	register_taxonomy( 'product_type', 'product', array(
		'labels' => array(
			'name'          => __( 'Product Types', 'generic-outdoor-theme' ),
			'singular_name' => __( 'Product Type', 'generic-outdoor-theme' ),
		),
		'public'       => true,
		'show_in_rest' => true,
		'rest_base'    => 'product-types',
		'rewrite'      => array( 'slug' => 'product-type' ),
	) );
}
add_action( 'init', 'generic_outdoor_register_taxonomies' );
