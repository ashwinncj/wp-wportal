<?php

//Customer Products Function
function product_record_function() {
    ob_start();
    if (isset($_POST['register_additional_receipt'])) {
        if (!check_extension_exists()) {
            initiate_extension();
        }
    }
    if (isset($_GET['record']) && $_GET['record'] != '') {
        $user_id = get_current_user_id();
        $record_id = $_GET['record'];
        global $wpdb;
        $sql = "SELECT b.`name` AS product_name , b.`image` AS product_image,`receipt`,`lifetime_warranty`, `five_year_warranty`,`install_date`, `purchase_date`, `expiry_date`, `serial_number` FROM `wp_wportal_customer_records` a JOIN `wp_wportal_products` b ON a.product=b.id WHERE `user_id`='$user_id' AND a.`id`='$record_id' ORDER BY purchase_date DESC";
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

function check_extension_exists() {
    global $wpdb;
    $user_id = $_POST['user_id'];
    $nonce = $_POST['nonce'];
    $sql = "SELECT `id` FROM `wp_wportal_extension_receipts` WHERE `user_id`='$user_id' AND `nonce`='$nonce'";
    $wpdb->get_results($sql);
    if ($wpdb->num_rows >= 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function initiate_extension() {
    $_POST['purchase_receipt'] = upload_files($_FILES['purchase_receipt']);
    if (!$_POST['purchase_receipt']) {
        echo "The purchase receipt seems to be invalid format or too large(above 5Mb).";
    } else {
        register_additional_receipt($_POST);
    }
}

function register_additional_receipt($vars) {
    global $wpdb;
    $user_id = $vars['user_id'];
    $record_id = $vars['record_id'];
    $purchase_date = $vars['purchase_date'];
    $receipt = $vars['purchase_receipt'];
    $packages = $vars['packages'];
    $nonce = $vars['nonce'];
    $added_on = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `wp_wportal_extension_receipts` (`user_id`,`record_id`, `purchase_date`,`receipt`,`nonce`, `packages`, `added_on`) VALUES ("
            . "'$user_id','$record_id','$purchase_date','$receipt','$nonce','$packages','$added_on')";
    $results = $wpdb->get_results($sql);
    calculate_expiry_date($record_id);
}

function calculate_expiry_date($record_id) {
    global $wpdb;
    $sql = "SELECT `purchase_date`, `period`,`five_year_warranty` FROM `wp_wportal_warranty` a JOIN `wp_wportal_products` b ON a.`id`=b.`warranty_type` JOIN `wp_wportal_customer_records` c ON b.`id`= c.`product` WHERE c.`id`='$record_id'";
    $result = $wpdb->get_row($sql);
    $original_purchase_date = $result->purchase_date;
    $initial_warranty = $result->period;
    $five_year = $result->five_year_warranty;
    $original_date = DateTime::createFromFormat("Y-m-d", $original_purchase_date);
    $temp_original = DateTime::createFromFormat("Y-m-d", $original_purchase_date);
    $expiry_tracking = $temp_original->add(new DateInterval("P" . $initial_warranty . "M"));
    $sql = "SELECT `packages`,`purchase_date` FROM `wp_wportal_extension_receipts` WHERE `record_id`='$record_id'";
    $result = $wpdb->get_results($sql);
    foreach ($result as $item) {
        $replacement_purchase = new DateTime($item->purchase_date);
        $interval = $replacement_purchase->diff($expiry_tracking);
        if ($interval->days < 365) {
            $expiry_tracking = $expiry_tracking->add(new DateInterval("P" . $item->packages * 3 . "M"));
        }
    }
    if ($five_year) {
        $total_years = $expiry_tracking->diff($original_date);
        if ($total_years->days > (365 * 6)) {
            $expiry_tracking = $original_date->add(new DateInterval("P" . 12 * 6 . "M"));
        }
    }
    $expiry_date = $expiry_tracking->format('Y-m-d');
    $sql = "UPDATE `wp_wportal_customer_records` SET `expiry_date`='$expiry_date' WHERE `id`='$record_id'";
    $result = $wpdb->get_results($sql);
}

?>