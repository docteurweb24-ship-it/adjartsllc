<?php
// wp-theme-adjarts functions.php

function adjarts_enqueue_assets() {
    wp_enqueue_style('adjarts-style', get_stylesheet_uri());
    // load bundled CSS if exists
    $css = get_template_directory_uri() . '/assets/css/app.css';
    if ( file_exists( get_template_directory() . '/assets/css/app.css' ) ) {
        wp_enqueue_style('adjarts-app', $css, array('adjarts-style'));
    }
}
add_action('wp_enqueue_scripts', 'adjarts_enqueue_assets');

function adjarts_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'adjarts'),
    ));
}
add_action('after_setup_theme', 'adjarts_theme_setup');
