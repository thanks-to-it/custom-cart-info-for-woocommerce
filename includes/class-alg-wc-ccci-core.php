<?php
/**
 * Custom Cart Info for WooCommerce - Core Class
 *
 * @version 2.0.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Alg_WC_Custom_Cart_Info_Core' ) ) :

class Alg_WC_Custom_Cart_Info_Core {

	/**
	 * blocks.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	public $blocks;

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 *
	 * @todo    (dev) shortcodes: add `alg_wc_output_shortcode()` function (`before`, `after` etc.)
	 * @todo    (feature) shortcodes: add `lang` and other common atts
	 * @todo    (feature) shortcodes: order
	 * @todo    (feature) shortcodes: customer
	 */
	function __construct() {

		// Cart items table custom info
		if ( 'yes' === get_option( 'alg_wc_custom_cart_info_item_enabled', 'yes' ) ) {
			add_filter(
				'woocommerce_cart_item_name',
				array( $this, 'add_custom_info_to_cart_item_name' ),
				PHP_INT_MAX,
				3
			);
		}

		// Cart custom info
		if ( 'yes' === get_option( 'alg_wc_custom_cart_info_enabled', 'yes' ) ) {
			$this->blocks = $this->get_blocks();
			foreach ( $this->blocks as $block ) {
				add_action(
					$block['hook'],
					array( $this, 'add_cart_custom_info' ),
					$block['hook_priority']
				);
			}
		}

		// Shortcodes
		require_once plugin_dir_path( __FILE__ ) . 'shortcodes/class-alg-wc-ccci-shortcodes-cart.php';
		require_once plugin_dir_path( __FILE__ ) . 'shortcodes/class-alg-wc-ccci-shortcodes-products.php';

	}

	/**
	 * add_custom_info_to_cart_item_name.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @todo    (dev) `wc_setup_product_data( $post );`
	 */
	function add_custom_info_to_cart_item_name( $product_title, $cart_item, $cart_item_key ) {

		$custom_content_before = get_option( 'alg_wc_custom_cart_info_item_before', '' );
		$custom_content_after  = get_option( 'alg_wc_custom_cart_info_item_after', '' );

		if ( '' != $custom_content_before || '' != $custom_content_after ) {
			global $post;
			$post = get_post( $cart_item['product_id'] );
			setup_postdata( $post );
			$product_title = (
				do_shortcode( $custom_content_before ) .
				$product_title .
				do_shortcode( $custom_content_after )
			);
			wp_reset_postdata();
		}

		return $product_title;

	}

	/*
	 * get_blocks.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function get_blocks() {

		$blocks   = array();
		$content  = get_option( 'alg_wc_custom_cart_info_content',  array() );
		$hook     = get_option( 'alg_wc_custom_cart_info_hook',     array() );
		$priority = get_option( 'alg_wc_custom_cart_info_priority', array() );

		for ( $i = 1; $i <= get_option( 'alg_wc_custom_cart_info_total_number', 1 ); $i++ ) {
			$_content  = ( $content[ $i ]  ?? '' );
			$_hook     = ( $hook[ $i ]     ?? 'woocommerce_after_cart_totals' );
			$_priority = ( $priority[ $i ] ?? 10 );
			if ( '' !== $_content ) {
				$blocks[] = array(
					'hook'          => $_hook,
					'hook_priority' => $_priority,
					'content'       => $_content,
				);
			}
		}

		return $blocks;

	}

	/*
	 * get_current_filter_priority.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_current_filter_priority() {
		global $wp_filter;
		$current_filter_data = $wp_filter[ current_filter() ];
		return (
			class_exists( 'WP_Hook' ) && is_a( $current_filter_data, 'WP_Hook' ) ?
			$current_filter_data->current_priority() : // since  WordPress v4.7
			key( $current_filter_data )                // before WordPress v4.7
		);
	}

	/**
	 * add_cart_custom_info.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @todo    (v2.0.0) escape output?
	 */
	function add_cart_custom_info() {

		$current_filter          = current_filter();
		$current_filter_priority = $this->get_current_filter_priority();

		foreach ( $this->blocks as $block ) {
			if (
				$current_filter         === $block['hook'] &&
				$current_filter_priority == $block['hook_priority']
			) {
				echo do_shortcode( $block['content'] );
			}
		}

	}

}

endif;

return new Alg_WC_Custom_Cart_Info_Core();
