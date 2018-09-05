<?php
/**
* Plugin Name:  Mastersoft Address
* Plugin URI:   https://github.com/MastersoftGroup/woocommerce-mastersoft-address
* Description:  AU and NZ Address autocomplete plugin for WooCommerce Checkout and Account Addresses
* Version:      1.0.0
* Author:       Mastersoft
* Author URI:   https://www.mastersoftgroup.com/
* Developer:    Yulie Sandjojo/Mastersoft
* Text Domain:  woocommerce-extension
*
* WC tested up to: 3.4.5
*
* Copyright:    @ 2018 Mastersoft
* License:      GNU General Public License v2.0 or later
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
**/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	if( ! function_exists( 'load_mastersoft_address_scripts' ) ) {	

		function load_mastersoft_address_scripts() {
			
			wp_enqueue_script('mastersoft-woocommerce', 
				plugins_url('js/mastersoft-woocommerce.js', __FILE__), 
				array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'));	

			// Retrieve NZ Regions defined in WooCommerce
			$countries_obj = new WC_Countries();
			$nz_regions = $countries_obj->get_states('NZ');
			foreach($nz_regions as $x => $x_value) {
				$x_value_decode_upper = strtoupper(html_entity_decode($x_value));
				$nz_regions[$x] = preg_replace('/[^a-zA-Z0-9]+/i', '', $x_value_decode_upper);
			}

			$dataToBePassed = array(
				'licenceKey' 		=> get_option('wc_mastersoft_settings_tab_licence_key'),
				'url' 				=> get_option('wc_mastersoft_settings_tab_url'),
				'widgetOptions' 	=> get_option('wc_mastersoft_settings_tab_widget_options'),
				'widgetOptionsAu' 	=> get_option('wc_mastersoft_settings_tab_widget_options_au'),
				'widgetOptionsNz' 	=> get_option('wc_mastersoft_settings_tab_widget_options_nz'),
				'nzRegionsValKey' 	=> array_flip($nz_regions)	
			);
		
			wp_localize_script('mastersoft-woocommerce', 'php_vars', $dataToBePassed);
			wp_enqueue_script('harmony', 'https://s3-ap-southeast-2.amazonaws.com/common.mastersoftgroup.com/scripts/harmony-current.min.js');
			wp_enqueue_style('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
		}
	}	
	
	add_action( 'woocommerce_after_checkout_form', 'load_mastersoft_address_scripts' );
	add_action( 'woocommerce_after_edit_address_form_billing', 'load_mastersoft_address_scripts' );
	add_action( 'woocommerce_after_edit_address_form_shipping', 'load_mastersoft_address_scripts' );

	// Include Mastersoft Settings in the WooCommerce Admin Settings
	if( is_admin() ) {
		include_once( plugin_dir_path( __FILE__ ) . 'admin/woocommerce-mastersoft-settings.php' );
	}
	
    // Add some links for Mastersoft Address plugin in WordPress Plugins page
    function plugin_add_action_links ( $links ) {
	
        // Add Docs link to GitHub URL
        $docs_link = '<a href="https://github.com/MastersoftGroup/woocommerce-mastersoft-address" target="_blank">Docs</a>';
        array_unshift( $links, $docs_link );

        // Add Settings link to Mastersoft Address tab Settings
        $url = get_admin_url() . 'admin.php?page=wc-settings&tab=mastersoft_settings_tab';
        $settings_link = '<a href="' . $url . '">' . __( 'Settings', 'textdomain' ) . '</a>';
        array_unshift( $links, $settings_link );

        return $links;
    }
	
    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'plugin_add_action_links' );	
}
?>
