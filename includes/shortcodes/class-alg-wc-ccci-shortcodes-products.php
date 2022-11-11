<?php
/**
 * Custom Cart Info for WooCommerce - Products Shortcode Class
 *
 * @version 1.0.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Custom_Products_Info_Products_Shortcodes' ) ) :

class Alg_WC_Custom_Products_Info_Products_Shortcodes {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		add_shortcode( 'alg_wc_cart_product_info', array( $this, 'alg_wc_cart_product_info' ) );
	}

	/**
	 * alg_wc_cart_product_info.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function alg_wc_cart_product_info( $atts ) {
		if ( '' != ( $info = $this->get_alg_wc_cart_product_info( $atts ) ) ) {
			return ( isset( $atts['before'] ) ? $atts['before'] : '' ) . $info . ( isset( $atts['after'] ) ? $atts['after'] : '' );
		}
	}

	/**
	 * get_alg_wc_cart_product_info.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @todo    [maybe] (dev) more `data`
	 * @todo    [maybe] (dev) `length`, `width`, `height` - `get_variations_table()`
	 * @todo    [maybe] (dev) `time_since_last_sale`
	 * @todo    [maybe] (dev) `stock_price`
	 * @todo    [maybe] (dev) `purchase_price`
	 * @todo    [maybe] (dev) `categories` - WC below v3.0.0
	 * @todo    [maybe] (dev) `total_sales` - `offset`
	 * @todo    [maybe] (dev) `function`
	 * @todo    [maybe] (dev) `price` (i.e. not html)
	 */
	function get_alg_wc_cart_product_info( $atts ) {
		if ( ! isset( $atts['data'] ) || ! ( $_product = wc_get_product( isset( $atts['product_id'] ) ? $atts['product_id'] : false ) ) ) {
			return '';
		}
		switch ( $atts['data'] ) {
			case 'slug':
				return $_product->get_slug();
			case 'id':
				return $_product->get_id();
			case 'author_avatar':
				return get_avatar( get_the_author_meta( 'ID' ), ( isset( $atts['avatar_size'] ) ? $atts['avatar_size'] : 96 ) );
			case 'author':
				return get_the_author();
			case 'author_link':
				global $post;
				$url = get_author_posts_url( $post->post_author );
				return ( isset( $atts['all_posts'] ) && 'yes' === $atts['all_posts'] ? $url : add_query_arg( 'post_type', 'product', $url ) );
			case 'length':
			case 'width':
			case 'height':
				$func   = 'get_' . $atts['data'];
				$param  = $_product->$func();
				$return = ( isset( $atts['to_unit'] ) && '' != $atts['to_unit'] ? wc_get_dimension( $param, $atts['to_unit'] ) : $param );
				return ( isset( $atts['round'] ) && 'yes' === $atts['round'] ?
					round( $return, ( isset( $atts['precision'] ) ? $atts['precision'] : 0 ) ) : $return );
			case 'tax_class':
				return $_product->get_tax_class();
			case 'average_rating':
				return $_product->get_average_rating();
			case 'categories':
				return wc_get_product_category_list( $_product->get_id() );
			case 'formatted_name':
				return $_product->get_formatted_name();
			case 'stock_availability':
				$stock_availability = $_product->get_availability();
				return ( isset( $stock_availability['availability'] ) ? $stock_availability['availability'] : '' );
			case 'total_sales':
				return get_post_meta( $_product->get_id(), 'total_sales', true );
			case 'meta':
				return ( ! isset( $atts['key'] ) ? '' : get_post_meta( $_product->get_id(), $atts['key'], true ) );
			case 'sku':
				return $_product->get_sku();
			case 'title':
				return $_product->get_title();
			case 'url':
				return $_product->get_permalink();
			case 'price':
				return $_product->get_price_html() ;
		}
	}

}

endif;

return new Alg_WC_Custom_Products_Info_Products_Shortcodes();
