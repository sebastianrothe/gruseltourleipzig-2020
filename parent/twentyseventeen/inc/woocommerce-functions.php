<?php
/**
 * Twenty Seventeen: WooCommerce Adjustments
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Add the field to the checkout
 */
add_action('woocommerce_before_order_notes', 'add_customer_data_fields');
function add_customer_data_fields($checkout)
{
    echo '<section id="customer-data"><h3>' . __('Informationen zum Gast') . '</h3>';

    woocommerce_form_field('customer--name', [
        'type' => 'text',
        'class' => ['form-row-first'],
        'label' => __('Vorname'),
        'required' => true,
    ], $checkout->get_value('customer--name'));

    woocommerce_form_field('customer--phone', [
        'type' => 'text',
        'class' => ['form-row-last'],
        'label' => __('Telefonnummer'),
        'required' => true,
    ], $checkout->get_value('customer--phone'));

    woocommerce_form_field('customer--email', [
        'type' => 'email',
        'class' => ['form-row-wide'],
        'label' => __('Email'),
        'required' => true,
    ], $checkout->get_value('customer--email'));

    echo '</section>';
}

/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'customer_data_field_process');
function customer_data_field_process()
{
    if (!$_POST['customer--name']) {
        wc_add_notice(__('Bitte geben Sie den Vornamen des Gastes ein.'), 'error');
    }

    if (!$_POST['customer--phone']) {
        wc_add_notice(__('Wir benötigen die Telefonnummer, falls es kurzfristige Änderungen an der Tour gibt.'), 'error');
    }

    if (!$_POST['customer--email']) {
        wc_add_notice(__('Wir benötigen die eMail-Adresse, um dem Gast hinterher um eine Bewertung der Tour zu bitten.'), 'error');
    }
}

/**
 * Update the order meta with field value
 */
add_action('woocommerce_checkout_update_order_meta', 'customer_data_field_update_order_meta');
function customer_data_field_update_order_meta($order_id)
{
    if (!empty($_POST['customer--name'])) {
        update_post_meta($order_id, 'customer--name', sanitize_text_field($_POST['customer--name']));
    }

    if (!empty($_POST['customer--phone'])) {
        update_post_meta($order_id, 'customer--phone', sanitize_text_field($_POST['customer--phone']));
    }

    if (!empty($_POST['customer--email'])) {
        update_post_meta($order_id, 'customer--email', sanitize_text_field($_POST['customer--email']));
    }
}

/**
 * Display field value on the order edit page
 */
add_action('woocommerce_admin_order_data_after_order_details', 'add_customer_fields_display_admin_order_meta');
function add_customer_fields_display_admin_order_meta($order)
{
    echo '<div class="order_data_column">';
    echo '<section id="customer-data"><h3>' . __('Kundendaten') . '</h3>';

    echo '<p><strong>' . __('Name') . ':</strong> ' . get_post_meta($order->get_id(), 'customer--name', true) . '</p>';
    echo '<p><strong>' . __('Telefon') . ':</strong> ' . get_post_meta($order->get_id(), 'customer--phone', true) . '</p>';
    echo '<p><strong>' . __('eMail') . ':</strong> ' . get_post_meta($order->get_id(), 'customer--email', true) . '</p>';

    echo '</section>';
    echo '</div>';
}

/**
 * Display field value on the invoice
 */
add_action('wpo_wcpdf_after_order_details', 'wpo_wcpdf_customer_data', 10, 2);
function wpo_wcpdf_customer_data($template_type, $order)
{
    echo '<p>Kein Mehrwertsteuerausweis, da Kleinunternehmer nach §19 (1) UStG.</p><br />';
    echo '<hr /><br />';

    //$document = wcpdf_get_document($template_type, $order);
    //echo '<pre>', print_r($order->items, 1), '</pre>';

    echo '<section><h2>GAST</h2><br />';
    echo '<ul>';
    echo '<li><strong>' . __('Name') . ':</strong> ' . get_post_meta($order->get_id(), 'customer--name', true) . '</li>';
    echo '<li><strong>' . __('Telefon') . ':</strong> ' . get_post_meta($order->get_id(), 'customer--phone', true) . '</li>';
    echo '<li><strong>' . __('eMail') . ':</strong> ' . get_post_meta($order->get_id(), 'customer--email', true) . '</li>';
    echo '</ul></section><br />';
    echo '<hr /><br />';

    echo '<section><h2>TICKETS</h2><br />
    <p><span style="font-weight:bold;">Hiermit erhaltet ihr offiziell Zutritt zur dunklen Seite der Stadt Berlin!</span><br /><br />
    Aber nur, wenn ihr euch traut. Denn ihr werdet in eine Welt voller düsterer Legenden, gruseliger<br />Geheimnisse aus der Vergangenheit und Furcht einflößender Begebenheiten entführt!</p><br /><br />';

    foreach ($order->items as $item) {
        echo '<article><h2>' . $item->get_name() . '</h2><br /><ol>';
        echo '<li><strong>' . __('TICKETNUMMER') . ':</strong> ' . get_post_meta($order->get_id(), '_wcpdf_invoice_number', true) . '</li>';
        echo '<li><strong>' . __('DATUM') . ':</strong> ' . $item->get_meta('datum') . '</li>';
        echo '<li><strong>' . __('PERSONEN') . ':</strong> ' . $item->get_quantity() . '</li>';
        echo '</ol></article><br /><br />';
    }
    echo '</section><br /><br />';

    echo '<section><h2>TREFFPUNKT</h2><br />
    <p>Klosterstraße plus Bild</p><br />';
    echo '</section><br /><br />';

    echo '<section><h2>INFORMATIONEN</h2><br />
    <p>Parken, Toilette, Zu Fuß, Wetterfeste Kleidung</p><br />';
    echo '</section><br /><br />';

    echo '<section><h2>KONTAKT</h2><br />
    <p>Telefon Mail</p>';
    echo '</section>';
}
