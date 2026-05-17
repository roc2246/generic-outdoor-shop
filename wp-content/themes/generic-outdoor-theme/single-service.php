<?php

get_header();

while ( have_posts() ) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Services Home
        </a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>

    <div class="product-detail service-detail">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="product-detail__image"><?php the_post_thumbnail( 'large' ); ?></div>
      <?php endif; ?>

      <div class="product-detail__summary">
        <?php if ( function_exists( 'get_field' ) ) : ?>
          <?php $price = get_field( 'price' ); ?>
          <?php if ( $price ) : ?>
            <p class="product-detail__price">Price: <?php echo esc_html( $price ); ?></p>
          <?php endif; ?>
        <?php endif; ?>

        <div class="generic-content"><?php the_content(); ?></div>
      </div>
    </div>

    <?php if ( function_exists( 'get_field' ) ) : ?>
      <?php $related_services = get_field( 'related_services' ); ?>
      <?php if ( $related_services ) : ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Related Services</h2>
        <ul class="link-list min-list">
          <?php foreach ( $related_services as $related_service ) : ?>
            <li><a href="<?php echo esc_url( get_permalink( $related_service ) ); ?>"><?php echo esc_html( get_the_title( $related_service ) ); ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  </div>

<?php }

get_footer();
?>