<?php

//Warranty edit page
global $wpdb;
$warranty = isset($_GET['warranty']) ? $_GET['warranty'] != '' ? $_GET['warranty'] : 'new' : 'new';
if (isset($_POST['upload_warranty'])) {
    $insert_id = upload_warranty($_POST);
    $warranty = $insert_id;
}

if ($warranty == 'new') {
    $page_name = 'Add a new warranty';
    $warranty_id = '';
    $warranty_name = '';
    $warranty_period = '';
} else {
    $page_name = 'Edit warranty';
    $error = 'Warranty updated!';
    $warranty_id = $warranty;
    $result = $wpdb->get_row("SELECT * FROM `wp_wportal_warranty` WHERE `id`= " . $warranty_id);
    $warranty_name = $result->name;
    $warranty_period = $result->period;
}

function upload_warranty($_options = '') {
    global $wpdb;
    //default values
    $default_options = array(
        'id' => '',
        'name' => '',
        'period' => 0
    );
    is_array($_options) ? $options = array_merge($default_options, $_options) : $options = $default_options;
    $sql = "REPLACE INTO wp_wportal_warranty(id,name,period) "
            . "VALUES ('" . $options['id'] . "','" . $options['name'] . "','" . $options['period'] . "');";
    //echo $sql;
    $results = $wpdb->get_results($sql);
    return $wpdb->insert_id;
}

require_once WPORTAL__PLUGIN_DIR . './templates/editwarranty-tpl.php';
?>