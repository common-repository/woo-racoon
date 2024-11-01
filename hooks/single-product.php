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
 * custom settings for the single product page
 *
 */


// hide product meta on product single

$product_meta = get_option( 'wc_settings_tab_woorac_product_meta' );
if($product_meta == 'yes') {

    function woorac_remove_single_product_meta(){

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

    }
    add_action('init','woorac_remove_single_product_meta');

}


// hide tabs

function woorac_remove_product_tabs( $tabs ) {

    $tab_desc = get_option( 'wc_settings_tab_woorac_tab_desc' );
    if($tab_desc == 'yes') {
        unset( $tabs['description'] ); // Remove the description tab
    }

    $tab_reviews = get_option( 'wc_settings_tab_woorac_tab_reviews' );
    if($tab_reviews == 'yes') {
        unset( $tabs['reviews'] ); // Remove the reviews tab
    }

    $tab_ai = get_option( 'wc_settings_tab_woorac_tab_additional_information' );
    if($tab_ai == 'yes') {
        unset( $tabs['additional_information'] ); // Remove the additional information tab
    }

    return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'woorac_remove_product_tabs', 98 );
