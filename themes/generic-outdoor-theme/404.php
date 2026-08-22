<?php
get_header();

pageBanner(array(
    'title' => __('Page Not Found', 'generic-outdoor-theme'),
    'subtitle' => __('The page you requested could not be found.', 'generic-outdoor-theme'),
    'heading_level' => 'h1',
));
?>

<main id="primary" class="site-main">
    <section class="page-section">
        <div class="container container--narrow generic-content">
            <p>
                <?php esc_html_e('It may have been moved, deleted, or the URL might be incorrect.', 'generic-outdoor-theme'); ?>
            </p>

            <h2><?php esc_html_e('Try one of these options:', 'generic-outdoor-theme'); ?></h2>

            <ul class="link-list min-list">
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php esc_html_e('Return to the homepage', 'generic-outdoor-theme'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/products')); ?>">
                        <?php esc_html_e('Browse products', 'generic-outdoor-theme'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/services')); ?>">
                        <?php esc_html_e('View services', 'generic-outdoor-theme'); ?>
                    </a>
                </li>
            </ul>

            <h2><?php esc_html_e('Search the site', 'generic-outdoor-theme'); ?></h2>
            <?php get_search_form(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>