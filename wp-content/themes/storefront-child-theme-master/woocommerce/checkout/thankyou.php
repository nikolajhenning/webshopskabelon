<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<?php
function dataLayer_google_gtm( $order_id ) {

// Lets grab the order
$order = wc_get_order( $order_id );

// Products
$products = $order->get_items();
}
?>


<!-- GA4 -->
<script type="text/javascript">
dataLayer.push({
   event: "purchase",
   ecommerce: {
         transaction_id: "<?php echo $order->get_order_number(); ?>",
         affiliation: "WooCommerce",
         value: <?php echo number_format($order->get_total(), 2, ".", ""); ?>,
         tax: <?php echo number_format($order->get_total_tax(), 2, ".", ""); ?>,
         shipping: <?php echo number_format($order->calculate_shipping(), 2, ".", ""); ?>,
		 currency: "<?php echo get_woocommerce_currency_symbol(); ?>",
         <?php if($order->get_used_coupons()): ?>
         coupon: "<?php echo implode("-", $order->get_used_coupons()); ?>",
          <?php endif; ?>
		 items: [
			<?php
			foreach($order->get_items() as $key => $item):
				$product = $order->get_product_from_item( $item );
				$variant_name = ($item['variation_id']) ? wc_get_product($item['variation_id']) : '';
			?>
				{
				item_name: "<?php echo $item['name']; ?>",
				item_id: "<?php echo $sku = $product->get_sku(); ?>",
				currency: "<?php echo get_woocommerce_currency_symbol(); ?>",
				price: <?php echo number_format($order->get_line_subtotal($item), 2, ".", ""); ?>,
				item_category: "<?php echo strip_tags($product->get_categories(', ', '', '')); ?>",
				item_variant: "<?php echo ($variant_name) ? implode("-", $variant_name->get_variation_attributes()) : ''; ?>",
				quantity: <?php echo $item['qty']; ?>
				},
			<?php endforeach; ?>
		 ]
    
  }
});
</script>


<!-- GA -->
<script type="text/javascript">
dataLayer.push({
   "event":"purchase_ga",
   "ecommerce": {
     "purchase": {
       "actionField": {
         "id": "<?php echo $order->get_order_number(); ?>",
         "affiliation":"WooCommerce",
         "revenue": <?php echo number_format($order->get_subtotal(), 2, ".", ""); ?>,
         "tax": <?php echo number_format($order->get_total_tax(), 2, ".", ""); ?>,
         "shipping": <?php echo number_format($order->calculate_shipping(), 2, ".", ""); ?>,
         <?php if($order->get_used_coupons()): ?>
            "coupon": "<?php echo implode("-", $order->get_used_coupons()); ?>"
          <?php endif; ?>
      },
      "products": [
                  <?php
                    foreach($order->get_items() as $key => $item):
                      $product = $order->get_product_from_item( $item );
                      $variant_name = ($item['variation_id']) ? wc_get_product($item['variation_id']) : '';
                  ?>
                      {
                        "name": "<?php echo $item['name']; ?>",
                        "id": "<?php echo $sku = $product->get_sku(); ?>",
                        "price": "<?php echo number_format($order->get_line_subtotal($item), 2, ".", ""); ?>",
                        "category": "<?php echo strip_tags($product->get_categories(', ', '', '')); ?>",
                        "variant": "<?php echo ($variant_name) ? implode("-", $variant_name->get_variation_attributes()) : ''; ?>",
                        "quantity": <?php echo $item['qty']; ?>
                      },
                  <?php endforeach; ?>
                ]
    }
  }
});
</script>




<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
