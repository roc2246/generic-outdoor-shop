<?php
/**
 * Plugin Name: Custom Auth Routes
 * Description: Custom logout + register URLs
 */

/**
 * Custom route slugs
 */
define('CUSTOM_LOGOUT_SLUG', 'my-logout');
define('CUSTOM_REGISTER_SLUG', 'sign-up');

/**
 * Custom logout URL
 */
add_filter('logout_url', function ($logout_url, $redirect) {

    $url = home_url('/' . CUSTOM_LOGOUT_SLUG . '/');

    if ($redirect) {
        $url = add_query_arg(
            'redirect_to',
            urlencode($redirect),
            $url
        );
    }

    return wp_nonce_url($url, 'log-out');

}, 10, 2);

/**
 * Custom register URL
 */
add_filter('register_url', function ($register_url) {

    return home_url('/' . CUSTOM_REGISTER_SLUG . '/');

});

/**
 * Handle custom routes
 */
add_action('init', function () {

    $request = trim(
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
        '/'
    );

    /**
     * Logout route
     */
    if ($request === CUSTOM_LOGOUT_SLUG) {

        wp_logout();

        wp_safe_redirect(home_url('/'));

        exit;
    }

    /**
     * Register route
     */
    if ($request === CUSTOM_REGISTER_SLUG) {

        wp_safe_redirect(
            add_query_arg('action', 'register', wp_login_url())
        );

        exit;
    }

});