<?php

//Customer Products Function
function customer_products_function() {
    ob_start();
    if (is_user_logged_in()) {
        require_once WPORTAL__PLUGIN_DIR . './templates/customer_products-tpl.php';
    }
    return ob_get_clean();
}

?>