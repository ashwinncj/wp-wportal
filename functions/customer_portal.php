<?php

//Customer Portal Function
function customer_portal_function() {
    ob_start();
    require_once WPORTAL__PLUGIN_DIR . './templates/customer_portal-tpl.php';
    return ob_get_clean();
}

?>