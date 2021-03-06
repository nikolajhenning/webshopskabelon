<?php

/**
 * Simple checkout field addition to CVR.
 *
 */
function woocommerce_add_checkout_fields( $fields ) {
    if (function_exists('is_checkout') && is_checkout()) {

        $fields['billing_vat'] = array(
            'label'        => __( 'CVR nr.' ),
            'type'        => 'text',
            'class'        => array( 'form-row-wide' ),
            'priority'     => 25,
            'required'     => false,
            'custom_attributes' => array('vat-button' => 'Hent oplysninger fra CVR register'),
            'input_class' => array('append-button'),
        );
        return $fields;
    }
}
add_filter( 'woocommerce_billing_fields', 'woocommerce_add_checkout_fields' );

/* WooCommerce - Reorder fields */
function country_reorder( $checkout_fields ) {
    $checkout_fields['billing']['billing_country']['priority'] = 50;
    $checkout_fields['billing']['billing_postcode']['priority'] = 70;
    $checkout_fields['billing']['billing_city']['priority'] = 80;
	return $checkout_fields;
}
add_filter( 'woocommerce_checkout_fields', 'country_reorder' );



/**
 * Moving the payments below shipping on checkout
 */
function display_payments_under_shipping() {
  if ( WC()->cart->needs_payment() ) {
    $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
    WC()->payment_gateways()->set_current_gateway( $available_gateways );
  } else {
    $available_gateways = array();
  }
  ?>
  <div class="checkout_payments">
    <h3><?php esc_html_e( 'Betalingsmetode', 'woocommerce' ); ?></h3>
    <?php if ( WC()->cart->needs_payment() ) : ?>
    <ul class="wc_payment_methods payment_methods methods">
    <?php
    if ( ! empty( $available_gateways ) ) {
      foreach ( $available_gateways as $gateway ) {
        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
      }
    } else {
      echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
    }
    ?>
    </ul>
  <?php endif; ?>
  </div>
<?php
}
add_action( 'woocommerce_checkout_shipping', 'display_payments_under_shipping', 20 );


/* Moving coupon below shipping  */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_review_order_before_payment', 'woocommerce_checkout_coupon_form',  );

/* Remove shipping title on checkout */
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
    return '';
}

/* 
** Move shipping options below invoice fields on checkout 
*/
// hook into the fragments in AJAX and add our new table to the group
add_filter('woocommerce_update_order_review_fragments', 'webshop_order_fragments_split_shipping', 10, 1);

function webshop_order_fragments_split_shipping($order_fragments) {

	ob_start();
	webshop_woocommerce_order_review_shipping_split();
	$webshop_woocommerce_order_review_shipping_split = ob_get_clean();

	$order_fragments['.webshop-checkout-review-shipping-table'] = $webshop_woocommerce_order_review_shipping_split;

	return $order_fragments;

}

// get the template that just has the shipping options that we need for the new table
function webshop_woocommerce_order_review_shipping_split( $deprecated = false ) {
	wc_get_template( 'checkout/shipping-order-review.php', array( 'checkout' => WC()->checkout() ) );
}


// Hook the new table in before the customer details - you can move this anywhere you'd like. Dropping the html into the checkout template files should work too.
add_action('woocommerce_checkout_shipping', 'webshop_move_new_shipping_table', 15);

function webshop_move_new_shipping_table() {
	echo '<table class="shop_table webshop-checkout-review-shipping-table"> <h3>V??lg leveringsmetode</h3> </table>';
}