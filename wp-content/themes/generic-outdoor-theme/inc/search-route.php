<?php
/**
 * Custom REST API Search Route
 *
 * Provides a custom REST endpoint for searching across multiple post types
 */

use WP_Query;
use WP_REST_Response;
use WP_REST_Request;
use WP_REST_SERVER;

/**
 * Register the custom search endpoint.
 * 
 * Endpoint: wp-json/genericOutdoor/v1/search
 */
function generic_outdoor_register_search()
{
  register_rest_route('genericOutdoor/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'generic_outdoor_search_results',
    'permission_callback' => function() {
      // Allow unauthenticated access but consider implementing rate limiting in production
      return apply_filters('genericOutdoor/allow_public_search', true);
    },
  ));
}
add_action('rest_api_init', 'generic_outdoor_register_search');

/**
 * Callback for the custom search REST endpoint.
 * 
 * @param WP_REST_Request $request The REST request object.
 * @return array|WP_REST_Response Combined results for products, services, and general info.
 * @throws WP_REST_Response 400 error if search term is too short.
 */
function generic_outdoor_search_results($request)
{
  $term = sanitize_text_field($request->get_param('term'));

  // Validate search term
  if (empty($term) || strlen($term) < 2) {
    return new WP_REST_Response(
      array('error' => 'Search term must be at least 2 characters'),
      400
    );
  }

  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'product', 'service'),
    's' => $term,
    'posts_per_page' => -1,
  ));

  // Get product type terms for combined query
  $productTypeTerms = get_terms(array(
    'taxonomy' => 'product_type',
    'hide_empty' => false,
    'search' => $term,
  ));

  $results = array(
    'generalInfo' => array(),
    'products' => array(),
    'services' => array(),
  );

  // If we found category matches, fetch products in those categories first
  if (!empty($productTypeTerms) && !is_wp_error($productTypeTerms)) {
    $termIds = wp_list_pluck($productTypeTerms, 'term_id');
    
    $productQuery = new WP_Query(array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'tax_query' => array(
      array(
        'taxonomy' => 'product_type',
        'field' => 'term_id',
        'terms' => $termIds,
      ),
      )
    ));

    while ($productQuery->have_posts()) {
      $productQuery->the_post();
      $results['products'][get_the_ID()] = array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type(),
        'price' => function_exists('get_field') ? get_field('price') : null,
      );
    }
    wp_reset_postdata();
  }

  while ($mainQuery->have_posts()) {
    $mainQuery->the_post();
    $postType = get_post_type();

    $item = array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
      'postType' => $postType,
    );

    if ($postType === 'product') {
      $item['price'] = function_exists('get_field') ? get_field('price') : null;
      $results['products'][get_the_ID()] = $item;
    } elseif ($postType === 'service') {
      $item['price'] = function_exists('get_field') ? get_field('service_price') : null;
      $results['services'][] = $item;
    } else {
      $item['authorName'] = get_the_author();
      $results['generalInfo'][] = $item;
    }
  }

  wp_reset_postdata();

  // Convert to indexed array for clean JSON response
  $results['products'] = array_values($results['products']);

  return $results;
}