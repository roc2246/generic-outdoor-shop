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

    <?php if (have_posts()) : ?>

        <div class="grid">

            <?php while (have_posts()) : the_post(); ?>

                <article class="card">

                    <div class="card__content">

                        <h2 class="card__title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <a class="card__image-link" href="<?php the_permalink(); ?>">

                            <?php if (has_post_thumbnail()) : ?>

                                <?php the_post_thumbnail('medium'); ?>

                            <?php else : ?>

                                <div class="card__placeholder">
                                    No image available
                                </div>

                            <?php endif; ?>

                        </a>

                        <p class="card__excerpt">
                            <?php echo esc_html(
                                wp_trim_words(
                                    get_the_excerpt() ?: get_the_content(),
                                    25
                                )
                            ); ?>
                        </p>

                        <?php if (function_exists('get_field')) : ?>

                            <?php $price = get_field('price'); ?>

                            <?php if ($price) : ?>

                                <p class="card__price">
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

    <?php else : ?>

        <p>No items found at this time.</p>

    <?php endif; ?>

</div>

<?php get_footer(); ?>