<?php

//Warranty page
require_once WPORTAL__PLUGIN_DIR . './templates/replacementproducts-tpl.php';
$pagination = isset($_GET['pgno']) ? $_GET['pgno'] != '' ? $_GET['pgno'] : 1 : 1;
$pagination = ($pagination * 30) - 30;
global $wpdb;
//$products = $wpdb->get_results("SELECT a.id AS id , a.name AS name, a.image AS image, b.name AS warranty_type, c.name AS terms, a.lifetime_warranty AS lifetime_warranty, a.five_year_warranty as five_year_warranty FROM `wp_wportal_products` a JOIN `wp_wportal_warranty` b ON a.`warranty_type`=b.id JOIN `wp_wportal_terms` c ON a.`terms`=c.id WHERE 1 ORDER BY name ASC LIMIT 30 OFFSET $pagination;");
//print_r($products);
?>