<?php

//Admin Terms and Conditions page

wp_enqueue_style('datatables-css');
wp_enqueue_script('datatables-js');
$pgno = isset($_GET['pgno']) ? $_GET['pgno'] != '' ? $_GET['pgno'] : 1 : 1;
$pagination = ($pgno * 30) - 30;
global $wpdb;
$terms = $wpdb->get_results("SELECT * FROM `wp_wportal_terms` WHERE 1 ORDER BY name ASC");
$total_terms = $terms->warranty;
$terms = $wpdb->get_results("SELECT * FROM `wp_wportal_terms` WHERE 1 ORDER BY name ASC LIMIT 30 OFFSET $pagination;");
require_once WPORTAL__PLUGIN_DIR . './templates/terms-tpl.php';
?>