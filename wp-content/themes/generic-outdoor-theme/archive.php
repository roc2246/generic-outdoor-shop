<?php
get_header();

$post_type = get_post_type();
$post_type_obj = get_post_type_object($post_type);

pageBanner(array(
    'title' => $post_type_obj->labels->name ?? 'Archive',
    'subtitle' => 'Explore our latest content.'
));
?>

<div class="container container--narrow page-section">

    <?php if (have_posts()): ?>

        <div class="service-grid">

            <?php while (have_posts()): the_post(); ?>

                <article class="service-card">

                    <div class="service-card__content">

                        <!-- TITLE (generic fallback) -->
                        <h2 class="service-card__title">
                            <?php the_title(); ?>
                        </h2>

                        <!-- IMAGE -->
                        <a class="service-card__image-link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else: ?>
                                <div class="service-card__placeholder">No image available</div>
                            <?php endif; ?>
                        </a>

                        <!-- EXCERPT -->
                        <p class="service-card__excerpt">
                            <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 25); ?>
                        </p>

                        <!-- ACF PRICE (generic-safe) -->
                        <?php if (function_exists('get_field')): ?>
                            <?php $price = get_field('price'); ?>
                            <?php if ($price): ?>
                                <p class="service-card__price">
                                    Price: <?php echo esc_html($price); ?>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>

                        <a class="button button--primary" href="<?php the_permalink(); ?>">
                            View
                        </a>

                    </div>

                </article>

            <?php endwhile; ?>

        </div>

        <?php the_posts_pagination(); ?>

    <?php else: ?>

        <p>No items found at this time.</p>

    <?php endif; ?>

</div>

<?php get_footer(); ?>