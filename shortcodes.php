<?php

//Shortcode registration here

add_shortcode('radel-login', 'login_function');
add_shortcode('radel-register', 'register_function');
add_shortcode('radel-test', 'test_function');

function login_function() {
    ob_start();
    echo is_user_logged_in() ? 'You are already Logged in!' : FALSE;
    if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
        $creds = array();
        $creds['user_login'] = $_POST['user_email'];
        $creds['user_password'] = $_POST['user_password'];
        $creds['remember'] = FALSE;
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            echo $user->get_error_message();
        }
    } else {
        require_once WPORTAL__PLUGIN_DIR . './templates/login-tpl.php';
    }
    return ob_get_clean();
}

function register_function() {
    ob_start();
    echo is_user_logged_in() ? 'You are already Logged in!' : FALSE;
    if (isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_mobile'])) {
        $username = uniqid('radel-user');
        $user_id = username_exists($username);
        if (!$user_id and email_exists($_POST['user_email']) == false) {
            $user_id = wp_create_user($username, $_POST['user_password'], $_POST['user_email']);
            echo 'User Successfully Registered.';
            wp_logout();
        } else {
            $random_password = __('User already exists.  Password inherited.');
            echo 'User Email Exists';
        }
    } else {
        require_once WPORTAL__PLUGIN_DIR . './templates/register-tpl.php';
    }
    return ob_get_clean();
}

function test_function() {
    ob_start();
    ?>
    <style>
        .demand-stying{
            width: 30%;background-color: blue;height: 200px;border: 1px solid white;display: inline-block;
        }
        @media(max-width:567px){
            .demand-stying{
                width: 48%;background-color: blue;height: 200px;border: 1px solid white;display: inline-block;
            }
        }
    </style>
    <div class="wrap">
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
        <div class="demand-stying"></div>
    </div>
    <?php

    return ob_get_clean();
}
