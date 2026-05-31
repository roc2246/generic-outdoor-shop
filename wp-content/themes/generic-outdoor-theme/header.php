<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        <header class="site-header">
            <div class="site-branding">
                <?php if (function_exists('the_custom_logo'))
                    the_custom_logo(); ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>">Insert Logo Here</a>
                </h1>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div>
          

            <nav id="site-navigation" class="site-navigation">
                <button type="button" class="js-menu-close menu-close-button" aria-label="Close menu">
                    &times;
                </button>

                <div class="site-navigation__controls">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>

                    <div class="site-navigation__user-controls">
                        <?php if (is_user_logged_in()) { ?>
                            <a href="<?php echo wp_logout_url(); ?>"
                                class="btn btn--small  btn--dark-orange float-left btn--with-photo">
                                <span
                                    class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
                                <span class="btn__text">Log Out</span>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>"
                                class="btn btn--small btn--orange float-left push-right">Login</a>
                            <a href="<?php echo wp_registration_url(); ?>"
                                class="btn btn--small  btn--dark-orange float-left">Sign
                                Up</a>
                        <?php } ?>
                    </div>

                </div>

            </nav>
              <div class="site-header__controls">
                <button type="button" class="js-menu-toggle menu-toggle-button" aria-label="Open menu"
                    aria-expanded="false" aria-controls="site-navigation">
                    <span class="menu-toggle-icon" aria-hidden="true"></span>
                </button>

                <button type="button" class="js-search-trigger search-icon-button" aria-label="Open search">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M10 18a8 8 0 1 1 5.293-14.293A8 8 0 0 1 10 18zm11 3-6-6" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </header>