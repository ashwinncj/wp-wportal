<?php

//Admin section functions included here

add_action('admin_menu', 'wportal_menus');

function wportal_menus() {
    add_menu_page('Warranty Portal Dashboard', 'Warranty Portal', 'manage_options', 'warrany_portal_dashboard', 'dashboard_function', '', '100');
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Products', 'manage_options', 'warranty_portal_products', 'products_function');
}

function dashboard_function() {
    require_once WPORTAL__PLUGIN_DIR . './templates/dashboard-tpl.php';
}

function products_function() {
    require_once WPORTAL__PLUGIN_DIR . './templates/products-tpl.php';
}
