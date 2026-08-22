<?php
if (!isset($args) || !is_array($args)) {
  $args = array();
}

$args = wp_parse_args($args, array(
  'post_type' => 'product',
  'home_label' => __('Products Home', 'generic-outdoor-theme'),
  'name_field' => 'product_name',
  'price_field' => 'price',
  'description_field' => 'product_description',
  'related_field' => 'related_products',
  'related_heading' => __('Related Products', 'generic-outdoor-theme'),
));
?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link($args['post_type'])); ?>">
        <i class="fa fa-home" aria-hidden="true"></i> <?php echo esc_html($args['home_label']); ?>
      </a>
      <span class="metabox__main"><?php the_title(); ?></span>
    </p>
  </div>

  <?php generic_shop_detail(array(
    'name_field' => $args['name_field'],
    'price_field' => $args['price_field'],
    'description_field' => $args['description_field'],
  )); ?>

  <?php if (function_exists('get_field')): ?>
    <?php $related_items = get_field($args['related_field']); ?>
    <?php if ($related_items): ?>
      <hr class="section-break">
      <h2 class="headline headline--medium"><?php echo esc_html($args['related_heading']); ?></h2>
      <ul class="link-list min-list">
        <?php foreach ($related_items as $related_item): ?>
          <li><a href="<?php echo esc_url(get_permalink($related_item)); ?>"><?php echo esc_html(get_the_title($related_item)); ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <?php endif; ?>
</div>
