<?php
add_action( 'wp_enqueue_scripts', 'gtleipzig_2020_enqueue_styles' );
function gtleipzig_2020_enqueue_styles() {
    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

/**
* Gruseltour Leipzig adjustments functions and filters.
*/
require get_stylesheet_directory() . '/inc/gtleipzig-functions.php';