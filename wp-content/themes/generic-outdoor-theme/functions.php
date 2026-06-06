<?php

require get_theme_file_path('/inc/search-route.php');

function generic_outdoor_theme_custom_rest()
{
  register_rest_field('product', 'price', array(
    'get_callback' => function ($post) {
      return get_field('price', $post['id']);
    }
  ));
}

add_action('rest_api_init', 'generic_outdoor_theme_custom_rest');

function generic_outdoor_theme_enqueue_styles()
{
  wp_enqueue_style('generic-outdoor-style', get_theme_file_uri('/build/index.css'), array(), filemtime(get_theme_file_path('/build/index.css')));

  $script_asset = include get_theme_file_path('/build/index.asset.php');
  wp_enqueue_script(
    'generic-outdoor-js',
    get_theme_file_uri('/build/index.js'),
    $script_asset['dependencies'],
    $script_asset['version'],
    true
  );

  wp_localize_script('generic-outdoor-js', 'wpSite', array(
    'root_url' => get_site_url(),
  ));
}
add_action('wp_enqueue_scripts', 'generic_outdoor_theme_enqueue_styles');

function generic_outdoor_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('custom-logo');
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'generic-outdoor-theme'),
  ));
}
add_action('after_setup_theme', 'generic_outdoor_theme_setup');

if (!function_exists('pageBanner')) {
  function pageBanner($args = array())
  {
    $args = wp_parse_args($args, array(
      'title' => is_archive() ? post_type_archive_title('', false) : get_the_title(),
      'subtitle' => '',
    ));

    ?>
    <div class="page-banner">
      <div class="page-banner__content container">
        <h1 class="page-banner__title">
          <?php echo esc_html($args['title']); ?>
        </h1>

        <?php if (!empty($args['subtitle'])): ?>
          <p class="page-banner__subtitle">
            <?php echo esc_html($args['subtitle']); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
    <?php
  }
}


// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl()
{
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS()
{
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('generic-outdoor-style', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle()
{
  return get_bloginfo('name');
}

function generic_shop_card($args = []) {
    $defaults = [
        'name_field'  => '',
        'price_field' => '',
        'button_text' => 'View Item',
    ];

    $args = wp_parse_args($args, $defaults);

    $name = function_exists('get_field') && $args['name_field']
        ? get_field($args['name_field'])
        : get_the_title();

    $price = function_exists('get_field') && $args['price_field']
        ? get_field($args['price_field'])
        : null;
    ?>

    <article class="card">
        <div class="card__content">

            <h2 class="card__title">
                <a href="<?php the_permalink(); ?>">
                    <?php echo esc_html($name ?: get_the_title()); ?>
                </a>
            </h2>

            <a class="card__image-link" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    <img class="card__placeholder" src="<?php echo get_theme_file_uri('/build/images/default-image.jpg'); ?>" alt="No image available">
                <?php endif; ?>
            </a>

            <p class="card__excerpt">
                <?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25)); ?>
            </p>

            <?php if ($price) : ?>
                <p class="card__price">
                    Price: <?php echo esc_html($price); ?>
                </p>
            <?php endif; ?>

            <a class="button button--primary" href="<?php the_permalink(); ?>">
                <?php echo esc_html($args['button_text']); ?>
            </a>

        </div>
    </article>

    <?php
}


function generic_shop_detail($args = []) {

    $defaults = [
        'wrapper_class' => 'listing-detail',
        'name_field' => '',
        'price_field' => 'price',
        'description_field' => '',
    ];

    $args = wp_parse_args($args, $defaults);

    $name = function_exists('get_field') && $args['name_field']
        ? get_field($args['name_field'])
        : null;

    $price = function_exists('get_field')
        ? get_field($args['price_field'])
        : null;

    $description = function_exists('get_field') && $args['description_field']
        ? get_field($args['description_field'])
        : null;
    ?>

    <div class="<?php echo esc_attr($args['wrapper_class']); ?>">

        <?php if (has_post_thumbnail()) : ?>
            <div class="<?php echo esc_attr($args['wrapper_class']); ?>__image">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <?php else : ?>
                <div class="<?php echo esc_attr($args['wrapper_class']); ?>__image">
                    <img src="<?php echo get_theme_file_uri('/build/images/default-image.jpg'); ?>" alt="No image available">
                </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($args['wrapper_class']); ?>__summary">

            <?php if ($name) : ?>
                <p class="<?php echo esc_attr($args['wrapper_class']); ?>__name">
                    <?php echo esc_html($name); ?>
                </p>
            <?php endif; ?>

            <?php if ($price) : ?>
                <p class="<?php echo esc_attr($args['wrapper_class']); ?>__price">
                    Price: <?php echo esc_html($price); ?>
                </p>
            <?php endif; ?>

            <?php if ($description) : ?>
                <p class="<?php echo esc_attr($args['wrapper_class']); ?>__description">
                    Description: <?php echo esc_html($description); ?>
                </p>
            <?php endif; ?>

            <div class="generic-content">
                <?php the_content(); ?>
            </div>

        </div>

    </div>

    <?php
}