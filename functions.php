<?php
require_once __DIR__ . '/vendor/autoload.php';
// form
require_once __DIR__ . '/inc/contact-form.php';

add_action('after_setup_theme', function () {
    \Carbon_Fields\Carbon_Fields::boot();
});

add_action('carbon_fields_register_fields', function () {
    foreach (glob(__DIR__ . '/blocks/*.php') as $file) {
        require_once $file;
    }
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('clinic', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css'));
});