<?php
/*
Plugin Name: Custom Cart and Checkout Info for WooCommerce
Plugin URI: https://wordpress.org/plugins/custom-cart-and-checkout-info-for-woocommerce/
Description: Add custom info to WooCommerce cart page, checkout page and/or mini cart.
Version: 2.0.0
Author: Algoritmika Ltd
Author URI: https://profiles.wordpress.org/algoritmika/
Text Domain: custom-cart-and-checkout-info-for-woocommerce
Domain Path: /langs
WC tested up to: 9.8
Requires Plugins: woocommerce
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

defined( 'ABSPATH' ) || exit;

if ( 'custom-cart-info-for-woocommerce.php' === basename( __FILE__ ) ) {
	/**
	 * Check if Pro plugin version is activated.
	 *
	 * @version 2.0.0
	 * @since   1.4.0
	 */
	$plugin = 'custom-cart-info-for-woocommerce-pro/custom-cart-info-for-woocommerce-pro.php';
	if (
		in_array( $plugin, (array) get_option( 'active_plugins', array() ), true ) ||
		(
			is_multisite() &&
			array_key_exists( $plugin, (array) get_site_option( 'active_sitewide_plugins', array() ) )
		)
	) {
		defined( 'ALG_WC_CCCI_FILE_FREE' ) || define( 'ALG_WC_CCCI_FILE_FREE', __FILE__ );
		return;
	}
}

defined( 'ALG_WC_CCCI_VERSION' ) || define( 'ALG_WC_CCCI_VERSION', '2.0.0' );

defined( 'ALG_WC_CCCI_FILE' ) || define( 'ALG_WC_CCCI_FILE', __FILE__ );

require_once plugin_dir_path( __FILE__ ) . 'includes/class-alg-wc-ccci.php';

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
