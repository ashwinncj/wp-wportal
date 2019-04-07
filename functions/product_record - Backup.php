<?php

//Customer Products Function
function product_record_function() {
    ob_start();
    if (isset($_POST['register_additional_product'])) {
        if (!check_if_extension_record_exists($_POST)) {
            $_POST['purchase_receipt'] = upload_files($_FILES['purchase_receipt']);
            if (!$_POST['purchase_receipt']) {
                echo "The purchase receipt seems to be invalid format or too large(above 5Mb).";
            } else {
                register_additional_product($_POST);
            }
        } else {
            echo 'Seems like your the serial number already exists on your account. Please check the infomation.';
        }
    }
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

function register_additional_product($vars) {
    global $wpdb;
    $user_id = $vars['user_id'];
    $record_id = $vars['record_id'];
    $product = $vars['product'];
    $purchase_date = $vars['purchase_date'];
    $install_date = $vars['install_date'];

    $serial_number = strtoupper($vars['serial_number']);
    $receipt = $vars['purchase_receipt'];
    $added_on = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `wp_wportal_extension_records`(`user_id`,`record_id`, `product`, `purchase_date`, `install_date`, `serial_number`, `receipt`, `added_on`) VALUES ("
            . "'$user_id','$record_id','$product','$purchase_date','$install_date','$serial_number','$receipt','$added_on')";
    $results = $wpdb->get_results($sql);
    calculate_expiry_date($record_id);
}

function check_if_extension_record_exists($vars) {
    global $wpdb;
    $user_id = $vars['user_id'];
    $serial_number = strtoupper($vars['serial_number']);
    $sql = "SELECT `id` FROM `wp_wportal_extension_records` WHERE `user_id`='$user_id' AND `serial_number`='$serial_number'";
    $wpdb->get_results($sql);
    if ($wpdb->num_rows >= 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function calculate_expiry_date($record_id) {
    global $wpdb;
    $sql = "SELECT `period` FROM `wp_wportal_warranty` a JOIN `wp_wportal_products` b ON a.`id`=b.`warranty_type` JOIN `wp_wportal_customer_records` c ON b.`id`= c.`product` WHERE c.`id`='$record_id'";
    $result = $wpdb->get_row($sql);
    $period[] = $result->period;
    $sql = "SELECT `period` FROM `wp_wportal_warranty` a JOIN `wp_wportal_replacement_products` b ON a.`id`=b.`warranty_type` JOIN `wp_wportal_extension_records` c ON b.`id`= c.`product` WHERE c.`record_id`='$record_id'";
    $result = $wpdb->get_results($sql);
    foreach ($result as $item) {
        $period[] = $item->period;
    }
    $total_expiry_months = 0;
    foreach ($period as $item) {
        $total_expiry_months = $item + $total_expiry_months;
    }
    $sql = "SELECT `purchase_date` FROM `wp_wportal_customer_records` WHERE `id`='$record_id'";
    $result = $wpdb->get_row($sql);
    $original_purchase_date = $result->purchase_date;
    $temp_original = DateTime::createFromFormat("Y-m-d", $original_purchase_date);
    $new_expiry_date = $temp_original->add(new DateInterval("P" . $total_expiry_months . "M"));
    $new_expiry_date = $new_expiry_date->format('Y-m-d');
    $sql = "UPDATE `wp_wportal_customer_records` SET `expiry_date`='$new_expiry_date' WHERE `id`=$record_id";
    $result = $wpdb->get_results($sql);
}

?>