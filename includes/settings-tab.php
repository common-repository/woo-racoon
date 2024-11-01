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


// Init new settings tab
class WC_Settings_Tab_woorac {

    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
    }
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_woorac'] = __( 'WooRac Advanced Settings', 'woocommerce-racoon' );
        return $settings_tabs;
    }

}
WC_Settings_Tab_woorac::init();



// Add custom styling to the tab
function woorac_custom_wp_admin_style() {

    $url = '//' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if (strpos($url,'tab=settings_tab_woorac') !== false) {

        wp_register_style( 'woorac_wp_admin_css', plugins_url( 'css/woorac-admin-style.css' , dirname(__FILE__) ), false, '1.0.1' );
        wp_enqueue_style( 'woorac_wp_admin_css' );

    }

}
add_action( 'admin_enqueue_scripts', 'woorac_custom_wp_admin_style' );




// Add settings to the page
add_action( 'woocommerce_settings_tabs_settings_tab_woorac', 'settings_tab_woorac' );
function settings_tab_woorac() {

    get_woorac_settings_tab_sidebar();
    woocommerce_admin_fields( get_woorac_settings() );

}





function get_woorac_settings() {

    $settings = array(

        ////////////////////////////////////////
        // GENERAL SETTINGS
        'section_title' => array(
            'name'     => __( 'Advanced Settings', 'woocommerce-racoon' ),
            'type'     => 'title',
            'desc'     => __( 'Advanced configuration for WooCommerce.', 'woocommerce-racoon' ),
            'id'       => 'wc_settings_tab_woorac_section_general'
        ),
        'min_password_strength' => array(
            'name' => __( 'Password strength', 'woocommerce-racoon' ),
            'type' => 'select',
            'options' => array(
                ''        => __( 'Choose password strength', 'woocommerce-racoon' ),
                'none'    => __( 'No review', 'woocommerce-racoon' ),
                '1'       => __( 'Very easy', 'woocommerce-racoon' ),
                '2'       => __( 'Easy', 'woocommerce-racoon' ),
                '3'       => __( 'Medium', 'woocommerce-racoon' ),
                '4'       => __( 'Strong', 'woocommerce-racoon' ),
                '5'       => __( 'Very strong', 'woocommerce-racoon' )
            ),
            'desc_tip' =>  true,
            'desc' => __( 'Select the password strength that new customers have to match. (No review is not recommended!)', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_min_password_strength'
        ),
        'price_suffix_selector' => array(
            'name' => __( 'Price suffix selector', 'woocommerce-racoon' ),
            'type' => 'text',
            'desc_tip' =>  true,
            'desc' => __( 'Please enter here the part of the text from "Price Display Suffix" in the "Tax" tab which should be the link.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_price_suffix_selector'
        ),
        'price_suffix_link' => array(
            'name' => __( 'Price suffix link', 'woocommerce-racoon' ),
            'type' => 'single_select_page',
            'desc_tip' =>  true,
            'desc' => __( 'Select the page you want to link to.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_price_suffix_link'
        ),
        'section_end' => array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_woorac_section_general'
        ),

        ////////////////////////////////////////
        // BREADCRUMB
        'section_title_2' => array(
            'name'     => __( 'Breadcrumb', 'woocommerce-racoon' ),
            'type'     => 'title',
            'desc'     => __( 'Configuration for the breadcrumb navigation.', 'woocommerce-racoon' ),
            'id'       => 'wc_settings_tab_woorac_section_breacrumb'
        ),
        'hide_breadcrumb' => array(
            'name' => __( 'Show breadcrumb navigation', 'woocommerce-racoon' ),
            'type' => 'select',
            'desc_tip' =>  true,
            'options' => array(
                ''        => __( 'Choose option', 'woocommerce-racoon' ),
                'yes'     => __( 'Yes', 'woocommerce-racoon' ),
                'no'      => __( 'No', 'woocommerce-racoon' )
            ),
            'desc' => __( 'Decide if you want to show the breadcrumb navigation or not.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_hide_breadcrumb'
        ),
        'breadcrumb_home' => array(
            'name' => __( 'Breadcrumb home text', 'woocommerce-racoon' ),
            'type' => 'text',
            'desc_tip' =>  true,
            'desc' => __( 'Please enter here your custom home text. Leave empty for the default "Home".', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_breadcrumb_home'
        ),
        'breadcrumb_home_link' => array(
            'name' => __( 'Breadcrumb home link', 'woocommerce-racoon' ),
            'type' => 'text',
            'desc_tip' =>  true,
            'desc' => __( 'Please enter here the absolute URL for the home text. Leave empty for the default "Shop".', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_breadcrumb_home_link'
        ),
        'breadcrumb_seperator' => array(
            'name' => __( 'Breadcrumb separator', 'woocommerce-racoon' ),
            'type' => 'text',
            'desc_tip' =>  true,
            'desc' => __( 'Please enter here your custom separator. Leave empty for the default "/".', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_breadcrumb_separator'
        ),
        'section_end_2' => array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_woorac_section_breacrumb'
        ),

        ////////////////////////////////////////
        // SHOP PAGE ARCHIVE
        'section_title_3' => array(
            'name'     => __( 'Shop Page', 'woocommerce-racoon' ),
            'type'     => 'title',
            'desc'     => __( 'Custom settings for the shop archive page.', 'woocommerce-racoon' ),
            'id'       => 'wc_settings_tab_woorac_section_shop'
        ),
        'per_page' => array(
            'name' => __( 'Products per page', 'woocommerce-racoon' ),
            'type' => 'text',
            'desc_tip' =>  true,
            'desc' => __( 'How many products do you want to show per page? Type "-1" for no pagination and all products.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_nr_products'
        ),
        'hide_show_results' => array(
            'name' => __( 'Hide result count', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the result count activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_hide_show_results'
        ),
        'category_count' => array(
            'name' => __( 'Hide category product count', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the category product count activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_category_count'
        ),
        'product_orderby' => array(
            'name' => __( 'Hide product order dropdown', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the product order dropdown activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_product_orderby'
        ),
        'show_quantities' => array(
            'name' => __( 'Show quantities next to add to cart buttons', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to show quantities next to add to cart buttons activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_show_quantities'
        ),
        'section_end_3' => array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_woorac_section_shop'
        ),

        ////////////////////////////////////////
        // SHOP PAGE SINGLE PRODUCT
        'section_title_4' => array(
            'name'     => __( 'Single product page', 'woocommerce-racoon' ),
            'type'     => 'title',
            'desc'     => __( 'Custom settings for the single product page', 'woocommerce-racoon' ),
            'id'       => 'wc_settings_tab_woorac_section_single_product',
            'class'    => 'testtesttesttest'
        ),
        'product_meta' => array(
            'name' => __( 'Hide single product meta', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the product meta data (SKU, category, tags, etc...) activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_product_meta'
        ),
        'tab_desc' => array(
            'name' => __( 'Hide tab description', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the tab description activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_tab_desc'
        ),
        'tab_reviews' => array(
            'name' => __( 'Hide tab reviews', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the tab reviews activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_tab_reviews'
        ),
        'tab_additional_information' => array(
            'name' => __( 'Hide tab additional information', 'woocommerce-racoon' ),
            'type' => 'checkbox',
            'default' => '',
            'desc' => __( 'If you want to hide the tab additional information activate this checkbox.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_tab_additional_information'
        ),
        'section_end_4' => array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_woorac_section_single_product'
        ),

        ////////////////////////////////////////
        // CHECKOUT
        'section_title_5' => array(
            'name'     => __( 'Checkout', 'woocommerce-racoon' ),
            'type'     => 'title',
            'desc'     => __( 'Custom settings for the checkout', 'woocommerce-racoon' ),
            'id'       => 'wc_settings_tab_woorac_section_checkout',
            'class'    => 'testtesttesttest'
        ),
        'hide_shipping_when_free' => array(
            'name' => __( 'Hide other shipping methods', 'woocommerce-racoon' ),
            'type' => 'select',
            'desc_tip' =>  true,
            'options' => array(
                '' => __( 'Choose option', 'woocommerce-racoon' ),
                'hideall' => __( 'Hide all other shipping methods when free shipping is available', 'woocommerce-racoon' ),
                'keeplocal' => __( 'Hide shipping rates when free shipping is available, but keep "Local pickup"', 'woocommerce-racoon' )
            ),
            'desc' => __( 'If you want to hide other shipping methods when free shipping is available choose option.', 'woocommerce-racoon' ),
            'id'   => 'wc_settings_tab_woorac_hide_shipping_when_free'
        ),
        'section_end_5' => array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_woorac_section_checkout'
        ),
    );
    return apply_filters( 'wc_settings_tab_woorac_settings', $settings );

}


add_action( 'woocommerce_update_options_settings_tab_woorac', 'update_woorac_settings' );
function update_woorac_settings() {
    woocommerce_update_options( get_woorac_settings() );
}
?>