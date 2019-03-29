<?php

//Shortcode registration here

add_shortcode('radel-login', 'login_function');
add_shortcode('radel-register', 'register_function');
add_shortcode('ecopure-customer-panel', 'customer_portal_function');
add_shortcode('ecopure-register-product', 'register_product_function');
add_shortcode('ecopure-customer-products', 'customer_products_function');

// run it before the headers and cookies are sent
require_once WPORTAL__PLUGIN_DIR . './functions/register.php';
require_once WPORTAL__PLUGIN_DIR . './functions/login.php';
require_once WPORTAL__PLUGIN_DIR . './functions/customer_portal.php';
require_once WPORTAL__PLUGIN_DIR . './functions/register_product.php';
require_once WPORTAL__PLUGIN_DIR . './functions/customer_products.php';
