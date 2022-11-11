<?php
/**
 * Custom Cart Info for WooCommerce - Cart Shortcode Class
 *
 * @version 1.0.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Custom_Cart_Info_Cart_Shortcodes' ) ) :

class Alg_WC_Custom_Cart_Info_Cart_Shortcodes {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		add_shortcode( 'alg_wc_cart_info', array( $this, 'alg_wc_cart_info' ) );
	}

	/**
	 * alg_wc_cart_info.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function alg_wc_cart_info( $atts ) {
		if ( '' != ( $info = $this->get_alg_wc_cart_info( $atts ) ) ) {
			return ( isset( $atts['before'] ) ? $atts['before'] : '' ) . $info . ( isset( $atts['after'] ) ? $atts['after'] : '' );
		}
	}

	/**
	 * get_alg_wc_cart_info.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @todo    [later] (check) discount_tax: `$_cart->get_cart_discount_tax_total( )` // Get the total of all cart tax discounts (used for discounts on tax inclusive prices).
	 * @todo    [later] (check) discount_total: `$_cart->get_cart_discount_total( )` // Get the total of all cart discounts.
	 * @todo    [later] (check) subtotal: `$_cart->get_displayed_subtotal()`
	 * @todo    [later] (check) subtotal: `$_cart->get_subtotal()`
	 * @todo    [later] (check) shipping_total: `$_cart->get_shipping_total()`
	 * @todo    [later] (check) shipping_tax: `$_cart->get_shipping_tax_amount( string $tax_rate_id )` // Get a tax amount
	 * @todo    [later] (check) tax: `$_cart->get_total_tax()`
	 * @todo    [later] (check) tax: `$_cart->get_cart_contents_tax()`
	 * @todo    [later] (check) tax: `$_cart->get_tax_amount( string $tax_rate_id )` // Get a tax amount.
	 * @todo    [later] (check) tax: `$_cart->get_taxes_total( boolean $compound = true, boolean $display = true )` // Get tax row amounts with or without compound taxes includes.
	 * @todo    [later] (check) total: ! `$_cart->get_total( string $context = 'view' )` // Gets cart total after calculation.
	 * @todo    [maybe] (dev) add `$atts['add_to']` to all cases
	 * @todo    [maybe] (dev) function: add `$atts['function_args']`
	 * @todo    [maybe] (dev) add `$atts['multiply_by']` to all cases
	 * @todo    [maybe] (dev) subtotal: `get_cart_subtotal( boolean $compound = false )` (i.e. add `$atts['compound']`)
	 */
	function get_alg_wc_cart_info( $atts ) {
		if ( ! isset( $atts['data'] ) || ! ( $_cart = WC()->cart ) ) {
			return '';
		}
		switch ( $atts['data'] ) {
			case 'fee_tax':
				return wc_price( $_cart->get_fee_tax() );
			case 'fee_total':
				return wc_price( $_cart->get_fee_total() );
			case 'discount_tax':
				return wc_price( $_cart->get_discount_tax() );
			case 'discount_total':
				return wc_price( $_cart->get_discount_total() );
			case 'total_quantity':
			case 'items_total_quantity':
			case 'contents_count':
				return $_cart->get_cart_contents_count();
			case 'total_weight':
			case 'items_total_weight':
			case 'contents_weight':
				return $_cart->get_cart_contents_weight();
			case 'subtotal':
				return $_cart->get_cart_subtotal();
			case 'subtotal_tax':
				return wc_price( $_cart->get_subtotal_tax() );
			case 'shipping_total':
				return $_cart->get_cart_shipping_total();
			case 'shipping_tax':
				return $_cart->get_shipping_tax();
			case 'total_ex_tax':
				return $_cart->get_total_ex_tax();
			case 'tax':
				return $_cart->get_cart_tax();
			case 'function':
				return ( isset( $atts['function_name'] ) && '' != $atts['function_name'] ? $_cart->{$atts['function_name']}() : '' );
			case 'total':
				return ( isset( $atts['multiply_by'] ) ?
					wc_price( $atts['multiply_by'] * ( wc_prices_include_tax() ? $_cart->get_cart_contents_total() + $_cart->get_cart_contents_tax() : $_cart->get_cart_contents_total() ) ) :
					$_cart->get_cart_total() );
		}
	}

}

endif;

return new Alg_WC_Custom_Cart_Info_Cart_Shortcodes();
