<?php
get_header();

while (have_posts()) :
    the_post();

    pageBanner();

    $post_type = get_post_type();
    $post_type_obj = get_post_type_object($post_type);
    $archive_link = get_post_type_archive_link($post_type);
?>

<div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">

        <p>

            <?php if ($archive_link) : ?>

                <a
                    class="metabox__blog-home-link"
                    href="<?php echo esc_url($archive_link); ?>">

                    <i class="fa fa-home" aria-hidden="true"></i>

                    <?php echo esc_html(
                        $post_type_obj->labels->name ?? 'Archive'
                    ); ?>

                </a>

            <?php endif; ?>

            <span class="metabox__main">
                <?php the_title(); ?>
            </span>

        </p>

    </div>

    <div class="listing-detail">

        <?php if (has_post_thumbnail()) : ?>

            <div class="listing-detail__image">

                <?php the_post_thumbnail('large'); ?>

            </div>

        <?php endif; ?>

        <div class="listing-detail__summary">

            <?php if (function_exists('get_field')) : ?>

                <?php $price = get_field('price'); ?>

                <?php if ($price) : ?>

                    <p class="listing-detail__price">

                        Price: <?php echo esc_html($price); ?>

                    </p>

                <?php endif; ?>

                <?php $description = get_field('description'); ?>

                <?php if ($description) : ?>

                    <p class="listing-detail__description">

                        <?php echo esc_html($description); ?>

                    </p>

                <?php endif; ?>

            <?php endif; ?>

            <div class="generic-content">

                <?php the_content(); ?>

            </div>

        </div>

    </div>

    <?php if (function_exists('get_field')) : ?>

        <?php $related = get_field('related_items'); ?>

        <?php if ($related) : ?>

            <hr class="section-break">

            <h2 class="headline headline--medium">

                Related
                <?php echo esc_html(
                    $post_type_obj->labels->name ?? 'Items'
                ); ?>

            </h2>

            <ul class="link-list min-list">

                <?php foreach ($related as $item) : ?>

                    <li>

                        <a href="<?php echo esc_url(get_permalink($item)); ?>">

                            <?php echo esc_html(
                                get_the_title($item)
                            ); ?>

                        </a>

                    </li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>

    <?php endif; ?>

</div>

<?php
endwhile;

get_footer();
?>