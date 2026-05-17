<?php

get_header();
pageBanner(array(
    'title' => 'Our Services',
    'subtitle' => 'Explore the outdoor support and expertise we provide for every adventure.'
));
?>

<div class="container container--narrow page-section">
    <?php if (have_posts()): ?>
        <div class="service-grid">
            <?php while (have_posts()):
                the_post(); ?>
                <article class="service-card">

                    <div class="service-card__content">

                        <h2 class="service-card__title">
                            <?php $name = get_field('service_name'); ?>
                            <?php if ($name): ?>
                                <p class="service-card__name"><?php echo esc_html($name); ?></p>
                            <?php endif; ?>
                        </h2>

                        <a class="service-card__image-link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else: ?>
                                <div class="service-card__placeholder">No image available</div>
                            <?php endif; ?>
                        </a>

                        <p class="service-card__excerpt">
                            <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 25); ?></p>
                        <?php if (function_exists('get_field')): ?>
                            <?php $price = get_field('service_price'); ?>
                            <?php if ($price): ?>
                                <p class="service-card__price">Price: <?php echo esc_html($price); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a class="button button--primary" href="<?php the_permalink(); ?>">View Service</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(); ?>
    <?php else: ?>
        <p>No services found at this time. Please check back later.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>