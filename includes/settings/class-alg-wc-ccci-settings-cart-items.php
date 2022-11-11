<?php
/**
 * Custom Cart Info for WooCommerce - Cart Items Section Settings
 *
 * @version 1.3.0
 * @since   1.3.0
 *
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Custom_Cart_Info_Settings_Cart_Items' ) ) :

class Alg_WC_Custom_Cart_Info_Settings_Cart_Items extends Alg_WC_Custom_Cart_Info_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
	 */
	function __construct() {
		$this->id   = 'cart_items';
		$this->desc = __( 'Cart Items', 'custom-cart-and-checkout-info-for-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
	 */
	function get_settings() {
		return array(
			array(
				'title'    => __( 'Cart Items Table', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_custom_cart_info_item_options',
				'desc'     => __( 'You can use shortcodes and/or HTML here.', 'custom-cart-and-checkout-info-for-woocommerce' ) . ' ' .
					sprintf( __( 'E.g.: %s.', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'<code>[alg_wc_cart_product_info data="sku"]</code>' ) . ' ' .
					sprintf( __( 'You can read more info on %s shortcode %s.', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'<code>[alg_wc_cart_product_info]</code>',
						'<a target="_blank" href="https://wpfactory.com/item/custom-cart-and-checkout-info-for-woocommerce/#alg_wc_cart_product_info">' .
							__( 'here', 'custom-cart-and-checkout-info-for-woocommerce' ) . '</a>' ),
			),
			array(
				'title'    => __( 'Cart items table', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'desc'     => '<strong>' . __( 'Enable section', 'custom-cart-and-checkout-info-for-woocommerce' ) . '</strong>',
				'type'     => 'checkbox',
				'id'       => 'alg_wc_custom_cart_info_item_enabled',
				'default'  => 'yes',
			),
			array(
				'title'    => __( 'Add before each item name', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'id'       => 'alg_wc_custom_cart_info_item_before',
				'default'  => '',
				'type'     => 'textarea',
				'css'      => 'width:100%;height:100px;',
				'alg_wc_ccci_raw' => true,
			),
			array(
				'title'    => __( 'Add after each item name', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'id'       => 'alg_wc_custom_cart_info_item_after',
				'default'  => '',
				'type'     => 'textarea',
				'css'      => 'width:100%;height:100px;',
				'alg_wc_ccci_raw' => true,
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_custom_cart_info_item_options',
			),
		);
	}

}

endif;

return new Alg_WC_Custom_Cart_Info_Settings_Cart_Items();
