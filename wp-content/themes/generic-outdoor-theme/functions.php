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