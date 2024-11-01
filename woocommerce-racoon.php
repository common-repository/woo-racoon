<?php
/**
 * @package Woocommerce_Racoon
 * @version 1.0
 */
/*
Plugin Name:    WooCommerce Racoon
Plugin URI:     https://wordpress.org/plugins/woo-racoon/
Description:    The WooCommerce Racoon gives you the possibility to configure WooCommerce with advanced settings right from the WordPress backend.
Author:         Sebastian Lind
Version:        1.3
Author URI:     https://www.sebastian-lind.de/
License:        MIT
Textdomain:     woocommerce-racoon
WC requires at least: 6.9.0
WC tested up to: 8.7.0


MIT License

Copyright (c) 2017 Sebastian Lind

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

// If this file was called directly, abort.
if (!defined('ABSPATH')) {
    die;
}


// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // Defines the path to be used for functions etc.
    define('WOORAC_DIR', plugin_dir_path(__FILE__));

    // include functions
    include WOORAC_DIR . 'includes/settings-tab-sidebar.php';
    include WOORAC_DIR . 'includes/settings-tab.php';

    // include hooks
    include WOORAC_DIR . 'hooks/breadcrumb.php';
    include WOORAC_DIR . 'hooks/password.php';
    include WOORAC_DIR . 'hooks/price.php';
    include WOORAC_DIR . 'hooks/shipping.php';
    include WOORAC_DIR . 'hooks/shop-page.php';
    include WOORAC_DIR . 'hooks/single-product.php';

    // include translation
    add_action('plugins_loaded', 'woo_rac_load_textdomain');
    function woo_rac_load_textdomain() {
        load_plugin_textdomain( 'woocommerce-racoon', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
    }

} else {

    function woo_rac_error_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'WooCommerce Plugin has to be installed first!', 'woocommerce-racoon' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'woo_rac_error_notice' );

}