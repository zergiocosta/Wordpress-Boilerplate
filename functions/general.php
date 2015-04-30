<?php
/**
 * @package Project Name
 */

/**
 * Load scripts and style.
 */
function enqueue_scripts() {

    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), null, 'all');

    wp_enqueue_style('style', WP_STYLE_URL . '/style.css' array(), null, false);

    wp_deregister_script('jquery');

    wp_register_script('modernizr', WP_SCRIPT_URL . '/vendor/modernizr-2.6.2.min.js', array(), null, false);
    wp_enqueue_script('modernizr');

    wp_register_script('main', WP_SCRIPT_URL . '/main.min.js', array(), null, true);
    wp_enqueue_script('main');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

$current_user = wp_get_current_user();
if ($current_user->user_login != 'equilibradigital') {
    // admin styles
    function custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/assets/admin/admin.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
    }
    add_action( 'admin_enqueue_scripts', 'custom_wp_admin_style' );
}

// login styles
function custom_login_style() {
    wp_enqueue_style( 'core', get_template_directory_uri() . '/assets/admin/login.css', false ); 
}
add_action( 'login_enqueue_scripts', 'custom_login_style', 10 );


/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 */
function flush_rewrite() {
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'flush_rewrite');