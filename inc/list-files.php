<?php

// Function to get files in the "orders_bkp" directory
function eo_list_files() {
    // Get the upload directory
    $upload_dir = wp_upload_dir();

    // The directory with the order backup files
    $bkp_dir = $upload_dir['basedir'] . '/orders_bkp';

    // Check if the directory exists before scanning
    if (!file_exists($bkp_dir)) {
        return [];
    }

    // Get all the files in the backup directory
    $files = scandir($bkp_dir);

    // Check if files are read properly
    if ($files === false) {
        return [];
    }

    // Remove the '.' and '..' entries
    $files = array_diff($files, ['.', '..']);

    // Prepare files array to return
    $result = array();

    // Populate each file's information into the array
    foreach ($files as $file) {
        $result[] = array(
            'name' => $file,
            'size' => filesize($bkp_dir . '/' . $file)
        );
    }

    return $result;
}

?>