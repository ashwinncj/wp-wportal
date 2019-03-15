<?php

//Admin section functions included here

add_action('admin_menu', 'wportal_menus');

function wportal_menus() {
    add_menu_page('Warranty Portal Dashboard', 'Warranty Portal', 'manage_options', 'warrany_portal_dashboard', 'dashboard_function', '', '100');

    //Products page
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Products', 'manage_options', 'warranty_portal_products', 'products_function');
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Edit product //temp', 'manage_options', 'wportal_product', 'edit_products_function');

    //Replacement Products page
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Replacement Products', 'manage_options', 'warranty_portal_replacement_products', 'replacement_products_function');
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Edit replacement product //temp', 'manage_options', 'wportal_replacement_product', 'edit_replacement_products_function');

    //Warranty page
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Warranty', 'manage_options', 'warranty_portal_warranty', 'warranty_function');
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Edit warranty //temp', 'manage_options', 'wportal_warranty', 'edit_warranty_function');

    //Terms and Conditions page
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Terms and Conditions', 'manage_options', 'warranty_portal_terms', 'terms_function');
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Edit terms //temp', 'manage_options', 'wportal_terms', 'edit_terms_function');
}

function dashboard_function() {
    require_once WPORTAL__PLUGIN_DIR . './templates/dashboard-tpl.php';
}

function products_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/products.php';
}

function edit_products_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/editproduct.php';
}

function replacement_products_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/replacementproducts.php';
}

function edit_replacement_products_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/editreplacementproduct.php';
}

function warranty_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/warranty.php';
}

function edit_warranty_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/editwarranty.php';
}

function terms_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/terms.php';
}

function edit_terms_function() {
    require_once WPORTAL__PLUGIN_DIR . './functions/editterms.php';
}
