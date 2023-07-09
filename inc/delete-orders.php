<?php

// Delete orders function
function eo_delete_orders($start_date, $end_date) {
    global $wpdb;

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = new DateInterval('P1M');
    $period = new DatePeriod($start, $interval, $end);

    // Delete data for each month in the date range
    foreach ($period as $month) {
        $month_start = $month->format('Y-m-d');
        $month_end = (clone $month)->modify('last day of this month')->format('Y-m-d');

        // Queries to delete data
        $delete_queries = [
            // Delete order items
            $wpdb->prepare("
                DELETE {$wpdb->prefix}woocommerce_order_items.* 
                FROM {$wpdb->prefix}woocommerce_order_items 
                INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}woocommerce_order_items.order_id
                WHERE {$wpdb->prefix}posts.post_type = 'shop_order' 
                AND {$wpdb->prefix}posts.post_date BETWEEN %s AND %s
            ", $month_start, $month_end),

            // Delete order meta
            $wpdb->prepare("
                DELETE {$wpdb->prefix}postmeta.* 
                FROM {$wpdb->prefix}postmeta 
                INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
                WHERE {$wpdb->prefix}posts.post_type = 'shop_order' 
                AND {$wpdb->prefix}posts.post_date BETWEEN %s AND %s
            ", $month_start, $month_end),

            // Delete orders
            $wpdb->prepare("
                DELETE FROM {$wpdb->prefix}posts 
                WHERE post_type = 'shop_order' 
                AND post_date BETWEEN %s AND %s
            ", $month_start, $month_end),
        ];

        // Execute each query
        foreach ($delete_queries as $query) {
            $wpdb->query($query);
        }
    }
}