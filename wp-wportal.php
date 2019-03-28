<?php

/**
  Plugin Name: Ecopure Warranty Portal
  Plugin URI:
  Description:
  Author: Ashwin Kumar C
  Version: 2.0
  Author URI: http://ashwininstitute.com/
 */
define('WPORTAL__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPORTAL__PLUGIN_URL', plugin_dir_url(__FILE__));
define('WPORTAL__PRIVATE_DIR', wp_get_upload_dir()['basedir'] . '/ecopureprivate');
define('WPORTAL__PRIVATE_URL', wp_get_upload_dir()['baseurl'] . '/ecopureprivate');
register_activation_hook(__FILE__, 'plugin_activation');
register_deactivation_hook(__FILE__, 'plugin_deactivation');

require_once WPORTAL__PLUGIN_DIR . './admin.php';
require_once WPORTAL__PLUGIN_DIR . './functions.php';
