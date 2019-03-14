<?php
//Admin section functions included here

add_action('admin_menu', 'wportal_menus');

function wportal_menus() {
    add_menu_page('Warranty Portal Dashboard', 'Warranty Portal', 'manage_options', 'warrany_portal_dashboard', 'dashboard_function', '', '100');
    add_submenu_page('warrany_portal_dashboard', 'Warranty Products', 'Products', 'manage_options', 'warranty_portal_products', 'products_function');
}

function dashboard_function() {
    ?>
    <div class="wrap">
        <h1>Warranty Portal</h1>
        <?php
        $content = get_option('special_content');
        wp_editor($content, 'editor-id', $settings = array('textarea_rows' => '10'));
        submit_button('Save', 'primary');
        ?>
    </div>
    <?php
}

function products_function() {
    ?>
    <div class="wrap">
        <button onclick="open_media_uploader_multiple_images();">Media</button>
    </div>
    
    <?php
}
