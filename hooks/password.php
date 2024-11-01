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
 * define the password strength
 *
 */

$min_password_strength = get_option( 'wc_settings_tab_woorac_min_password_strength' );

if($min_password_strength != '') {

    if($min_password_strength == 'none') {

        function woorac_remove_password_strength() {

            if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
                wp_dequeue_script( 'wc-password-strength-meter' );
            }

        }
        add_action( 'wp_print_scripts', 'woorac_remove_password_strength', 100 );

    } else {

        function woorac_min_password_strength() {

            $min_password_strength = get_option( 'wc_settings_tab_woorac_min_password_strength' );
            return $min_password_strength;

        }
        add_filter( 'woocommerce_min_password_strength', 'woorac_min_password_strength' );

    }
}
