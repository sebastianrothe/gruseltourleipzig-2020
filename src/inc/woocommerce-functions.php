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
        wc_add_notice(__('Bitte geben Sie den Vornamen des Gastes für das Ticket ein.'), 'error');
    }

    if (!$_POST['customer--phone']) {
        wc_add_notice(__('Wir benötigen die Telefonnummer, falls es kurzfristige Änderungen an der Tour gibt.'), 'error');
    }

    if (!$_POST['customer--email']) {
        wc_add_notice(__('Wir benötigen die eMail-Adresse, um dem Gast nach der Tour eine Feedback-Mail zu schicken.'), 'error');
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
