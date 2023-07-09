<?php
/*
 * Plugin Name: Export Orders to CSV
 * Plugin URI: https://rckflr.party/
 * Description: This WordPress plugin is designed to export WooCommerce orders into a CSV file. It provides a convenient interface in the WordPress dashboard where users can select a date range for the orders to be exported. Additionally, it allows users to download or delete the generated CSV files.
 * Version: 1.0
 * Author: Mauricio Perera
 * Author URI: https://www.linkedin.com/in/mauricioperera/
 */

// Include the necessary files
require_once plugin_dir_path(__FILE__) . 'inc/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'inc/export-csv.php';
require_once plugin_dir_path(__FILE__) . 'inc/delete-orders.php';
require_once plugin_dir_path(__FILE__) . 'inc/list-files.php';
require_once plugin_dir_path(__FILE__) . 'inc/download-files.php';