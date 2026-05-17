<?php

get_header();
pageBanner(array(
  'title' => 'Our Products',
  'subtitle' => 'Browse our full range of outdoor goods and services made for your next adventure.'
));
?>

<div class="container container--narrow page-section">
  <?php if ( have_posts() ) : ?>
    <div class="product-grid">
      <?php while ( have_posts() ) : the_post(); ?>
        <article class="product-card">
          <a class="product-card__image-link" href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'medium' ); ?>
            <?php else : ?>
              <div class="product-card__placeholder">No image available</div>
            <?php endif; ?>
          </a>

          <div class="product-card__content">
            <h2 class="product-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="product-card__excerpt"><?php echo wp_trim_words( get_the_excerpt() ?: get_the_content(), 25 ); ?></p>
            <?php if ( function_exists( 'get_field' ) ) : ?>
               <?php $name = get_field( 'product_name' ); ?>
              <?php if ( $name ) : ?>
                <p class="product-card__name">name: <?php echo esc_html( $name ); ?></p>
              <?php endif; ?>
              <?php $price = get_field( 'price' ); ?>
              <?php if ( $price ) : ?>
                <p class="product-card__price">Price: <?php echo esc_html( $price ); ?></p>
              <?php endif; ?>
            <?php endif; ?>
            <a class="button button--primary" href="<?php the_permalink(); ?>">View Product</a>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

    <?php the_posts_pagination(); ?>
  <?php else : ?>
    <p>No products found at this time. Please check back later.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>