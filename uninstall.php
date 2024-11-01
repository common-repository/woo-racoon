<?php

if (
    !defined( 'WP_UNINSTALL_PLUGIN' )
    ||
    !WP_UNINSTALL_PLUGIN
    ||
    dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) )
) {
    status_header( 404 );
    exit;
}

// Delete all options

// old values that may be stored:
delete_option( 'wc_settings_tab_woorac_placeholder' );

// current used values:
delete_option( 'wc_settings_tab_woorac_min_password_strength' );
delete_option( 'wc_settings_tab_woorac_price_suffix_selector' );
delete_option( 'wc_settings_tab_woorac_price_suffix_link' );

delete_option( 'wc_settings_tab_woorac_hide_breadcrumb' );
delete_option( 'wc_settings_tab_woorac_breadcrumb_home' );
delete_option( 'wc_settings_tab_woorac_breadcrumb_home_link' );
delete_option( 'wc_settings_tab_woorac_breadcrumb_separator' );

delete_option( 'wc_settings_tab_woorac_nr_products' );
delete_option( 'wc_settings_tab_woorac_hide_show_results' );
delete_option( 'wc_settings_tab_woorac_category_count' );
delete_option( 'wc_settings_tab_woorac_product_orderby' );
delete_option( 'wc_settings_tab_woorac_show_quantities' );

delete_option( 'wc_settings_tab_woorac_product_meta' );
delete_option( 'wc_settings_tab_woorac_tab_desc' );
delete_option( 'wc_settings_tab_woorac_tab_reviews' );
delete_option( 'wc_settings_tab_woorac_tab_additional_information' );

delete_option( 'wc_settings_tab_woorac_hide_shipping_when_free' );