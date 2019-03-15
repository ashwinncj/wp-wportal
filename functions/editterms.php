<?php

//Warranty edit page
global $wpdb;
$terms = isset($_GET['terms']) ? $_GET['terms'] != '' ? $_GET['terms'] : 'new' : 'new';
if (isset($_POST['upload_terms'])) {
    $insert_id = upload_terms($_POST);
    $error = 'Terms and Conditions updated!';
    $terms = $insert_id;
}

if ($terms == 'new') {
    $page_name = 'Add a new Terms and Conditions';
    $terms_id = '';
    $terms_name = '';
    $terms_document = '';
} else {
    $page_name = 'Edit Terms and Conditions';
    $terms_id = $terms;
    $result = $wpdb->get_row("SELECT * FROM `wp_wportal_terms` WHERE `id`= " . $terms_id);
    $terms_name = $result->name;
    $terms_document = $result->document;
}

function upload_terms($_options = '') {
    global $wpdb;
    //default values
    $default_options = array(
        'id' => '',
        'name' => '',
        'document' => ''
    );
    is_array($_options) ? $options = array_merge($default_options, $_options) : $options = $default_options;
    $sql = "REPLACE INTO wp_wportal_terms(id,name,document) "
            . "VALUES ('" . $options['id'] . "','" . $options['name'] . "','" . $options['document'] . "');";
    //echo $sql;
    $results = $wpdb->get_results($sql);
    return $wpdb->insert_id;
}

require_once WPORTAL__PLUGIN_DIR . './templates/editterms-tpl.php';
?>