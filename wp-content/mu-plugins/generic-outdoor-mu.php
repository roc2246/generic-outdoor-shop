<?php
/*
Plugin Name: Generic Outdoor MU Boilerplate
Description: A simple must-use plugin for site-wide customizations.
Version: 1.0
Author: Generic Outdoor
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

add_action( 'admin_notices', function() {
    echo '<div class="notice notice-success is-dismissible"><p>Generic Outdoor MU plugin active.</p></div>';
});

// Add site-wide tweaks below
