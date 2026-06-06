<?php
/**
 * Custom REST API Search Route
 *
 * Provides a custom REST endpoint for searching across multiple post types
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

  $tax_query = array();
  if (!empty($productTypeTerms) && !is_wp_error($productTypeTerms)) {
    $termIds = wp_list_pluck($productTypeTerms, 'term_id');
    $tax_query = array(
      array(
        'taxonomy' => 'product_type',
        'field' => 'term_id',
        'terms' => $termIds,
      ),
    );
  }

  // Single query combining both search and taxonomy filtering
  $productQuery = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    's' => $term,
    'tax_query' => $tax_query,
  ));

  $productsByType = array();
  while ($productQuery->have_posts()) {
    $productQuery->the_post();

    $productsByType[get_the_ID()] = array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
      'postType' => get_post_type(),
      'price' => get_field('price'),
    );
  }

  wp_reset_postdata();

  $results = array(
    'generalInfo' => array(),
    'products' => array(),
    'services' => array(),
  );

  while ($mainQuery->have_posts()) {
    $mainQuery->the_post();

    $item = array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
      'postType' => get_post_type(),
      'authorName' => get_the_author(),
    );

    if (get_post_type() === 'product') {
      $item['price'] = get_field('price');
      $results['products'][get_the_ID()] = $item;
    } elseif (get_post_type() === 'service') {
      $results['services'][] = $item;
    } else {
      $results['generalInfo'][] = $item;
    }
  }

  wp_reset_postdata();

  foreach ($productsByType as $id => $product) {
    $results['products'][$id] = $product;
  }

  $results['products'] = array_values($results['products']);


  return $results;
}