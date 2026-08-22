<?php

get_header();

while (have_posts()) {
  the_post();
  pageBanner();

  get_template_part('template-parts/content-listing', null, array(
    'post_type' => 'product',
    'home_label' => __('Products Home', 'generic-outdoor-theme'),
    'name_field' => 'product_name',
    'price_field' => 'price',
    'description_field' => 'product_description',
    'related_field' => 'related_products',
    'related_heading' => __('Related Products', 'generic-outdoor-theme'),
  ));
}

get_footer();
?>