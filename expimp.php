<?php
/*
 * Plugin Name: Export Orders to CSV
 * Plugin URI: https://rckflr.party/
 * Description: This WordPress plugin is designed to export WooCommerce orders into a CSV file. It provides a convenient interface in the WordPress dashboard where users can select a date range for the orders to be exported. Additionally, it allows users to download or delete the generated CSV files.
 * Version: 1.1
 * Author: Mauricio Perera
 * Author URI: https://www.linkedin.com/in/mauricioperera/
 * Donate link: https://www.buymeacoffee.com/rckflr
 */

// Include the necessary files
require_once plugin_dir_path(__FILE__) . 'inc/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'inc/export-csv.php';
require_once plugin_dir_path(__FILE__) . 'inc/delete-orders.php';
require_once plugin_dir_path(__FILE__) . 'inc/list-files.php';
require_once plugin_dir_path(__FILE__) . 'inc/download-files.php';

function add_action_links ( $links ) {
    $mylinks = array(
        '<a href="https://www.buymeacoffee.com/rckflr" target="_blank">Buy Me A Coffee</a>',
    );
    return array_merge( $links, $mylinks );
}
add_filter( 'plugin_action_links_export-orders-to-csv/export-orders-to-csv.php', 'add_action_links' );