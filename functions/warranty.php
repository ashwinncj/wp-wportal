<?php

//Admin Warranty page

wp_enqueue_style('datatables-css');
wp_enqueue_script('datatables-js');
$pgno = isset($_GET['pgno']) ? $_GET['pgno'] != '' ? $_GET['pgno'] : 1 : 1;
$pagination = ($pgno * 30) - 30;
global $wpdb;
$warranty = $wpdb->get_results("SELECT * FROM `wp_wportal_warranty` WHERE 1 ORDER BY name ASC");
$total_warranty = $warranty->warranty;
$warranty = $wpdb->get_results("SELECT * FROM `wp_wportal_warranty` WHERE 1 ORDER BY name ASC LIMIT 30 OFFSET $pagination;");
require_once WPORTAL__PLUGIN_DIR . './templates/warranty-tpl.php';
?>