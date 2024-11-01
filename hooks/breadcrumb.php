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
 * configuration for the custom breadcrumb navigation
 *
 */

// Change the home text
add_filter( 'woocommerce_breadcrumb_defaults', 'woorac_change_breadcrumb_home_text', 20 );

function woorac_change_breadcrumb_home_text( $defaults ) {

    $breadcrumb_home = get_option( 'wc_settings_tab_woorac_breadcrumb_home' );
    if($breadcrumb_home == '') {
        $breadcrumb_home = __( 'Home', 'woocommerce-racoon' );
    }
    $defaults['home'] = $breadcrumb_home;
    return $defaults;

}


// Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'woorac_change_breadcrumb_delimiter', 20 );

function woorac_change_breadcrumb_delimiter( $defaults ) {

    $breadcrumb_separator = get_option( 'wc_settings_tab_woorac_breadcrumb_separator' );
    if($breadcrumb_separator == '') {
        $breadcrumb_separator = ' / ';
    }
    $defaults['delimiter'] = $breadcrumb_separator;
    return $defaults;

}


// Change the home link to a different URL
add_filter( 'woocommerce_breadcrumb_home_url', 'woorac_change_breadrumb_home_url', 20 );

function woorac_change_breadrumb_home_url() {

    $breadcrumb_home_link = get_option( 'wc_settings_tab_woorac_breadcrumb_home_link' );
    if($breadcrumb_home_link == '') {
        $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
        $breadcrumb_home_link = $shop_page_url;
    }
    return $breadcrumb_home_link;

}


// Remove the breadcrumbs
$hide_breadcrumb = get_option( 'wc_settings_tab_woorac_hide_breadcrumb' );
if($hide_breadcrumb=='no'){

    add_action( 'init', 'woorac_remove_wc_breadcrumbs' );

    function woorac_remove_wc_breadcrumbs() {

        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
        /**
         * Remove breadcrumbs for Storefront theme
         */
        remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
        /**
         * Remove breadcrumbs in Woo developed themes
         */
        remove_action( 'woo_main_before', 'woo_display_breadcrumbs', 10 );

    }

}

?>