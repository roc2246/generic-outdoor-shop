<?php get_header(); ?>

<main id="primary" class="site-main">

  <section class="front-hero" aria-labelledby="front-hero-title">
    <div class="front-hero__overlay">
      <div class="container front-hero__content">
        <p class="front-hero__eyebrow">Generic Outdoor Shop</p>

        <h1 id="front-hero-title" class="front-hero__title">
          Gear, Service, and Local Knowledge
        </h1>

        <p class="front-hero__text">
          Quality outdoor gear, helpful service, and practical advice for every adventure.
        </p>

        <div class="front-hero__actions">
          <a class="button button--primary" href="<?php echo esc_url(home_url('/products')); ?>">
            Shop Products
          </a>

          <a class="button button--secondary" href="<?php echo esc_url(home_url('/services')); ?>">
            View Services
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="page-section">
    <div class="container">
      <?php
      while (have_posts()) :
        the_post();
        the_content();
      endwhile;
      ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>