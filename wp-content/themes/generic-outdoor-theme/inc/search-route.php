<?php


add_action('rest_api_init', 'genericOutdoorRegisterSearch');

function genericOutdoorRegisterSearch()
{
  register_rest_route('university/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'universitySearchResults'
  ));
}

function genericOutdoorSearchResults($data)
{
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'product', 'service'),
    's' => sanitize_text_field($data['term'])
  ));

  $results = array(
    'generalInfo' => array(),
    'products' => array(),
    'services' => array(),
  );

  while ($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'post' OR get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    if (get_post_type() == 'product') {
      array_push($results['products'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    if (get_post_type() == 'service') {
      array_push($results['services'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

  }

  return $results;

}