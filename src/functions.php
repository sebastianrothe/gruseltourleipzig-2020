<?php
add_action( 'wp_enqueue_scripts', 'gtberlin_2018_enqueue_styles' );
function gtberlin_2018_enqueue_styles() {
    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

/**
 * WooCommerce adjustments functions and filters.
 */
// require get_stylesheet_directory() . '/inc/woocommerce-functions.php';

/**
* WPO WCPDF adjustments functions and filters.
*/
// require get_stylesheet_directory() . '/inc/wpo_wcpdf-functions.php';

/**
* Gruseltour Berlin adjustments functions and filters.
*/
require get_stylesheet_directory() . '/inc/gtberlin-functions.php';