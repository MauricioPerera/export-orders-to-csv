<?php

// Add the admin page
function eo_add_admin_page() {
    add_menu_page('Export Orders', 'Export Orders', 'manage_options', 'export_orders', 'eo_export_orders_page', 'dashicons-download', 60);
}
add_action('admin_menu', 'eo_add_admin_page');

// Export orders page content
function eo_export_orders_page() {
    require_once plugin_dir_path(__FILE__) . '../inc/export-csv.php';
    require_once plugin_dir_path(__FILE__) . '../inc/list-files.php';
    require_once plugin_dir_path(__FILE__) . '../inc/download-files.php';

    ?>
<div class="wrap">
    <h1>Export Orders</h1>
    <a href="https://www.buymeacoffee.com/rckflr" target="_blank"><img
            src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee"
            style="height: 60px !important;width: 217px !important;"></a>
    <p>Si te gusta este plugin y quieres apoyar mi trabajo, por favor considera comprarme un café. ¡Gracias!</p>

    <form method="post" style="margin-bottom: 20px;">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" class="regular-text">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" class="regular-text">
        <input type="submit" name="export_orders" value="Export Orders" class="button button-primary">
        <input type="submit" name="delete_orders" value="Delete Orders" class="button button-secondary">
    </form>
</div>
<?php
    if (isset($_POST['export_orders'])) {
        eo_export_orders_to_csv($_POST['start_date'], $_POST['end_date']);
    } elseif (isset($_POST['delete_orders'])) {
        eo_delete_orders($_POST['start_date'], $_POST['end_date']);
    } elseif (isset($_POST['delete_files'])) {
        eo_delete_files();
    }

    $files = eo_list_files();  // get files

    // Display files
    if (!empty($files)) {
        echo '<form method="post" id="files_form">';
        echo '<table class="widefat">';
        echo '<thead><tr><th>File Name</th><th>File Size</th><th><input type="checkbox" id="check_all"> Select All</th></tr></thead>';
        echo '<tbody>';

        foreach ($files as $file) {
            echo '<tr>';
            echo '<td>' . $file['name'] . '</td>';
            echo '<td>' . $file['size'] . ' bytes</td>';
            echo '<td><input type="checkbox" name="files[]" value="' . $file['name'] . '"></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<div style="margin-top: 20px;">';
        echo '<input type="submit" name="download_files" value="Download Selected Files" class="button button-primary" style="margin-right: 10px;">';
        echo '<input type="submit" name="delete_files" value="Delete Selected Files" class="button button-secondary">';
        echo '</div>';
        echo '</form>';

        // JavaScript to handle the "select all" checkbox
        echo '
            <script type="text/javascript">
                document.getElementById("check_all").addEventListener("change", function() {
                    var checkboxes = document.getElementById("files_form").querySelectorAll("input[type=checkbox]");
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = this.checked;
                    }
                });
            </script>
        ';
    } else {
        echo '<p>No files to display.</p>';
    }
}
?>