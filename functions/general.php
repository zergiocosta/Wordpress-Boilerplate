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


/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 */
function flush_rewrite() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'flush_rewrite');