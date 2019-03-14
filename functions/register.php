<?php

function register_function() {
    ob_start();
    if (is_user_logged_in()) {
        echo 'You are already Logged in! ' . '<a href=' . wp_logout_url(home_url()) . '>Logout</a> ';
    } else {
        if (isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_mobile']) && isset($_POST['register'])) {
            $username = uniqid('radel-user');
            $user_id = username_exists($username);
            if (!$user_id and email_exists($_POST['user_email']) == false) {

                $userdata = array(
                    'user_email' => $_POST['user_email'],
                    'user_login' => $username,
                    'user_pass' => $_POST['user_password'],
                    'role' => 'radelcustomer',
                    'first_name' => $_POST['full_name'],
                    'display_name' => $_POST['full_name'],
                );
                $user_id = wp_insert_user($userdata);
                update_user_meta($user_id, 'user_mobie', $_POST['user_mobile']);
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
