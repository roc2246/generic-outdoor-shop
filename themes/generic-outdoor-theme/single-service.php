<?php

get_header();

while (have_posts()) {
  the_post();
  pageBanner();

  get_template_part('template-parts/content-listing', null, array(
    'post_type' => 'service',
    'home_label' => __('Services Home', 'generic-outdoor-theme'),
    'name_field' => 'service_name',
    'price_field' => 'service_price',
    'description_field' => 'service_description',
    'related_field' => 'related_services',
    'related_heading' => __('Related Services', 'generic-outdoor-theme'),
  ));
}

get_footer();
?>