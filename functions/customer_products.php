<?php

//Customer Products Function
function customer_products_function() {
    ob_start();
    require_once WPORTAL__PLUGIN_DIR . './templates/customer_products-tpl.php';
    return ob_get_clean();
}

?>