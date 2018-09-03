<?php
/**
* Plugin Name:  Mastersoft Address
* Plugin URI:   https://hosted.mastersoftgroup.com/console/#/
* Description:  Woocommerce address autocomplete plugin for AU and NZ
* Version:      0.1
* Author:       Mastersoft
* Author URI:   https://www.mastersoftgroup.com/
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
**/ 

//defined( 'ABSPATH' ) || exit;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	if( ! function_exists( 'load_mastersoft_address_scripts' ) ) {	//best practice from wordpress

	function load_mastersoft_address_scripts() {
		
		wp_enqueue_script('mastersoft-woocommerce', 
			plugins_url('js/mastersoft-woocommerce.js', __FILE__), 
			array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'));	

		$countries_obj = new WC_Countries();
		$nz_regions = $countries_obj->get_states('NZ');

		foreach($nz_regions as $x => $x_value) {
			/*	
			decoded (eg '&rsquo;' to '''), uppercase and only keep letters/numbers, eg "Hawke&rsquo;s Bay" -> "HAWKE'S BAY" -> "HAWKESBAY"
			because in nzad, some region names can have different punctuations than in woocommerce, eg. "Hawke's Bay" vs "Hawkes Bay"
			*/
			$x_value_decode_upper = strtoupper(html_entity_decode($x_value));
			$nz_regions[$x] = preg_replace('/[^a-zA-Z0-9]+/i', '', $x_value_decode_upper);	//somehow reg_replace only accept simple var, not nested fn in var
		}
 
		//var_dump($nz_regions);	//see this in view page source

		$dataToBePassed = array(
			'licenceKey' 		=> get_option('wc_mastersoft_settings_tab_licence_key'),
			'url' 				=> get_option('wc_mastersoft_settings_tab_url'),	//can also pass on default value: get_option('option_name', 'default_value')
			'widgetOptions' 	=> get_option('wc_mastersoft_settings_tab_widget_options'),
			'widgetOptionsAu' 	=> get_option('wc_mastersoft_settings_tab_widget_options_au'),
			'widgetOptionsNz' 	=> get_option('wc_mastersoft_settings_tab_widget_options_nz'),
			'nzRegionsValKey' 	=> array_flip($nz_regions)	//flip key,val to val,key
		);
	
		wp_localize_script('mastersoft-woocommerce', 'php_vars', $dataToBePassed);


		wp_enqueue_script('harmony', 'https://s3-ap-southeast-2.amazonaws.com/common.mastersoftgroup.com/scripts/harmony-current.min.js');
		wp_enqueue_style('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
	}

	}
	
	add_action( 'woocommerce_after_checkout_form', 'load_mastersoft_address_scripts' );
	add_action( 'woocommerce_after_edit_address_form_billing', 'load_mastersoft_address_scripts' );
	add_action( 'woocommerce_after_edit_address_form_shipping', 'load_mastersoft_address_scripts' );

//	add_action( 'woocommerce_after_edit_account_address_form', 'load_script' );
//	add_action( 'woocommerce_after_checkout_billing_form', 'load_script' );	
//	add_action( 'woocommerce_after_checkout_shipping_form', 'load_script' );

	//in admin mode: include mastersoft settings in the woocommerce admin settings.
	if( is_admin() ) {
		include_once( plugin_dir_path( __FILE__ ) . 'admin/woocommerce-mastersoft-settings.php' );	//relative to this current file
	}
}
?>
