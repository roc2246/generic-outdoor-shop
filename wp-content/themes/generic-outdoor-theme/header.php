<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        <header class="site-header">
            <div class="site-branding">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else { ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><img
                                src="<?php echo esc_url(get_template_directory_uri()); ?>/build/images/logo.png"
                                alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                                class="site-title__logo"
                                width="150"></a>
                    </h1>
                <?php } ?>
                <p class="site-description"><?php echo esc_html(get_bloginfo('description')); ?></p>
            </div>


            <nav id="site-navigation" class="site-navigation">
                <button type="button" class="js-menu-close menu-close-button" aria-label="<?php esc_attr_e('Close menu', 'generic-outdoor-theme'); ?>">
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
                                <span class="btn__text"><?php _e('Log Out', 'generic-outdoor-theme'); ?></span>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>"
                                class="btn btn--small btn--orange float-left push-right"><?php _e('Login', 'generic-outdoor-theme'); ?></a>
                            <a href="<?php echo wp_registration_url(); ?>"
                                class="btn btn--small  btn--dark-orange float-left"><?php _e('Sign Up', 'generic-outdoor-theme'); ?>
                                </a>
                        <?php } ?>
                    </div>

                </div>

            </nav>
            <div class="site-header__controls">
                <button type="button" class="js-menu-toggle menu-toggle-button" aria-label="<?php esc_attr_e('Open menu', 'generic-outdoor-theme'); ?>"
                    aria-expanded="false" aria-controls="site-navigation">
                    <span class="menu-toggle-icon" aria-hidden="true"></span>
                </button>

                <button type="button" class="js-search-trigger search-icon-button" aria-label="<?php esc_attr_e('Open search', 'generic-outdoor-theme'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M10 18a8 8 0 1 1 5.293-14.293A8 8 0 0 1 10 18zm11 3-6-6" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </header>