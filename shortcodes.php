<?php

//Shortcode registration here

add_shortcode('radel-login', 'login_function');
add_shortcode('radel-register', 'register_function');

// run it before the headers and cookies are sent
require_once WPORTAL__PLUGIN_DIR . './functions/register.php';
require_once WPORTAL__PLUGIN_DIR . './functions/login.php';
