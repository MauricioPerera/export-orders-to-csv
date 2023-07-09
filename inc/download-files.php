<?php
// Handle file downloads
function eo_download_files() {
    if (isset($_POST['download_files'])) {
        // Get the upload directory
        $upload_dir = wp_upload_dir();
        $bkp_dir = $upload_dir['basedir'] . '/orders_bkp';
        
        $files = $_POST['files'];
        $zipname = 'orders.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($bkp_dir . '/' . $file, $file);  // Note the second parameter
        }
        $zip->close();

        // Send the file to the browser
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

        // Delete the zip file
        unlink($zipname);

        // Stop the script
        die();
    }
}
add_action('init', 'eo_download_files');

function eo_delete_files() {
    if (isset($_POST['delete_files'])) {
        // Get the upload directory
        $upload_dir = wp_upload_dir();
        $bkp_dir = $upload_dir['basedir'] . '/orders_bkp';
        
        $files = $_POST['files'];

        // Delete each file
        foreach ($files as $file) {
            $file_path = $bkp_dir . '/' . $file;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Stop the script
        die();
    }
}
add_action('init', 'eo_delete_files');


?>