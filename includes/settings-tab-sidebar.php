<?php
/**
* @package Woocommerce_Racoon
* @version 1.0
*/
/*
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

/**
 *
 * define the settings tab sidebar
 *
 */

function get_woorac_settings_tab_sidebar() {

    $url = get_site_url();

    $woorac_sidebar = '';
    $woorac_sidebar .= '<div class="woorac_settings_tab_sidebar">';
        $woorac_sidebar .= '<div class="woorac_settings_tab_sidebar_item">';
            $woorac_sidebar .= '<strong>WooCommerce Racoon</strong>';
            $woorac_sidebar .= '<p>';
            $woorac_sidebar .= __( 'WooCommerce Racoon advanced settings to configure WooCommerce.', 'woocommerce-racoon' );
            $woorac_sidebar .= '</p>';
        $woorac_sidebar .= '</div>';
        $woorac_sidebar .= '<div class="woorac_settings_tab_sidebar_item">';
            $woorac_sidebar .= '<strong>Clear cache!</strong>';
            $woorac_sidebar .= '<p>';
            $woorac_sidebar .= __( 'After you have changed the settings on that page, clear your WooCommerce cache.', 'woocommerce-racoon' );
            $woorac_sidebar .= __( ' Go to WooCommerce > System Status > Tools > WooCommerce Transients > Clear transients.', 'woocommerce-racoon' );
            $woorac_sidebar .= '</p>';
            $woorac_sidebar .= '<a href="'.$url.'/wp-admin/admin.php?page=wc-status&tab=tools">';
            $woorac_sidebar .= __( 'Go to clear transients', 'woocommerce-racoon' );
            $woorac_sidebar .= '</a>';
        $woorac_sidebar .= '</div>';
    $woorac_sidebar .= '</div>';

    echo $woorac_sidebar;

};
