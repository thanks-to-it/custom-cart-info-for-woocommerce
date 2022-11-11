<?php
/**
 * Custom Cart Info for WooCommerce - General Section Settings
 *
 * @version 1.3.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
	 * get_settings.
	 *
	 * @version 1.3.0
	 * @since   1.0.0
	 *
	 * @todo    [next] (desc) `alg_wc_custom_cart_info_hook`: add info about "non-updating" hooks (e.g. "Cart: Before cart")
	 * @todo    [maybe] (dev) `alg_wc_custom_cart_info_hook`: group hooks (i.e. add group titles, e.g. "Cart", "Checkout", etc.)
	 * @todo    [maybe] (feature) `alg_wc_custom_cart_info_hook`: "notice" (i.e. `wc_add_notice()`)
	 * @todo    [maybe] (feature) add "enable block" options to each block (and to each cart item name position (before/after))
	 * @todo    [maybe] (feature) add `Hide "Note: Shipping and taxes are estimated..." message on cart page` option
	 * @todo    [maybe] (feature) add more options from "Cart Customization" module
	 */
	function get_settings() {

		$general_settings = array(
			array(
				'title'    => __( 'Info Blocks', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_custom_cart_info_block_options',
				'desc'     => __( 'You can use shortcodes and/or HTML here.', 'custom-cart-and-checkout-info-for-woocommerce' ) . ' ' .
					sprintf( __( 'E.g.: %s.', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'<code>[alg_wc_cart_info data="total_weight" before="Total weight: " after=" kg"]</code>' ) . ' ' .
					sprintf( __( 'You can read more info on %s shortcode %s.', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'<code>[alg_wc_cart_info]</code>',
						'<a target="_blank" href="https://wpfactory.com/item/custom-cart-and-checkout-info-for-woocommerce/#alg_wc_cart_info">' .
							__( 'here', 'custom-cart-and-checkout-info-for-woocommerce' ) . '</a>' ),
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
				'desc'     => apply_filters( 'alg_wc_custom_cart_info_settings', '<br>' . sprintf( 'You will need %s plugin to add more than one info block.',
					'<a target="_blank" href="https://wpfactory.com/item/custom-cart-and-checkout-info-for-woocommerce/">' .
						'Custom Cart and Checkout Info for WooCommerce Pro' . '</a>' ) ),
				'custom_attributes' => apply_filters( 'alg_wc_custom_cart_info_settings', array( 'readonly' => 'readonly' ), 'array' ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_custom_cart_info_block_options',
			),
		);

		$info_blocks_settings = array();
		for ( $i = 1; $i <= apply_filters( 'alg_wc_custom_cart_info_total_blocks', 1 ); $i++ ) {
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
