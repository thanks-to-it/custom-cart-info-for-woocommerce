<?php
/**
 * Custom Cart Info for WooCommerce - General Section Settings
 *
 * @version 2.0.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Alg_WC_Custom_Cart_Info_Settings_General' ) ) :

class Alg_WC_Custom_Cart_Info_Settings_General extends Alg_WC_Custom_Cart_Info_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.3.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'Info Blocks', 'custom-cart-and-checkout-info-for-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_cart_info_shortcode_desc.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 *
	 * @todo    (v2.0.0) `sprintf()`, etc.
	 */
	function get_cart_info_shortcode_desc() {
		ob_start();
		?>
		<details style="background-color: white; padding: 10px;">
			<summary style="cursor: pointer;"><?php esc_html_e( 'Shortcode info', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></summary>
			<p><code>[alg_wc_cart_info]</code> <?php esc_html_e( 'shortcode can retrieve various cart related information, like total items weight, total items count etc. For example:', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<p><code>[alg_wc_cart_info data="contents_weight" before="Total weight: " after=" kg"]</code></p>
			<h4><?php esc_html_e( 'Attributes', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></h4>
			<p><code>before</code> - <?php esc_html_e( 'text/HTML added before the final output.', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<p><code>after</code> - <?php esc_html_e( 'text/HTML added after the final output.', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<p><code>data</code> - <?php esc_html_e( 'attribute defines which cart info to display:', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<ul style="padding-left: 10px;">
				<li><code>fee_tax</code></li>
				<li><code>fee_total</code></li>
				<li><code>discount_tax</code></li>
				<li><code>discount_total</code></li>
				<li><code>contents_count</code></li>
				<li><code>contents_weight</code></li>
				<li><code>subtotal</code></li>
				<li><code>subtotal_tax</code></li>
				<li><code>shipping_total</code></li>
				<li><code>shipping_tax</code></li>
				<li><code>total_ex_tax</code></li>
				<li><code>tax</code></li>
				<li><code>function</code></li>
				<li><code>total</code></li>
			</ul>
		</details>
		<?php
		return ob_get_clean();
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 *
	 * @todo    (desc) `alg_wc_custom_cart_info_hook`: add info about "non-updating" hooks (e.g. "Cart: Before cart")
	 * @todo    (dev) `alg_wc_custom_cart_info_hook`: group hooks (i.e. add group titles, e.g. "Cart", "Checkout", etc.)
	 * @todo    (feature) `alg_wc_custom_cart_info_hook`: "notice" (i.e. `wc_add_notice()`)
	 * @todo    (feature) add "enable block" options to each block (and to each cart item name position (before/after))
	 * @todo    (feature) add `Hide "Note: Shipping and taxes are estimated..." message on cart page` option
	 * @todo    (feature) add more options from "Cart Customization" module
	 */
	function get_settings() {

		$general_settings = array(
			array(
				'title'    => __( 'Info Blocks', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_custom_cart_info_block_options',
				'desc'     => (
					__( 'You can use shortcodes and/or HTML here.', 'custom-cart-and-checkout-info-for-woocommerce' ) . ' ' .
					sprintf(
						/* Translators: %s: Shortcode example. */
						__( 'E.g.: %s.', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'<code>[alg_wc_cart_info data="total_weight" before="Total weight: " after=" kg"]</code>'
					) . '<br>' .
					$this->get_cart_info_shortcode_desc()
				),
			),
			array(
				'title'    => __( 'Info blocks', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'desc'     => '<strong>' . __( 'Enable section', 'custom-cart-and-checkout-info-for-woocommerce' ) . '</strong>',
				'type'     => 'checkbox',
				'id'       => 'alg_wc_custom_cart_info_enabled',
				'default'  => 'yes',
			),
			array(
				'title'    => __( 'Total blocks', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'desc_tip' => __( 'New settings fields will be displayed, if you change this number and "Save changes".', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'id'       => 'alg_wc_custom_cart_info_total_number',
				'default'  => 1,
				'type'     => 'number',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_custom_cart_info_block_options',
			),
		);

		$info_blocks_settings = array();
		for ( $i = 1; $i <= get_option( 'alg_wc_custom_cart_info_total_number', 1 ); $i++ ) {
			$info_blocks_settings = array_merge( $info_blocks_settings, array(
				array(
					'title'    => __( 'Info Block', 'custom-cart-and-checkout-info-for-woocommerce' ) . ' #' . $i,
					'type'     => 'title',
					'id'       => "alg_wc_custom_cart_info_options[{$i}]",
				),
				array(
					'title'    => __( 'Content', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'id'       => "alg_wc_custom_cart_info_content[{$i}]",
					'default'  => '',
					'type'     => 'textarea',
					'css'      => 'width:100%;height:200px;',
					'alg_wc_ccci_raw' => true,
				),
				array(
					'title'    => __( 'Position', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'id'       => "alg_wc_custom_cart_info_hook[{$i}]",
					'default'  => 'woocommerce_after_cart_totals',
					'type'     => 'select',
					'class'    => 'chosen_select',
					'options'  => array(
						// Cart
						'woocommerce_before_cart'                             => __( 'Cart: Before cart', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_cart_table'                       => __( 'Cart: Before cart table', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_cart_contents'                    => __( 'Cart: Before cart contents', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_contents'                           => __( 'Cart: Cart contents', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_coupon'                             => __( 'Cart: Cart coupon', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_actions'                            => __( 'Cart: Cart actions', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_cart_contents'                     => __( 'Cart: After cart contents', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_cart_table'                        => __( 'Cart: After cart table', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_collaterals'                        => __( 'Cart: Cart collaterals', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_cart'                              => __( 'Cart: After cart', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_cart_totals'                      => __( 'Cart: Before cart totals', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_totals_before_shipping'             => __( 'Cart: Cart totals: Before shipping', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_totals_after_shipping'              => __( 'Cart: Cart totals: After shipping', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_totals_before_order_total'          => __( 'Cart: Cart totals: Before order total', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_totals_after_order_total'           => __( 'Cart: Cart totals: After order total', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_proceed_to_checkout'                     => __( 'Cart: Proceed to checkout', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_cart_totals'                       => __( 'Cart: After cart totals', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_shipping_calculator'              => __( 'Cart: Before shipping calculator', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_shipping_calculator'               => __( 'Cart: After shipping calculator', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_cart_is_empty'                           => __( 'Cart: If cart is empty', 'custom-cart-and-checkout-info-for-woocommerce' ),
						// Mini cart
						'woocommerce_before_mini_cart'                        => __( 'Mini cart: Before mini cart', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_widget_shopping_cart_before_buttons'     => __( 'Mini cart: Before buttons', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_mini_cart'                         => __( 'Mini cart: After mini cart', 'custom-cart-and-checkout-info-for-woocommerce' ),
						// Checkout
						'woocommerce_before_checkout_form'                    => __( 'Checkout: Before checkout form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_before_customer_details'        => __( 'Checkout: Before customer details', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_billing'                        => __( 'Checkout: Billing', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_shipping'                       => __( 'Checkout: Shipping', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_after_customer_details'         => __( 'Checkout: After customer details', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_before_order_review'            => __( 'Checkout: Before order review', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_order_review'                   => __( 'Checkout: Order review', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_checkout_after_order_review'             => __( 'Checkout: After order review', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_checkout_form'                     => __( 'Checkout: After checkout form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_checkout_shipping_form'           => __( 'Checkout: Before checkout shipping form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_checkout_shipping_form'            => __( 'Checkout: After checkout shipping form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_order_notes'                      => __( 'Checkout: Before order notes', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_order_notes'                       => __( 'Checkout: After order notes', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_checkout_billing_form'            => __( 'Checkout: Before checkout billing form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_checkout_billing_form'             => __( 'Checkout: After checkout billing form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_before_checkout_registration_form'       => __( 'Checkout: Before checkout registration form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_after_checkout_registration_form'        => __( 'Checkout: After checkout registration form', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_review_order_before_cart_contents'       => __( 'Checkout: Review order before cart contents', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_review_order_after_cart_contents'        => __( 'Checkout: Review order after cart contents', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_review_order_before_shipping'            => __( 'Checkout: Review order before shipping', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_review_order_after_shipping'             => __( 'Checkout: Review order after shipping', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_review_order_before_order_total'         => __( 'Checkout: Review order before order total', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_review_order_after_order_total'          => __( 'Checkout: Review order after order total', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'woocommerce_thankyou'                                => __( 'Checkout: Order Received (Thank You) page', 'custom-cart-and-checkout-info-for-woocommerce' ),
					),
				),
				array(
					'title'    => __( 'Position order (i.e. priority)', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'desc_tip' => __( 'Change this to fine-tune the info block inside the "Position".', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'id'       => "alg_wc_custom_cart_info_priority[{$i}]",
					'default'  => 10,
					'type'     => 'number',
				),
				array(
					'type'     => 'sectionend',
					'id'       => "alg_wc_custom_cart_info_options[{$i}]",
				),
			) );
		}

		return array_merge( $general_settings, $info_blocks_settings );
	}

}

endif;

return new Alg_WC_Custom_Cart_Info_Settings_General();
