<?php

/**
 * This file runs when the plugin is uninstalled (deactivated and deleted).
 * This will not run when the plugin is only deactivated.
 * It will clean up options for settings in the database.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}
 
global $wpdb;

// Delete mastersoft settings in options
$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'wc_mastersoft_settings_tab_%';");

?>
