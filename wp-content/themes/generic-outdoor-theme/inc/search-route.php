<?php


function genericOutdoorRegisterSearch()
{
  register_rest_route('genericOutdoor/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'genericOutdoorSearchResults',
    'permission_callback' => '__return_true',
  ));
}
add_action('rest_api_init', 'genericOutdoorRegisterSearch');

function genericOutdoorSearchResults($request)
{
  $term = sanitize_text_field($request['term']);

  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'product', 'service'),
    's' => $term,
    'posts_per_page' => -1,
  ));

  $productTypeTerms = get_terms(array(
    'taxonomy' => 'product_type',
    'hide_empty' => false,
    'search' => $term,
  ));

  $productsByType = array();

  if (!empty($productTypeTerms) && !is_wp_error($productTypeTerms)) {
    $termIds = wp_list_pluck($productTypeTerms, 'term_id');

    $productTypeQuery = new WP_Query(array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_type',
          'field' => 'term_id',
          'terms' => $termIds,
        ),
      ),
    ));

    while ($productTypeQuery->have_posts()) {
      $productTypeQuery->the_post();

      $productsByType[get_the_ID()] = array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type(),
        'price' => get_field('price'),
      );
    }

    wp_reset_postdata();
  }

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