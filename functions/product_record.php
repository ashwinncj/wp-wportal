<?php

//Customer Products Function
function product_record_function() {
    ob_start();
    if (isset($_GET['record']) && $_GET['record'] != '') {
        $user_id = get_current_user_id();
        $record_id = $_GET['record'];
        global $wpdb;
        $sql = "SELECT b.`name` AS product_name , b.`image` AS product_image,`lifetime_warranty`, `five_year_warranty`,`install_date`, `purchase_date`, `expiry_date`, `serial_number` FROM `wp_wportal_customer_records` a JOIN `wp_wportal_products` b ON a.product=b.id WHERE `user_id`='$user_id' AND a.`id`='$record_id' ORDER BY purchase_date DESC";
        $results = $wpdb->get_results($sql);
        if ($wpdb->num_rows > 0) {
            require_once WPORTAL__PLUGIN_DIR . './templates/product_record-tpl.php';
        } else {
            echo "You seem to be lost. Try going back to home page.";
        }
    } else {
        echo "You seem to be lost. Try going back to home page.";
    }
    return ob_get_clean();
}

?>