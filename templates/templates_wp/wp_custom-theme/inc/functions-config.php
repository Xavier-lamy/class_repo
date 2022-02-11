<?php

function prefix_enqueue_assets() {
    // Load style.css
    wp_enqueue_style( 'prefix_style', get_stylesheet_uri(), array(), 1.0 );

    // Load CSS
    wp_enqueue_style( 'prefix_main', get_template_directory_uri() . '/assets/css/main.css', array(), 1.0 );

    // Load JS
    wp_enqueue_script( 'prefix_script', get_template_directory_uri() . '/assets/js/script.js', array(), 1.0, true );

}
add_action('wp_enqueue_scripts', 'prefix_enqueue_assets');
