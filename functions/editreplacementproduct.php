<?php
//Replacement Product Functions
global $wpdb;
$product = isset($_GET['product']) ? $_GET['product'] != '' ? $_GET['product'] : 'new' : 'new';
if (isset($_POST['upload_product'])) {
    $insert_id = upload_product($_POST);
    $error = 'Product updated!';
    $product = $insert_id;
}
$terms_list = $wpdb->get_results('SELECT * FROM `wp_wportal_terms` WHERE 1');
$warranty_list = $wpdb->get_results('SELECT * FROM `wp_wportal_warranty` WHERE 1');
//print_r($terms_list);
if ($product == 'new') {
    $page_name = 'Add a new replacement product';
    $product_id = '';
    $product_name = '';
    $product_image = '';
    $product_warranty_type = '';
    $product_terms = '';    
} else {
    $page_name = 'Edit replacement product';
    $product_id = $product;
    $result = $wpdb->get_row("SELECT * FROM `wp_wportal_replacement_products` WHERE id = " . $product_id);
    $product_name = $result->name;
    $product_image = $result->image;
    $product_warranty_type = $result->warranty_type;
    $product_terms = $result->terms;
}

function upload_product($_options = '') {
    global $wpdb;
    //default values
    $default_options = array(
        'id' => '',
        'name' => '',
        'image' => '',
        'warranty_type' => '',
        'terms' => ''
    );
    is_array($_options) ? $options = array_merge($default_options, $_options) : $options = $default_options;
    $sql = "REPLACE INTO wp_wportal_replacement_products(id,name,image,warranty_type,terms) "
            . "VALUES ('" . $options['id'] . "','" . $options['name'] . "','" . $options['image'] . "','" . $options['warranty_type'] . "'"
            . ",'" . $options['terms'] . "');";
    $results = $wpdb->get_results($sql);
    return $wpdb->insert_id;
}

require_once WPORTAL__PLUGIN_DIR . './templates/editreplacementproduct-tpl.php';
?>