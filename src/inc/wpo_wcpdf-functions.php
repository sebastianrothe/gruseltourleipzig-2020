<?php
/**
 * Twenty Seventeen: WP Overnight WooCommerce PDF Invoices Adjustments
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Add link to invoice after ordering. 
 * 
 * via http://docs.wpovernight.com/woocommerce-pdf-invoices-packing-slips/download-link-on-the-thank-you-page/
 */
add_filter('woocommerce_thankyou_order_received_text', 'wpo_wcpdf_thank_you_link', 10, 2);
function wpo_wcpdf_thank_you_link( $text, $order ) {
    if ( is_user_logged_in() ) {
        $order_id = method_exists($order, 'get_id') ? $order->get_id() : $order->id;
        $pdf_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=generate_wpo_wcpdf&template_type=invoice&order_ids=' . $order_id . '&my-account'), 'generate_wpo_wcpdf' );
        $text .= '<p class="after-checkout--download">Du kannst jetzt dein Ticket und Rechnung in einem <a class="after-checkout--download" href="'.esc_attr($pdf_url).'">hier herunterladen (PDF).</a></p>';
    }
    return $text;
}
