<?php

// Export orders to CSV
function eo_export_orders_to_csv($start_date, $end_date) {
    global $wpdb;

    // Get the upload directory
    $upload_dir = wp_upload_dir();

    // Create a new directory for order backups
    $bkp_dir = $upload_dir['basedir'] . '/orders_bkp';
    if (!file_exists($bkp_dir)) {
        mkdir($bkp_dir, 0755, true);
    }

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = new DateInterval('P1M');
    $period = new DatePeriod($start, $interval, $end);

    // Create a CSV for each month in the date range
    foreach ($period as $month) {
        $month_start = $month->format('Y-m-d');
        $month_end = (clone $month)->modify('last day of this month')->format('Y-m-d');

        // Create a string with the dates for the file names
        $dates = str_replace('-', '_', $month_start) . '_to_' . str_replace('-', '_', $month_end);

        // Queries to get the data and create CSVs
        $data_queries = [
            'orders' => [
                'query' => $wpdb->prepare("
                    SELECT * FROM {$wpdb->prefix}posts 
                    WHERE post_type = 'shop_order' 
                    AND post_date BETWEEN %s AND %s
                ", $month_start, $month_end),
                'file' => fopen($bkp_dir . '/orders_' . $dates . '.csv', 'w'),
            ],
            'order_meta' => [
                'query' => $wpdb->prepare("
                    SELECT {$wpdb->prefix}postmeta.* 
                    FROM {$wpdb->prefix}postmeta 
                    INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
                    WHERE {$wpdb->prefix}posts.post_type = 'shop_order' 
                    AND {$wpdb->prefix}posts.post_date BETWEEN %s AND %s
                ", $month_start, $month_end),
                'file' => fopen($bkp_dir . '/order_meta_' . $dates . '.csv', 'w'),
            ],
            'order_items' => [
                'query' => $wpdb->prepare("
                    SELECT 
                        order_items.*,
                        order_itemmeta.meta_key,
                        order_itemmeta.meta_value 
                    FROM {$wpdb->prefix}woocommerce_order_items as order_items
                    JOIN
                        {$wpdb->prefix}woocommerce_order_itemmeta as order_itemmeta
                    ON
                        order_items.order_item_id = order_itemmeta.order_item_id
                    INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = order_items.order_id
                    WHERE {$wpdb->prefix}posts.post_type = 'shop_order' 
                    AND {$wpdb->prefix}posts.post_date BETWEEN %s AND %s
                    AND order_itemmeta.meta_key IN ('_line_total', '_line_subtotal')
                ", $month_start, $month_end),
                'file' => fopen($bkp_dir . '/order_items_' . $dates . '.csv', 'w'),
            ],
            'customer_data' => [
                'query' => $wpdb->prepare("
                    SELECT {$wpdb->prefix}postmeta.* 
                    FROM {$wpdb->prefix}postmeta 
                    INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
                    WHERE {$wpdb->prefix}posts.post_type = 'shop_order' 
                    AND {$wpdb->prefix}posts.post_date BETWEEN %s AND %s
                    AND {$wpdb->prefix}postmeta.meta_key IN ('_billing_email', '_billing_first_name', '_billing_last_name')
                ", $month_start, $month_end),
                'file' => fopen($bkp_dir . '/customer_data_' . $dates . '.csv', 'w'),
            ],
        ];

        foreach ($data_queries as $data) {
            // Execute the query
            $results = $wpdb->get_results($data['query'], ARRAY_A);

            // Write the CSV headers
            if (!empty($results)) {
                fputcsv($data['file'], array_keys($results[0]));
            }

            // Write the CSV rows
            foreach ($results as $result) {
                fputcsv($data['file'], $result);
            }

            // Close the CSV file
            fclose($data['file']);
        }
    }
}

?>