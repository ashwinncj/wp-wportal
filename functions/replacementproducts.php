<?php

//Admin Replacement Products page

wp_enqueue_style('datatables-css');
wp_enqueue_script('datatables-js');
$pgno = isset($_GET['pgno']) ? $_GET['pgno'] != '' ? $_GET['pgno'] : 1 : 1;
$pagination = ($pgno * 30) - 30;
global $wpdb;
$products = $wpdb->get_results("SELECT a.id AS id , a.name AS name, a.image AS image, b.name AS warranty_type, c.name AS terms FROM `wp_wportal_replacement_products` a JOIN `wp_wportal_warranty` b ON a.`warranty_type`=b.id JOIN `wp_wportal_terms` c ON a.`terms`=c.id WHERE 1 ORDER BY name ASC");
$total_produts = $products->num_rows;
$products = $wpdb->get_results("SELECT a.id AS id , a.name AS name, a.image AS image, b.name AS warranty_type, c.name AS terms FROM `wp_wportal_replacement_products` a JOIN `wp_wportal_warranty` b ON a.`warranty_type`=b.id JOIN `wp_wportal_terms` c ON a.`terms`=c.id WHERE 1 ORDER BY name ASC LIMIT 30 OFFSET $pagination;");
require_once WPORTAL__PLUGIN_DIR . './templates/replacementproducts-tpl.php';
?>