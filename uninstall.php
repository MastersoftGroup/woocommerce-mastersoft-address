<?php

/**
 * This file runs when the plugin is uninstalled (deactivated and deleted).
 * This will not run when the plugin is only deactivated.
 * It will clean up options for settings in the database.
 */

// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}
 
//$option_name = 'wporg_option'; 
//delete_option($option_name);

global $wpdb;

// Delete mastersoft settings in options
$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'wc_mastersoft_settings_tab_%';");

?>
