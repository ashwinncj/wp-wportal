<?php

//Admin Delete page
if (isset($_POST['item']) && isset($_POST['id']) && $_POST['item'] != '' && $_POST['id'] != '') {
    $table = '';
    $return_page = '';
    $id = $_POST['id'];
    $item = $_POST['item'];
    switch ($item) {
        case 'product':
            $table = 'wp_wportal_products';
            $return_page = 'warranty_portal_products';
            break;
        case 'replacement':
            $table = 'wp_wportal_replacement_products';
            $return_page = 'warranty_portal_replacement_products';
            break;
        case 'terms':
            $table = 'wp_wportal_terms';
            $return_page = 'warranty_portal_terms';
            break;
        case 'warranty':
            $table = 'wp_wportal_warranty';
            $return_page = 'warranty_portal_warranty';
            break;
        default :
            $table = '';
    }
    delete_item($table, $id, $return_page);
} elseif (isset($_GET['item']) && isset($_GET['id']) && $_GET['item'] != '' && $_GET['id'] != '') {
    $id = $_GET['id'];
    $item = $_GET['item'];
    $name = $_GET['name'];
    switch ($item) {
        case 'product':
            $return_page = 'warranty_portal_products';
            break;
        case 'replacement':
            $return_page = 'warranty_portal_replacement_products';
            break;
        case 'terms':
            $return_page = 'warranty_portal_terms';
            break;
        case 'warranty':
            $return_page = 'warranty_portal_warranty';
            break;
        default :
            $table = '';
    }
    require_once WPORTAL__PLUGIN_DIR . './templates/delete-tpl.php';
}

function delete_item($table, $id, $return_page) {
    if ($table != '') {
        global $wpdb;
        $result = $wpdb->get_results("DELETE FROM `$table` WHERE `id`=$id");
        echo '<h2>The delete operation was successful. </h2>';
        echo '<a href="' . admin_url('admin.php?page=' . $return_page) . '"><button>Go Back</button></a>';
    }
}

?>