<?php
/**
 * Custom Cart Info for WooCommerce - Cart Items Section Settings
 *
 * @version 1.3.0
 * @since   1.3.0
 *
 * @author  Algoritmika Ltd.
 */

defined( 'ABSPATH' ) || exit;

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
	 * get_cart_product_info_shortcode_desc.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 *
	 * @todo    (v2.0.0) `sprintf()`, etc.
	 */
	function get_cart_product_info_shortcode_desc() {
		ob_start();
		?>
		<details style="background-color: white; padding: 10px;">
			<summary style="cursor: pointer;"><?php esc_html_e( 'Shortcode info', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></summary>
			<p><code>[alg_wc_cart_product_info]</code> <?php esc_html_e( 'shortcode can retrieve various product related information, like product SKU, ID, price etc. For example:', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<p><code>[alg_wc_cart_product_info data="sku" before="SKU: "]</code></p>
			<h4><?php esc_html_e( 'Attributes', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></h4>
			<p><code>before</code> - <?php esc_html_e( 'text/HTML added before the final output.', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<p><code>after</code> - <?php esc_html_e( 'text/HTML added after the final output.', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<p><code>data</code> - <?php esc_html_e( 'attribute defines which product info to display:', 'custom-cart-and-checkout-info-for-woocommerce' ); ?></p>
			<ul style="padding-left: 10px;">
				<li><code>slug</code></li>
				<li><code>id</code></li>
				<li><code>author_avatar</code></li>
				<li><code>author</code></li>
				<li><code>author_link</code></li>
				<li><code>length</code></li>
				<li><code>width</code></li>
				<li><code>height</code></li>
				<li><code>tax_class</code></li>
				<li><code>average_rating</code></li>
				<li><code>categories</code></li>
				<li><code>formatted_name</code></li>
				<li><code>stock_availability</code></li>
				<li><code>total_sales</code></li>
				<li><code>meta</code></li>
				<li><code>sku</code></li>
				<li><code>title</code></li>
				<li><code>url</code></li>
				<li><code>price</code></li>
			</ul>
		</details>
		<?php
		return ob_get_clean();
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   1.3.0
	 */
	function get_settings() {
		return array(
			array(
				'title'    => __( 'Cart Items Table', 'custom-cart-and-checkout-info-for-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_custom_cart_info_item_options',
				'desc'     => (
					__( 'You can use shortcodes and/or HTML here.', 'custom-cart-and-checkout-info-for-woocommerce' ) . ' ' .
					sprintf(
						/* Translators: %s: Shortcode example. */
						__( 'E.g.: %s.', 'custom-cart-and-checkout-info-for-woocommerce' ),
						'<code>[alg_wc_cart_product_info data="sku"]</code>'
					) . '<br>' .
					$this->get_cart_product_info_shortcode_desc()
				),
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
