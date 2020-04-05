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
    wp_register_script('jquery', ("https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"), false, '3.4.1', true);
	wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'remove_jquery_migrate');
function remove_jquery_migrate(){
    wp_deregister_script('jquery-migrate');
}

add_filter('autoptimize_filter_extra_gfont_fontstring','add_display');
function add_display($in) {
  return $in.'&amp;display=auto';
}

//add_filter('autoptimize_filter_js_defer','noRocketsForAO',10,1);
function noRocketsForAO($in) {
    return $in.'data-cfasync=false';
}