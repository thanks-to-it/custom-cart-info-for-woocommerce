=== Custom Cart and Checkout Info for WooCommerce ===
Contributors: wpcodefactory, algoritmika, anbinder
Tags: woocommerce, cart, mini cart, checkout, custom info, woo commerce
Requires at least: 4.4
Tested up to: 6.1
Stable tag: 1.3.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Add custom info to WooCommerce cart page, checkout page and/or mini cart.

== Description ==

**Custom Cart and Checkout Info for WooCommerce** plugin lets you add custom info to WooCommerce cart page, checkout page and/or mini cart.

Show custom information using various shortcodes and give your customers a seamless experience. For example, show them the total weight or count of their items, or add SKU to each items name in cart.

= Available Positions =

**Cart**

* Before cart
* Before cart table
* Before cart contents
* Cart contents
* Cart coupon
* Cart actions
* After cart contents
* After cart table
* Cart collaterals
* After cart
* Before cart totals
* Cart totals: Before shipping
* Cart totals: After shipping
* Cart totals: Before order total
* Cart totals: After order total
* Proceed to checkout
* After cart totals
* Before shipping calculator
* After shipping calculator
* If cart is empty

**Mini cart**

* Before mini cart
* Before buttons
* After mini cart

**Checkout**

* Before checkout form
* Before customer details
* Billing
* Shipping
* After customer details
* Before order review
* Order review
* After order review
* After checkout form
* Before checkout shipping form
* After checkout shipping form
* Before order notes
* After order notes
* Before checkout billing form
* After checkout billing form
* Before checkout registration form
* After checkout registration form
* Review order before cart contents
* Review order after cart contents
* Review order before shipping
* Review order after shipping
* Review order before order total
* Review order after order total
* Order Received (Thank You) page

= Shortcodes =

* `[alg_wc_cart_info]` shortcode can retrieve various cart related information, like total items weight, total items count etc.
* `[alg_wc_cart_product_info]` shortcode can retrieve various product related information, like product SKU, ID, price etc.

= Feedback =

* We are open to your suggestions and feedback. Thank you for using or trying out one of our plugins!
* [Visit plugin site](https://wpfactory.com/item/custom-cart-and-checkout-info-for-woocommerce/).

== Installation ==

1. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Start by visiting plugin settings at "WooCommerce > Settings > Custom Cart & Checkout Info".

== Changelog ==

= 1.4.0 - 11/11/2022 =
* Tested up to: 6.1.
* WC tested up to: 7.1.
* Readme.txt updated.
* Deploy script added.

= 1.3.0 - 15/04/2021 =
* Dev - "Enable plugin" option removed.
* Dev - Plugin is initialized on `plugins_loaded` now.
* Dev - Localisation - `load_plugin_textdomain()` function moved to the `init` hook.
* Dev - Admin settings restyled; descriptions updated; "Cart Items Table Custom Info" options moved to a separate "Cart Items" section; "General" section renamed to "Info Blocks".
* Dev - Code refactoring.
* Tested up to: 5.7.
* WC tested up to: 5.2.

= 1.2.0 - 04/01/2020 =
* Dev - Text domain fixed.
* Dev - Code refactoring.
* Dev - Admin settings restyled; "Your settings have been reset" notice added.
* POT file uploaded.
* Plugin URI updated.
* WC tested up to: 3.8.
* Tested up to: 5.3.

= 1.1.0 - 22/05/2018 =
* Dev - "Checkout" positions added.
* Dev - "Mini cart" positions added.
* Dev - Plugin renamed from "Custom Cart Info for WooCommerce" to "Custom Cart and Checkout Info for WooCommerce".

= 1.0.0 - 20/05/2018 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
