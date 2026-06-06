<?php

require get_theme_file_path('/inc/acf-fields.php');
require get_theme_file_path('/inc/search-route.php');

/**
 * Register custom fields for the REST API.
 * 
 * Adds the ACF 'price' field to the standard 'product' post type response.
 */
function generic_outdoor_theme_custom_rest()
{
  register_rest_field('product', 'price', array(
    'get_callback' => function ($post) {
      return get_field('price', $post['id']);
    }
  ));
}

add_action('rest_api_init', 'generic_outdoor_theme_custom_rest');

/**
 * Enqueue theme styles and scripts.
 * 
 * Uses filemtime for stylesheet versioning and wp_localize_script for AJAX/REST URLs.
 */
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

/**
 * Theme Setup.
 * 
 * Registers theme support for core features and navigation menus.
 */
function generic_outdoor_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('custom-logo', array(
    'height'      => 60,
    'width'       => 180,
    'flex-height' => true,
    'flex-width'  => true,
  ));
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script',
    'style',
  ));
  add_theme_support('responsive-embeds');
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'generic-outdoor-theme'),
  ));
}
add_action('after_setup_theme', 'generic_outdoor_theme_setup');

if (!function_exists('pageBanner')) {
  /**
   * Display a page banner/header
   *
   * @param array $args {
   *     Optional. Array of banner arguments.
   *     @type string $title    The banner title. Defaults to archive title or post title.
   *     @type string $subtitle Optional subtitle text.
   *     @type string $heading_level HTML heading level (h1-h6). Default 'h1'. Should only be h1 once per page.
   * }
   */
  function pageBanner($args = array())
  {
    $args = wp_parse_args($args, array(
      'title' => is_archive() ? post_type_archive_title('', false) : get_the_title(),
      'subtitle' => '',
      'heading_level' => 'h1',
    ));

    $heading_tag = sanitize_key($args['heading_level']);

    ?>
    <div class="page-banner">
      <div class="page-banner__content container">
        <<?php echo $heading_tag; ?> class="page-banner__title">
          <?php echo esc_html($args['title']); ?>
        </<?php echo $heading_tag; ?>

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


/**
 * Check if the current user has only the subscriber role
 *
 * @return bool True if user is a subscriber, false otherwise.
 */
function generic_outdoor_user_is_subscriber() {
  $user = wp_get_current_user();
  return count($user->roles) === 1 && $user->roles[0] === 'subscriber';
}

// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'generic_outdoor_redirect_subs_to_frontend');

function generic_outdoor_redirect_subs_to_frontend()
{
  if (generic_outdoor_user_is_subscriber()) {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'generic_outdoor_no_subs_admin_bar');

function generic_outdoor_no_subs_admin_bar()
{
  if (generic_outdoor_user_is_subscriber()) {
    show_admin_bar(false);
  }
}

// Customize Login Screen
add_filter('login_headerurl', 'generic_outdoor_login_header_url');

function generic_outdoor_login_header_url()
{
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'generic_outdoor_login_enqueue_styles');

function generic_outdoor_login_enqueue_styles()
{
  wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('generic-outdoor-style', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertitle', 'generic_outdoor_login_header_title');

function generic_outdoor_login_header_title()
{
  return get_bloginfo('name');
}

/**
 * Display a shop item card.
 * 
 * @param array $args {
 *     @type string $name_field  Optional ACF field for the name.
 *     @type string $price_field Optional ACF field for the price.
 *     @type string $button_text Text for the CTA button.
 * }
 */
function generic_shop_card($args = []) {
    $defaults = [
        'name_field'  => '',
        'price_field' => '',
        'button_text' => __('View Item', 'generic-outdoor-theme'),
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

            <a class="card__image-link" href="<?php the_permalink(); ?>" aria-label="View <?php echo esc_attr($name ?: get_the_title()); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    <img class="card__placeholder" src="<?php echo esc_url(get_theme_file_uri('/build/images/default-image.jpg')); ?>" alt="No image available for <?php echo esc_attr($name ?: get_the_title()); ?>">
                <?php endif; ?>
            </a>

            <p class="card__excerpt">
                <?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 25)); ?>
            </p>

            <?php if ($price) : ?>
                <p class="card__price">
                    <?php printf(esc_html__('Price: %s', 'generic-outdoor-theme'), esc_html($price)); ?>
                </p>
            <?php endif; ?>

            <a class="button button--primary" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr($args['button_text'] . ' - ' . ($name ?: get_the_title())); ?>">
                <?php echo esc_html($args['button_text']); ?>
            </a>

        </div>
    </article>

    <?php
}

/**
 * Display a product or service detail view
 *
 * @param array $args {
 *     Optional. Array of detail view arguments.
 *     @type string $wrapper_class The CSS class for the wrapper. Default 'listing-detail'.
 *     @type string $name_field ACF field name for the item name. Default ''.
 *     @type string $price_field ACF field name for the price. Default 'price'.
 *     @type string $description_field ACF field name for the description. Default ''.
 * }
 */
function generic_shop_detail($args = []) {
    $defaults = [
        'wrapper_class'     => 'listing-detail',
        'name_field'        => '',
        'price_field'       => 'price',
        'description_field' => '',
    ];

    $args = wp_parse_args($args, $defaults);

    $wrapper_class = $args['wrapper_class'];

    $name = null;
    $price = null;
    $description = null;

    if (function_exists('get_field')) {
        if ($args['name_field']) {
            $name = get_field($args['name_field']);
        }

        if ($args['price_field']) {
            $price = get_field($args['price_field']);
        }

        if ($args['description_field']) {
            $description = get_field($args['description_field']);
        }
    }
    ?>

    <div class="<?php echo esc_attr($wrapper_class); ?>">

        <?php if (has_post_thumbnail()) : ?>
            <div class="<?php echo esc_attr($wrapper_class); ?>__image">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php else : ?>
            <div class="<?php echo esc_attr($wrapper_class); ?>__image">
                <img
                    src="<?php echo esc_url(get_theme_file_uri('/build/images/default-image.jpg')); ?>"
                    alt="<?php esc_attr_e('No image available', 'generic-outdoor-theme'); ?>">
            </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($wrapper_class); ?>__summary">

            <?php if ($name) : ?>
                <p class="<?php echo esc_attr($wrapper_class); ?>__name">
                    <?php echo esc_html($name); ?>
                </p>
            <?php endif; ?>

            <?php if ($price) : ?>
                <p class="<?php echo esc_attr($wrapper_class); ?>__price">
                    <?php printf(esc_html__('Price: %s', 'generic-outdoor-theme'), esc_html($price)); ?>
                </p>
            <?php endif; ?>

            <?php if ($description) : ?>
                <p class="<?php echo esc_attr($wrapper_class); ?>__description">
                    <?php printf(esc_html__('Description: %s', 'generic-outdoor-theme'), esc_html($description)); ?>
                </p>
            <?php endif; ?>

            <div class="generic-content">
                <?php the_content(); ?>
            </div>

        </div>

    </div>

    <?php
}

/**
 * Modify the main search query to include custom post types and search by taxonomies
 */
function generic_outdoor_adjust_queries($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        // 1. Include products and services in the standard frontend search
        $query->set('post_type', array('post', 'page', 'product', 'service'));
    }
}
add_action('pre_get_posts', 'generic_outdoor_adjust_queries');

/**
 * Extend WordPress search to include taxonomy terms
 * This joins the necessary tables to allow searching by category names, etc.
 */
function generic_outdoor_search_where($where) {
    global $wpdb;

    if (is_search() && !is_admin()) {
        $query = get_search_query();
        $query = $wpdb->esc_like($query);

        // This adds an OR condition to the SQL WHERE clause to check term names
        $where .= " OR (
            t.name LIKE '%{$query}%'
            AND {$wpdb->posts}.post_status = 'publish'
        )";
    }

    return $where;
}

function generic_outdoor_search_join($join) {
    global $wpdb;

    if (is_search() && !is_admin()) {
        // Join the terms and relationships tables so we can see term names
        $join .= " LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id
                   LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                   LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id";
    }

    return $join;
}

function generic_outdoor_search_distinct($distinct) {
    if (is_search() && !is_admin()) {
        // Prevent duplicate results if a post matches on both title and category
        return "DISTINCT";
    }
    return $distinct;
}

add_filter('posts_join', 'generic_outdoor_search_join');
add_filter('posts_where', 'generic_outdoor_search_where');
add_filter('posts_distinct', 'generic_outdoor_search_distinct');
?>