<?php

//Customer Portal Function
function register_product_function() {
    ob_start();
    require_once WPORTAL__PLUGIN_DIR . './templates/register_product-tpl.php';
    return ob_get_clean();
}

?>