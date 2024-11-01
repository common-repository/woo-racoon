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
 * custom settings for the shop archive page
 *
 */


// display specific number of products per page

function woorac_overide_product_per_page($cols)
{
    global $woorac_per_page;
    $woorac_per_page = get_option( 'wc_settings_tab_woorac_nr_products' );
    return $woorac_per_page;

}
add_filter( 'loop_shop_per_page', 'woorac_overide_product_per_page', 20 );




// Show/Hide message "Showing 123 results" from shop page

$hide_show_results = get_option( 'wc_settings_tab_woorac_hide_show_results' );
if($hide_show_results == 'yes') {

    function woorac_remove_result_count(){

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        /**
         * Remove result count for Storefront theme
         */
        remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );

    }
    add_action('init','woorac_remove_result_count');

}




// Show/Hide sub-category product count in product archives

$category_count = get_option( 'wc_settings_tab_woorac_category_count' );
if($category_count == 'no') {

    function woorac_hide_category_count() {
        // No count
    }
    add_filter( 'woocommerce_subcategory_count_html', 'woorac_hide_category_count' );

}





// remove "Sort By" from the shop page

$product_orderby = get_option( 'wc_settings_tab_woorac_product_orderby' );
if($product_orderby == 'yes') {

    function woorac_remove_product_orderby(){

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
        /**
         * Remove catalog ordering for Storefront theme
         */
        remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );

    }
    add_action('init','woorac_remove_product_orderby');

}







// Override loop template and show quantities next to add to cart buttons

$show_quantities = get_option( 'wc_settings_tab_woorac_show_quantities' );
if($show_quantities == 'yes') {

    add_filter( 'woocommerce_loop_add_to_cart_link', 'woorac_qty_loop_add_to_cart_link', 10, 2 );

    function woorac_qty_loop_add_to_cart_link( $html, $product ) {
        if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
            $html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
            $html .= woocommerce_quantity_input( array(), $product, false );
            $html .= '<button type="submit" class="button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
            $html .= '</form>';
        }
        return $html;
    }
}