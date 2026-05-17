<?php

get_header();

while ( have_posts() ) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Products Home
        </a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>

    <div class="product-detail">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="product-detail__image"><?php the_post_thumbnail( 'large' ); ?></div>
      <?php endif; ?>

      <div class="product-detail__summary">
        <?php if ( function_exists( 'get_field' ) ) : ?>
           <?php $name = get_field( 'product_name' ); ?>
          <?php if ( $name ) : ?>
            <p class="product-detail__name">name: <?php echo esc_html( $name ); ?></p>
          <?php endif; ?>
          <?php $price = get_field( 'price' ); ?>
          <?php if ( $price ) : ?>
            <p class="product-detail__price">Price: <?php echo esc_html( $price ); ?></p>
          <?php endif; ?>
        <?php endif; ?>

        <div class="generic-content"><?php the_content(); ?></div>
      </div>
    </div>

    <?php if ( function_exists( 'get_field' ) ) : ?>
      <?php $related_products = get_field( 'related_products' ); ?>
      <?php if ( $related_products ) : ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Related Products</h2>
        <ul class="link-list min-list">
          <?php foreach ( $related_products as $related_product ) : ?>
            <li><a href="<?php echo esc_url( get_permalink( $related_product ) ); ?>"><?php echo esc_html( get_the_title( $related_product ) ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </div>

<?php }

get_footer();
?>