<?php
/*
Plugin Name: Custom Cart and Checkout Info for WooCommerce
Plugin URI: https://wpfactory.com/item/custom-cart-and-checkout-info-for-woocommerce/
Description: Add custom info to WooCommerce cart page, checkout page and/or mini cart.
Version: 1.4.3
Author: WPFactory
Author URI: https://wpfactory.com
Text Domain: custom-cart-and-checkout-info-for-woocommerce
Domain Path: /langs
WC tested up to: 9.1
Requires Plugins: woocommerce
*/

defined( 'ABSPATH' ) || exit;

if ( 'custom-cart-info-for-woocommerce.php' === basename( __FILE__ ) ) {
	/**
	 * Check if Pro plugin version is activated.
	 *
	 * @version 1.4.0
	 * @since   1.4.0
	 */
	$plugin = 'custom-cart-info-for-woocommerce-pro/custom-cart-info-for-woocommerce-pro.php';
	if (
		in_array( $plugin, (array) get_option( 'active_plugins', array() ), true ) ||
		( is_multisite() && array_key_exists( $plugin, (array) get_site_option( 'active_sitewide_plugins', array() ) ) )
	) {
		return;
	}
}

defined( 'ALG_WC_CCCI_VERSION' ) || define( 'ALG_WC_CCCI_VERSION', '1.4.3' );

defined( 'ALG_WC_CCCI_FILE' ) || define( 'ALG_WC_CCCI_FILE', __FILE__ );

require_once( 'includes/class-alg-wc-ccci.php' );

if ( ! function_exists( 'alg_wc_ccci' ) ) {
	/**
	 * Returns the main instance of Alg_WC_Custom_Cart_Info to prevent the need to use globals.
	 *
	 * @version 1.3.0
	 * @since   1.0.0
	 */
	function alg_wc_ccci() {
		return Alg_WC_Custom_Cart_Info::instance();
	}
}

add_action( 'plugins_loaded', 'alg_wc_ccci' );
