<?php

function register_function() {
    ob_start();
    if (is_user_logged_in()) {
        $user_meta = (get_user_meta(get_current_user_id()));
        echo 'You are already Logged in! ' . '<a href=' . wp_logout_url(home_url()) . '>Logout</a> ';
    } else {
        if (isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_phone']) && isset($_POST['register'])) {
            $username = uniqid('ecopure-user');
            $user_id = username_exists($username);
            if (!$user_id and email_exists($_POST['user_email']) == false) {
                $userdata = array(
                    'user_email' => $_POST['user_email'],
                    'user_login' => $username,
                    'user_pass' => $_POST['user_password'],
                    'role' => 'ecopurecustomer',
                    'first_name' => isset($_POST['first_name']) ? $_POST['first_name'] : '',
                    'last_name' => isset($_POST['last_name']) ? $_POST['last_name'] : '',
                    'display_name' => isset($_POST['first_name']) ? $_POST['first_name'] : '',
                );
                $user_id = wp_insert_user($userdata);
                $metas = array(
                    'user_email' => $_POST['user_email'],
                    'user_phone' => isset($_POST['user_phone']) ? $_POST['user_phone'] : '',
                    'address_line_1' => isset($_POST['address_line_1']) ? $_POST['address_line_1'] : '',
                    'address_line_2' => isset($_POST['address_line_2']) ? $_POST['address_line_2'] : '',
                    'city' => isset($_POST['city']) ? $_POST['city'] : '',
                    'user_state' => isset($_POST['user_state']) ? $_POST['user_state'] : '',
                    'zip_code' => isset($_POST['zip_code']) ? $_POST['zip_code'] : ''
                );

                foreach ($metas as $key => $value) {
                    update_user_meta($user_id, $key, $value);
                }
                wp_redirect(site_url() . '/dashboard');

                echo 'User Successfully Registered.';
                //print_r(get_user_meta($user_id));
            } else {
                $random_password = __('User already exists.  Password inherited.');
                echo 'User Email Exists';
            }
        } else {
            require_once WPORTAL__PLUGIN_DIR . './templates/register-tpl.php';
        }
    }
    return ob_get_clean();
}
