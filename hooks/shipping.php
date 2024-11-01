<?php
/**
* @package Woocommerce_Racoon
* @version 1.3
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
 * hide other shipping methods when free shipping is available
 *
 */

$hide_shipping_when_free = get_option( 'wc_settings_tab_woorac_hide_shipping_when_free' );

if($hide_shipping_when_free != '') {

    // hide all
    if($hide_shipping_when_free == 'hideall') {
        function woorac_hide_all_shipping_when_free_is_available( $rates ) {
            $free = array();
            foreach ( $rates as $rate_id => $rate ) {
                if ( 'free_shipping' === $rate->method_id ) {
                    $free[ $rate_id ] = $rate;
                    break;
                }
            }
            return ! empty( $free ) ? $free : $rates;
        }
        add_filter( 'woocommerce_package_rates', 'woorac_hide_all_shipping_when_free_is_available', 100 );
    }

    // hide all but keep local pickup
    if($hide_shipping_when_free == 'keeplocal') {
        function woorac_keep_local_when_free_is_available( $rates, $package ) {
            $new_rates = array();
            foreach ( $rates as $rate_id => $rate ) {
                // Only modify rates if free_shipping is present.
                if ( 'free_shipping' === $rate->method_id ) {
                    $new_rates[ $rate_id ] = $rate;
                    break;
                }
            }

            if ( ! empty( $new_rates ) ) {
                // Save local pickup if it's present.
                foreach ( $rates as $rate_id => $rate ) {
                    if ('local_pickup' === $rate->method_id ) {
                        $new_rates[ $rate_id ] = $rate;
                        break;
                    }
                }
                return $new_rates;
            }

            return $rates;
        }

        add_filter( 'woocommerce_package_rates', 'woorac_keep_local_when_free_is_available', 10, 2 );
    }
}
