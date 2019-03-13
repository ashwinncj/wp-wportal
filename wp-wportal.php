<?php

/**
  Plugin Name: WP - WPortal
  Plugin URI:
  Description:
  Author: Ashwin Kumar C
  Version: 2.0
  Author URI: http://ma.tt/
 */
define('WPORTAL__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPORTAL__PLUGIN_URL', plugin_dir_url(__FILE__));
register_activation_hook(__FILE__, 'plugin_activation');
register_deactivation_hook(__FILE__, 'plugin_deactivation');

function plugin_activation() {
    //echo 'STage Activated';
    update_option('portal_activated', 'yes');
    add_role('radelcustomer','RADEL Customer',array('read'=>TRUE));
}

function plugin_deactivation() {
    //echo 'STage DeActivated';
    update_option('portal_activated', 'no');
}

require_once WPORTAL__PLUGIN_DIR . './admin.php';
require_once WPORTAL__PLUGIN_DIR . './functions.php';

//Removing admin bar
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
