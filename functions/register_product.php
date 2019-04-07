<?php

//Customer Portal Function
function register_product_function() {
    ob_start();
    if (isset($_POST['register_new_product'])) {
        if (!check_if_record_exists($_POST)) {
            $_POST['purchase_receipt'] = upload_files($_FILES['purchase_receipt']);
            if (!$_POST['purchase_receipt']) {
                echo "The purchase receipt seems to be invalid format or too large(above 5Mb).";
            } else {
                register_customer_product($_POST);
                show_registration_form();
            }
        } else {
            echo 'Seems like your the serial number already exists on your account. Please check the infomation.';
            show_registration_form();
        }
    } else {
        show_registration_form();
    }
    return ob_get_clean();
}

function show_registration_form() {
    require_once WPORTAL__PLUGIN_DIR . './templates/register_product-tpl.php';
}

function check_if_record_exists($vars) {
    global $wpdb;
    $user_id = $vars['user_id'];
    $serial_number = strtoupper($vars['serial_number']);
    $sql = "SELECT `id` FROM `wp_wportal_customer_records` WHERE `user_id`='$user_id' AND `serial_number`='$serial_number'";
    $wpdb->get_results($sql);
    if ($wpdb->num_rows >= 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function register_customer_product($vars) {
    global $wpdb;
    $user_id = $vars['user_id'];
    $product = $vars['product'];
    $purchase_date = $vars['purchase_date'];
    $install_date = $vars['install_date'];

    //Getting warranty period
    $sql = "SELECT `period` FROM `wp_wportal_warranty` a JOIN `wp_wportal_products` b ON a.`id`=b.`warranty_type` WHERE b.`id`='$product'";
    $result = $wpdb->get_row($sql);
    $period = $result->period;
    //Calculating Warranty period here.
    $expiry_date = date('Y-m-d', strtotime("+$period months"));
    $serial_number = strtoupper($vars['serial_number']);
    $receipt = $vars['purchase_receipt'];
    $added_on = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `wp_wportal_customer_records`(`user_id`, `product`, `purchase_date`, `install_date`, `expiry_date`, `serial_number`, `receipt`, `added_on`)"
            . " VALUES ('$user_id','$product','$purchase_date','$install_date','$expiry_date','$serial_number','$receipt','$added_on')";
    $results = $wpdb->get_results($sql);
}

function upload_files($inputfile) {
    $target_dir = WPORTAL__PRIVATE_DIR . '/';
    $prefix = uniqid('ecopure-registration-');
    $target_file = $target_dir . $prefix . basename($inputfile["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return FALSE;
    }
    $check = getimagesize($inputfile["tmp_name"]);
    if ($check == FALSE) {
        return FALSE;
    }
    if ($inputfile["size"] > 5000000) {
        return FALSE;
    }
    if (move_uploaded_file($inputfile["tmp_name"], $target_file)) {
        return WPORTAL__PRIVATE_URL . '/' . $prefix . basename($inputfile["name"]);
    } else {
        return FALSE;
    }
}

?>