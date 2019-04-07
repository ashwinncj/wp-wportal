<?php

//Customer Products Function
function customer_information_function() {
    ob_start();
    require_once WPORTAL__PLUGIN_DIR . './templates/customer_information-tpl.php';
    return ob_get_clean();
}

?>