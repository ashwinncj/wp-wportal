<?php

//Plugin basic functions here

function plugin_styles() {
    wp_register_style('radel-css', WPORTAL__PLUGIN_URL . '/assets/css/radel-css.css', false, '1.1', 'all');
    wp_enqueue_style('radel-css');
}

add_action('wp_enqueue_scripts', 'plugin_styles');

require_once WPORTAL__PLUGIN_DIR . '/shortcodes.php';
