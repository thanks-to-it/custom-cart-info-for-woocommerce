=== Custom Cart and Checkout Info for WooCommerce ===
Contributors: algoritmika, thankstoit, anbinder, karzin
Tags: woocommerce, cart, mini cart, checkout, custom info
Requires at least: 4.4
Tested up to: 6.8
Stable tag: 2.0.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Add custom info to WooCommerce cart page, checkout page and/or mini cart.

== Description ==

**Custom Cart and Checkout Info for WooCommerce** plugin lets you add custom info to WooCommerce cart page, checkout page and/or mini cart.

Show custom information using various shortcodes and give your customers a seamless experience. For example, show them the total weight or count of their items, or add SKU to each items name in cart.

### 🚀 WooCommerce Custom Info in Cart & Checkout ###

Enhance your WooCommerce store's cart and checkout pages with the "Custom Cart and Checkout Info for WooCommerce" plugin. Tailored to provide a seamless shopping experience, this tool allows you to insert custom information at various strategic points on your cart and checkout pages, and even in the mini cart.

Customization has never been this extensive; display essential details like total weight or item count, or even add SKU to product names in the cart using versatile shortcodes like `[alg_wc_cart_info]` and `[alg_wc_cart_product_info]`.

### 🚀 Create Custom Info Block in Cart and Checkout Pages ###

The core functionality of this plugin is to enable creating custom information blocks specifically within the cart and checkout pages.

These info blocks can display a variety of content, including promotional messages, order-specific information, or checkout instructions, enhancing the customer's final stages of the purchasing process.

### 🚀 Show Dynamic Content Display with Shortcodes ###

Utilize specialized shortcodes like `[alg_wc_cart_info]` and `[alg_wc_cart_product_info]` to dynamically display relevant information based on the customer's cart contents or other checkout details.

This feature allows for real-time updates and personalized information (like total items weight, total items count, SKU, product ID, and more) to be shared with the customer as they complete their purchase.

### 🚀 Extensive Customization of Info Blocks ###

Personalize the appearance and content of information blocks to match the store's branding and the specific needs of the checkout process.

This could include styling options, text customizations, and the decision of where and when these blocks appear during checkout.

### 🚀 Enhanced Checkout Communication ###

Improve communication and customer guidance during checkout by strategically placing informative blocks.

These can include shipping details, special offers, or reminders about return policies, providing clarity and support to customers during a critical phase of their shopping journey.

### 🚀 Improved Customer Engagement and Conversions ###

By providing timely and relevant information at the checkout, these blocks can help reduce cart abandonment, address customer queries, and potentially increase conversion rates.

This allow you to make timely decisions & communicate messages at the right step of customer's journey, making them a valuable tool for enhancing the overall effectiveness of the checkout process.

### ℹ Available Positions ###

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

### ℹ Shortcodes ###

* `[alg_wc_cart_info]` shortcode can retrieve various cart related information, like total items weight, total items count etc.
* `[alg_wc_cart_product_info]` shortcode can retrieve various product related information, like product SKU, ID, price etc.

### 🗘 Feedback ###

* We are open to your suggestions and feedback. Thank you for using or trying out one of our plugins!
* Head to the plugin [GitHub Repository](https://github.com/thanks-to-it/custom-cart-info-for-woocommerce) to find out how you can pitch in.

== Installation ==

1. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Start by visiting plugin settings at "WooCommerce > Settings > Custom Cart & Checkout Info".

== Changelog ==

= 2.0.0 - 30/05/2025 =
* Dev - The free version now allows an unlimited number of info blocks.
* Dev - Security - Output escaped.
* Dev - PHP v8.2 compatibility (dynamic properties).
* Dev - Code refactoring.
* Dev - Coding standards improved.
* WC tested up to: 9.8.
* Tested up to: 6.8.

= 1.4.3 - 30/07/2024 =
* WC tested up to: 9.1.
* Tested up to: 6.6.

= 1.4.2 - 24/09/2023 =
* WC tested up to: 8.1.
* Tested up to: 6.3.
* Update plugin icon, banner.

= 1.4.1 - 19/06/2023 =
* WC tested up to: 7.8.
* Tested up to: 6.2.

= 1.4.0 - 16/12/2022 =
* Dev - Compatibility with custom order tables for WooCommerce (High-Performance Order Storage (HPOS)) declared.
* Dev - Code refactoring.
* Tested up to: 6.1.
* WC tested up to: 7.2.
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
