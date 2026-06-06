<?php

get_header();
pageBanner(array(
  'title' => 'Our Products',
  'subtitle' => 'Browse our full range of outdoor goods and services made for your next adventure.'
));
?>

<div class="container container--narrow page-section">
  <?php if (have_posts()): ?>
    <div class="grid">
      <?php while (have_posts()):
        the_post(); ?>
        <?php get_template_part('template-parts/content', 'product'); ?>
      <?php endwhile; ?>
    </div>

    <?php the_posts_pagination(); ?>
  <?php else: ?>
    <p>No products found at this time. Please check back later.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>