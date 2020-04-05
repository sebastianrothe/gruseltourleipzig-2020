<?php
/**
 * Twenty Seventeen: Gruseltour Berlin Adjustments
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

add_action('wp_enqueue_scripts', 'update_jquery');
function update_jquery(){
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://code.jquery.com/jquery-3.3.1.min.js"), false, '3.3.1', true);
	wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'update_jquery_migrate');
function update_jquery_migrate(){
    wp_deregister_script('jquery-migrate');
    wp_register_script('jquery-migrate', ("https://code.jquery.com/jquery-migrate-3.0.1.min.js"), 'jquery', '3.0.1', true);
	wp_enqueue_script('jquery-migrate');
}