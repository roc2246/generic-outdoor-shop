<?php

get_header();

while (have_posts()) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Products Home
        </a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>

    <?php display_listing_card(
      'product_name',
      'product_description'
    ); ?>

    <?php if (function_exists('get_field')): ?>
      <?php $related_products = get_field('related_products'); ?>
      <?php if ($related_products): ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Related Products</h2>
        <ul class="link-list min-list">
          <?php foreach ($related_products as $related_product): ?>
            <li><a
                href="<?php echo esc_url(get_permalink($related_product)); ?>"><?php echo esc_html(get_the_title($related_product)); ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </div>

<?php }

get_footer();
?>