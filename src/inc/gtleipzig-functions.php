<?php
/**
 * Twenty Seventeen: Gruseltour Leipzig Adjustments
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

add_action('wp_enqueue_scripts', 'update_jquery');
function update_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.1.min.js"), false, '3.5.1', true);
	wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'remove_jquery_migrate');
function remove_jquery_migrate() {
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

// OpenGraph Images für Startseite
add_action('wp_head', 'add_ogimages_for_frontpage');
function add_ogimages_for_frontpage()
{
    if (!is_front_page()) {
        return;
    }

    $output = '<meta property="og:image" content="https://gruseltour-leipzig.de/wordpress/wp-content/uploads/2013/05/button-scary.png" /><meta property="og:image" content="https://gruseltour-leipzig.de/wordpress/wp-content/uploads/2014/05/cropped-grusel-poster-a3.jpg" /><meta property="og:image" content="https://gruseltour-leipzig.de/wordpress/wp-content/uploads/2014/06/1.jpg" />';
    echo $output;
}

/**
 * Datepicker initialisieren
 */
add_action('wp_enqueue_scripts', 'load_datepicker_scripts');
function load_datepicker_scripts()
{
    // Let's enqueue a script only to be used on a specific page of the site
    if (!is_page('anmeldung')) {
        return;
    }

    // Use `get_stylesheet_directoy_uri() if your script is inside your theme or child theme.
    wp_register_script('dateutil-script', get_stylesheet_directory_uri() . '/js/dateutil.js');
    wp_register_script('datepicker-script', get_stylesheet_directory_uri() . '/js/datepicker.js');

    // Enqueue a script that has both jQuery (automatically registered by WordPress)
    // and my-script (registered earlier) as dependencies.
    wp_enqueue_script('style-datepicker-script', get_stylesheet_directory_uri() . '/js/style-datepicker.js', array('jquery', 'jquery-ui', 'dateutil-script', 'datepicker-script'), false, true);
}

/**
 * Formularanzeige ändern
 */
add_action('wp_enqueue_scripts', 'hide_form_values_scripts');
function hide_form_values_scripts()
{
    if (!isPageWithForm()) {
        return;
    }

    // Enqueue a script that has both jQuery (automatically registered by WordPress)
    wp_enqueue_script('hide-form-values-script', get_stylesheet_directory_uri() . '/js/hide-form-values.js', array('jquery'), false, true);

}

// Jquery UI
add_action('wp_enqueue_scripts', 'load_jquery_ui');
function load_jquery_ui()
{
    // Let's enqueue a script only to be used on a specific page of the site
    if (!is_page('anmeldung')) {
        return;
    }

    wp_enqueue_style('jquery-style', 'https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/smoothness/jquery-ui.css', false, '1.12.1');
}

add_action('wp_enqueue_scripts', 'update_jquery_ui');
function update_jquery_ui(){
    wp_deregister_script('jquery-ui');

    if (!is_page('anmeldung')) {
        return;
    }
    
    wp_register_script('jquery-ui', "https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/jquery-ui.min.js", ['jquery'], '1.12.1', true);
	wp_enqueue_script('jquery-ui');
}

/**
 * Font Awesome hinzufügen (Icons)
 */
add_action('wp_enqueue_scripts', 'load_font_awesome');
function load_font_awesome()
{
    if (!is_blog()) {
        return;
    }

    wp_register_script('font-awesome-5', 'https://kit.fontawesome.com/310e87366c.js', false, '5.15.0', true);
    wp_enqueue_script('font-awesome-5');
}

add_filter( 'script_loader_tag', 'add_font_awesome_5_cdn_attributes', 10, 2 );
function add_font_awesome_5_cdn_attributes( $tag, $handle ) {
    if ( 'font-awesome-5' === $handle ) {
        return str_replace( "src", "crossorigin='anonymous' src", $tag );
    }
    
    return $tag;
}

// Exclude Posts with following id
add_filter('bwp_gxs_excluded_posts', 'bwp_gxs_exclude_posts', 10, 2);
function bwp_gxs_exclude_posts($excluded_posts, $post_type)
{
    // old halloween, wgt and information page
    return array(12, 157, 1356, 1846);
}

// Change form confirmation message
add_filter('grunion_contact_form_success_message', 'change_grunion_success_message');
function change_grunion_success_message($msg)
{
    return '<h3>' . 'Vielen Dank für deine Anfrage. Wir beantworten sie innerhalb weniger Stunden.<br />Solltest du dennoch nach einem Tag keine Antwort von uns erhalten, schau bitte in deinem Spam-Ordner nach. Besonders bei Web.de und GMX-Mailadressen landen wir leider häufig im Spam-Ordner. ' . '</h3>';
}

function is_blog() {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

function isPageWithForm() {
    return (is_page('anmeldung') || is_page('elite-gruseltour') || is_page('geschenkgutschein') || is_page('friedhofstour')|| is_page('wir-erwarten-euch-an-halloween-2015') || is_page('wave-gotik-treffen-2015-wgt') 
    || is_page('wgt-2016') || is_page('wgt-2017') || is_page('halloween-2017') 
    || is_page('halloween-2018') || is_page('walpurgisnacht-2018') 
    || is_page('walpurgisnacht-2019') || is_page('wgt-2019') || is_page('halloween-2019')
    || is_page('walpurgisnacht-2020') || is_page('wgt-2020') || is_page('halloween-2020'));
}
