<?php
/**
 * Plugin Name:  Loqate AU NZ Address
 * Plugin URI:   https://github.com/MastersoftGroup/woocommerce-mastersoft-address
 * Description:  Performance checkout with Address lookup and validation, business lookup and validation, email and phone validation​
 * Version:      2.0.0
 * Author:       Loqate
 * Author URI:   https://www.loqate.com/anz/
 * Developer:    Yulie Sandjojo/Mastersoft
 * Text Domain:  woocommerce-extension
 *
 * WC tested up to: 7.8.0
 *
 * Copyright:    @ 2022 Mastersoft
 * License:      GNU General Public License v2.0 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 **/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
$plugin_path = trailingslashit(WP_PLUGIN_DIR) . 'woocommerce/woocommerce.php';
if (
    in_array($plugin_path, wp_get_active_and_valid_plugins())
    || in_array($plugin_path, wp_get_active_network_plugins())
) {

    if (!function_exists('load_mastersoft_address_scripts')) {

        function load_mastersoft_address_scripts()
        {

            wp_enqueue_script(
                'mastersoft-woocommerce',
                plugins_url('js/mastersoft-woocommerce.js', __FILE__),
                array('jquery')
            );

            // Retrieve NZ Regions defined in WooCommerce
            $countries_obj = new WC_Countries();
            $nz_regions = $countries_obj->get_states('NZ');
            foreach ($nz_regions as $x => $x_value) {
                $x_value_decode_upper = strtoupper(html_entity_decode($x_value));
                $nz_regions[$x] = preg_replace('/[^a-zA-Z0-9]+/i', '', $x_value_decode_upper);
            }

            $dataToBePassed = array(
                'licenceKey'                        => get_option('wc_mastersoft_settings_tab_licence_key'),
                'url'                               => 'https://hosted.mastersoftgroup.com',
                'widgetLayout'                      => get_option('wc_mastersoft_settings_tab_widget_layout'),
                'widgetOptions'                     => get_option('wc_mastersoft_settings_tab_widget_options'),
                'widgetOptionsAu'                   => get_option('wc_mastersoft_settings_tab_widget_options_au'),
                'widgetOptionsNz'                   => get_option('wc_mastersoft_settings_tab_widget_options_nz'),
                'widgetOptionsEnhancedState'        => get_option('wc_mastersoft_settings_tab_widget_options_enhanced_state'),
                'widgetOptionsBusinessEnabled'      => get_option('wc_mastersoft_settings_tab_widget_options_business_enabled'),
                'widgetOptionsBusiness'             => get_option('wc_mastersoft_settings_tab_widget_options_business'),
                'widgetOptionsBusinessRetrieveName' => get_option('wc_mastersoft_settings_tab_widget_options_business_display_retrieved_name'),
                'widgetOptionsEmailEnabled'         => get_option('wc_mastersoft_settings_tab_widget_options_email_enabled'),
                'widgetOptionsEmail'                => get_option('wc_mastersoft_settings_tab_widget_options_email'),
                'widgetOptionsPhoneEnabled'         => get_option('wc_mastersoft_settings_tab_widget_options_phone_enabled'),
                'nzRegionsValKey'                   => array_flip($nz_regions)
            );

            wp_localize_script('mastersoft-woocommerce', 'php_vars', $dataToBePassed);
            wp_enqueue_script('harmony', 'https://common.mastersoftgroup.com/scripts/harmony-2.4.0.min.js');
            wp_enqueue_style('harmony', 'https://common.mastersoftgroup.com/scripts/harmony-2.4.0.css');
        }
    }

    add_action('woocommerce_after_checkout_form', 'load_mastersoft_address_scripts');
    add_action('woocommerce_after_edit_address_form_billing', 'load_mastersoft_address_scripts');
    add_action('woocommerce_after_edit_address_form_shipping', 'load_mastersoft_address_scripts');

    // Include Mastersoft Settings in the WooCommerce Admin Settings
    if (is_admin()) {
        include_once(plugin_dir_path(__FILE__) . 'admin/woocommerce-mastersoft-settings.php');
        include_once(plugin_dir_path(__FILE__) . 'admin/woocommerce-mastersoft-notices.php');
    }

    // Add some links for Loqate AU NZ Address plugin in WordPress Plugins page
    function mastersoft_add_plugin_action_links($links)
    {

        // Add Docs link to GitHub URL
        $docs_link = '<a href="https://docs.mastersoftgroup.com/loqate-harmony-api/integrations/woocommerce-plugin/woocommerce-user-guide" target="_blank">Docs</a>';
        array_unshift($links, $docs_link);

        // Add Settings link to Loqate AU NZ Address tab Settings
        $url = get_admin_url() . 'admin.php?page=wc-settings&tab=mastersoft_settings_tab';
        $settings_link = '<a href="' . $url . '">' . __('Settings', 'textdomain') . '</a>';
        array_unshift($links, $settings_link);

        return $links;
    }

    add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'mastersoft_add_plugin_action_links');

    //remove state validation if configured
    function mastersoft_no_state_validation($address_fields)
    {

        unset($address_fields['billing']['billing_state']['validate']);
        unset($address_fields['shipping']['shipping_state']['validate']);

        return $address_fields;
    }

    $enhanced_state_handling = get_option('wc_mastersoft_settings_tab_widget_options_enhanced_state');
    if ($enhanced_state_handling == 'yes') {
        add_filter('woocommerce_checkout_fields', 'mastersoft_no_state_validation');
    }
}
?>
