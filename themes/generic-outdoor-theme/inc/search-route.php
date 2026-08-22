<?php
/**
 * Custom REST API Search Route
 *
 * Provides a custom REST endpoint for searching across multiple post types.
 */

/**
 * Check whether the current request is allowed to use the public search endpoint.
 *
 * @return bool|\WP_Error
 */
function generic_outdoor_search_permission_callback()
{
  if (!apply_filters('genericOutdoor/allow_public_search', true)) {
    return new \WP_Error('rest_forbidden', __('Search is currently unavailable.', 'generic-outdoor-theme'), array('status' => 403));
  }

  if (!generic_outdoor_search_rate_limit_check()) {
    return new \WP_Error('rest_rate_limited', __('Too many search requests. Please try again shortly.', 'generic-outdoor-theme'), array('status' => 429));
  }

  return true;
}

/**
 * Limit public search requests per IP address to help reduce abuse.
 *
 * @return bool
 */
function generic_outdoor_search_rate_limit_check()
{
  $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';

  if (empty($ip)) {
    return true;
  }

  $identity = apply_filters('generic_outdoor_search_rate_limit_identity', $ip);

  if (!is_string($identity) || empty($identity)) {
    return true;
  }

  $key = 'generic_outdoor_search_' . md5($identity);

  if (wp_using_ext_object_cache()) {
    $group = 'generic_outdoor_search';
    $count = wp_cache_get($key, $group);

    if (false === $count) {
      wp_cache_set($key, 1, $group, MINUTE_IN_SECONDS);
      return true;
    }

    if ((int) $count >= 30) {
      return false;
    }

    wp_cache_incr($key, 1, $group);
    return true;
  }

  $count = (int) get_transient($key);

  if ($count >= 30) {
    return false;
  }

  set_transient($key, $count + 1, MINUTE_IN_SECONDS);

  return true;
}

/**
 * Build a normalized result item for the custom search endpoint.
 *
 * @param int $post_id The post ID.
 * @param string $post_type The post type.
 * @param mixed|null $price Optional price value.
 * @param array $extra Additional item properties.
 * @return array
 */
function generic_outdoor_search_build_item($post_id, $post_type, $price = null, $extra = array())
{
  $item = array(
    'title' => get_the_title($post_id),
    'permalink' => get_permalink($post_id),
    'postType' => $post_type,
  );

  if ($price !== null) {
    $item['price'] = $price;
  }

  foreach ($extra as $key => $value) {
    $item[$key] = $value;
  }

  return $item;
}

/**
 * Register the custom search endpoint.
 *
 * Endpoint: wp-json/genericOutdoor/v1/search
 */
function generic_outdoor_register_search()
{
  register_rest_route('genericOutdoor/v1', 'search', array(
    'methods' => \WP_REST_SERVER::READABLE,
    'callback' => 'generic_outdoor_search_results',
    'permission_callback' => 'generic_outdoor_search_permission_callback',
    'args' => array(
      'term' => array(
        'required' => true,
        'sanitize_callback' => 'sanitize_text_field',
        'validate_callback' => function ($value) {
          return is_string($value) && strlen(trim($value)) >= 2;
        },
      ),
    ),
  ));
}
add_action('rest_api_init', 'generic_outdoor_register_search');

/**
 * Callback for the custom search REST endpoint.
 *
 * @param \WP_REST_Request $request The REST request object.
 * @return array|\WP_REST_Response Combined results for products, services, and general info.
 */
function generic_outdoor_search_results($request)
{
  $term = trim(sanitize_text_field($request->get_param('term')));

  if (empty($term) || strlen($term) < 2) {
    return new \WP_REST_Response(
      array('error' => __('Search term must be at least 2 characters.', 'generic-outdoor-theme')),
      400
    );
  }

  $mainQuery = new \WP_Query(array(
    'post_type' => array('post', 'page', 'product', 'service'),
    'post_status' => 'publish',
    's' => $term,
    'posts_per_page' => 6,
    'no_found_rows' => true,
    'orderby' => 'relevance',
  ));

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

  if (!empty($productTypeTerms) && !is_wp_error($productTypeTerms)) {
    $termIds = wp_list_pluck($productTypeTerms, 'term_id');

    $productQuery = new \WP_Query(array(
      'post_type' => 'product',
      'post_status' => 'publish',
      'posts_per_page' => 6,
      'no_found_rows' => true,
      'orderby' => 'relevance',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_type',
          'field' => 'term_id',
          'terms' => $termIds,
        ),
      ),
    ));

    while ($productQuery->have_posts()) {
      $productQuery->the_post();
      if (!is_post_publicly_viewable(get_the_ID())) {
        continue;
      }
      $results['products'][get_the_ID()] = generic_outdoor_search_build_item(
        get_the_ID(),
        get_post_type(),
        function_exists('get_field') ? get_field(GENERIC_OUTDOOR_PRODUCT_PRICE_FIELD) : null
      );
    }
    wp_reset_postdata();
  }

  while ($mainQuery->have_posts()) {
    $mainQuery->the_post();
    if (!is_post_publicly_viewable(get_the_ID())) {
      continue;
    }
    $postType = get_post_type();

    if ($postType === 'product') {
      $results['products'][get_the_ID()] = generic_outdoor_search_build_item(
        get_the_ID(),
        $postType,
        function_exists('get_field') ? get_field(GENERIC_OUTDOOR_PRODUCT_PRICE_FIELD) : null
      );
    } elseif ($postType === 'service') {
      $results['services'][] = generic_outdoor_search_build_item(
        get_the_ID(),
        $postType,
        function_exists('get_field') ? get_field(GENERIC_OUTDOOR_SERVICE_PRICE_FIELD) : null
      );
    } else {
      $results['generalInfo'][] = generic_outdoor_search_build_item(
        get_the_ID(),
        $postType,
        null,
        array('authorName' => get_the_author())
      );
    }
  }

  wp_reset_postdata();

  $results['products'] = array_values($results['products']);

  return $results;
}