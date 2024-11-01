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
 * define the woocommerce_get_price_suffix callback
 *
 */

function filter_woocommerce_get_price_suffix( $price_display_suffix, $instance ) {

    $suffix = get_option( 'woocommerce_price_display_suffix' );
    $needle = get_option( 'wc_settings_tab_woorac_price_suffix_selector' );
    $link_id = get_option( 'wc_settings_tab_woorac_price_suffix_link' );
    $link = get_permalink($link_id);

    if($needle&&$suffix){
        $price_display_suffix = preg_replace('/'.$needle.'/', '<a href="'.$link.'">'.$needle.'</a>', $price_display_suffix);
    }

    return $price_display_suffix;
};

add_filter( 'woocommerce_get_price_suffix', 'filter_woocommerce_get_price_suffix', 10, 2 );

?>