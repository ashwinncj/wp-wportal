<?php

add_action('init', 'signon_function');

function signon_function() {
    if (isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['signon'])) {
        $creds = array();
        $creds['user_login'] = $_POST['user_email'];
        $creds['user_password'] = $_POST['user_password'];
        $creds['remember'] = FALSE;
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            echo $user->get_error_message();
        } else {
            wp_redirect(admin_url());
            exit();
        }
    } else {
        
    }
}

function login_function() {
    ob_start();
    if (is_user_logged_in()) {
        echo 'You are already Logged in! ' . '<a href=' . wp_logout_url(home_url()) . '>Logout</a> ';
    } else {
        require_once WPORTAL__PLUGIN_DIR . './templates/login-tpl.php';
    }
    return ob_get_clean();
}
