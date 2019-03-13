<?php

//Shortcode registration here

add_shortcode('radel-login', 'login_function');
add_shortcode('radel-register', 'register_function');
add_shortcode('radel-test', 'test_function');

// run it before the headers and cookies are sent

function login_function() {
    ob_start();
    if (is_user_logged_in()) {
        echo 'You are already Logged in! ' . '<a href=' . wp_logout_url(home_url()) . '>Logout</a> ';
    } else {
        require_once WPORTAL__PLUGIN_DIR . './templates/login-tpl.php';
    }
    return ob_get_clean();
}

function register_function() {
    ob_start();
    if (is_user_logged_in()) {
        echo 'You are already Logged in! ' . '<a href=' . wp_logout_url(home_url()) . '>Logout</a> ';
    } else {
        if (isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_mobile']) && isset($_POST['register'])) {
            $username = uniqid('radel-user');
            $user_id = username_exists($username);
            if (!$user_id and email_exists($_POST['user_email']) == false) {
                $user_id = wp_create_user($username, $_POST['user_password'], $_POST['user_email']);
                echo 'User Successfully Registered.';
                //wp_logout();
                $u = new WP_User($user_id);
                $u->set_role('radelcustomer');
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

function test_function() {
    wp_safe_redirect(admin_url());
    exit();
    ob_start();
    ?>
    <style>
        .demand-stying{
            width: 30%;background-color: blue;height: 200px;border: 1px solid white;display: inline-block;
        }
        @media(max-width:567px){
            .demand-sm-6{
                width: 48%;background-color: blue;height: 200px;border: 1px solid white;display: inline-block;
            }
        }
    </style>
    <div class="wrap">
        <div class="demand-sm-6 demand-stying"></div>
        <div class="demand-sm-6 demand-stying"></div>
    </div>
    <?php

    return ob_get_clean();
}
