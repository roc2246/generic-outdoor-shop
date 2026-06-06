<?php

get_header();
pageBanner(array(
    'title' => 'Our Services',
    'subtitle' => 'Explore the outdoor support and expertise we provide for every adventure.'
));
?>

<div class="container container--narrow page-section">
    <?php if (have_posts()): ?>
        <div class="grid">
            <?php while (have_posts()):
                the_post(); ?>
                <?php
                generic_shop_card([
                    'name_field' => 'service_name',
                    'price_field' => 'service_price',
                    'button_text' => 'View Service',
                ]);
                ?>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(); ?>
    <?php else: ?>
        <p>No services found at this time. Please check back later.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>