<?php

//Customer Products Function
function customer_information_function() {
    ob_start();
    if (is_user_logged_in()) {
        require_once WPORTAL__PLUGIN_DIR . './templates/customer_information-tpl.php';
    }else{
        echo '<h2>Please login to the panel to access your dashboard.</h2>';
    }
    return ob_get_clean();
}

?>