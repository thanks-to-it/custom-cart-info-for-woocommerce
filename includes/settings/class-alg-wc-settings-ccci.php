<?php
/**
 * Custom Cart Info for WooCommerce - Settings
 *
 * @version 2.0.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Alg_WC_Settings_Custom_Cart_Info' ) ) :

class Alg_WC_Settings_Custom_Cart_Info extends WC_Settings_Page {

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function __construct() {

		$this->id    = 'alg_wc_custom_cart_info';
		$this->label = __( 'Custom Cart & Checkout Info', 'custom-cart-and-checkout-info-for-woocommerce' );
		parent::__construct();

		add_filter( 'woocommerce_admin_settings_sanitize_option', array( $this, 'unclean_template_textarea' ), PHP_INT_MAX, 3 );

		// Sections
		require_once plugin_dir_path( __FILE__ ) . 'class-alg-wc-ccci-settings-section.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-alg-wc-ccci-settings-general.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-alg-wc-ccci-settings-cart-items.php';

	}

	/**
	 * unclean_template_textarea.
	 *
	 * @version 1.3.0
	 * @since   1.0.0
	 *
	 * @todo    (v2.0.0) find better solution
	 */
	function unclean_template_textarea( $value, $option, $raw_value ) {
		return ( ! empty( $option['alg_wc_ccci_raw'] ) ? $raw_value : $value );
	}

	/**
	 * get_settings.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 */
	function get_settings() {
		global $current_section;
		return array_merge(
			apply_filters( 'woocommerce_get_settings_' . $this->id . '_' . $current_section, array() ),
			array(
				array(
					'title'     => __( 'Reset Settings', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'type'      => 'title',
					'id'        => $this->id . '_' . $current_section . '_reset_options',
				),
				array(
					'title'     => __( 'Reset section settings', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'desc'      => '<strong>' . __( 'Reset', 'custom-cart-and-checkout-info-for-woocommerce' ) . '</strong>',
					'desc_tip'  => __( 'Check the box and save changes to reset.', 'custom-cart-and-checkout-info-for-woocommerce' ),
					'id'        => $this->id . '_' . $current_section . '_reset',
					'default'   => 'no',
					'type'      => 'checkbox',
				),
				array(
					'type'      => 'sectionend',
					'id'        => $this->id . '_' . $current_section . '_reset_options',
				),
			)
		);
	}

	/**
	 * maybe_reset_settings.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 */
	function maybe_reset_settings() {
		global $current_section;
		if ( 'yes' === get_option( $this->id . '_' . $current_section . '_reset', 'no' ) ) {
			foreach ( $this->get_settings() as $value ) {
				if ( isset( $value['id'] ) ) {
					$id = explode( '[', $value['id'] );
					delete_option( $id[0] );
				}
			}
			add_action( 'admin_notices', array( $this, 'admin_notice_settings_reset' ) );
		}
	}

	/**
	 * admin_notice_settings_reset.
	 *
	 * @version 2.0.0
	 * @since   1.2.0
	 */
	function admin_notice_settings_reset() {
		echo '<div class="notice notice-warning is-dismissible"><p><strong>' .
			esc_html__( 'Your settings have been reset.', 'custom-cart-and-checkout-info-for-woocommerce' ) .
		'</strong></p></div>';
	}

	/**
	 * Save settings.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function save() {
		parent::save();
		$this->maybe_reset_settings();
	}

}

endif;

return new Alg_WC_Settings_Custom_Cart_Info();
