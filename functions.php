<?php
//Plugin basic functions here

require_once WPORTAL__PLUGIN_DIR . '/shortcodes.php';
add_action('wp_enqueue_scripts', 'plugin_styles');
add_action('admin_enqueue_scripts', 'plugin_styles');

function plugin_styles() {
    wp_register_style('radel-css', WPORTAL__PLUGIN_URL . '/assets/css/radel-css.css', false, '1.1', 'all');
    wp_register_script('media-uploader', WPORTAL__PLUGIN_URL . '/assets/js/media-uploader.js', false, '1.1', 'all');
    wp_register_script('radel-js', WPORTAL__PLUGIN_URL . '/assets/js/radel-js.js', false, '1.1', 'all');
    wp_register_script('datatables-js', WPORTAL__PLUGIN_URL . '/assets/js/datatables.min.js', false, '1.1', 'all');
    wp_register_style('datatables-css', WPORTAL__PLUGIN_URL . '/assets/css/datatables.min.css', false, '1.1', 'all');
    wp_register_style('lity-css', WPORTAL__PLUGIN_URL . '/assets/css/lity.min.css', false, '1.1', 'all');
    wp_register_script('lity-js', WPORTAL__PLUGIN_URL . '/assets/js/lity.min.js', false, '1.1', 'all');
    wp_enqueue_style('radel-css');
    wp_enqueue_style('lity-css');
    wp_enqueue_script('media-uploader');
    wp_enqueue_script('lity-js');
    wp_enqueue_script('radel-js');
    wp_enqueue_media();
}

function plugin_activation() {
    update_option('portal_activated', 'yes');
    add_role('ecopurecustomer', 'Ecopure Customer', array('read' => TRUE));
    add_role('csr', 'Ecopure CSR', array('read' => TRUE));
    $role = get_role('csr');
    $role->add_cap('edit_ecopurecustomer');
    $role = get_role('administrator');
    $role->add_cap('edit_ecopurecustomer');
    create_database();
    create_directories();
    create_files();
}

function create_database() {
    global $wpdb;
    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_products` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `image` VARCHAR(200) NOT NULL , `warranty_type` VARCHAR(10) NOT NULL , `terms` VARCHAR(10) NOT NULL , `lifetime_warranty` BOOLEAN NOT NULL DEFAULT FALSE , `five_year_warranty` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $results = $wpdb->get_results($sql);
    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_replacement_products` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `image` VARCHAR(200) NOT NULL , `warranty_type` VARCHAR(10) NOT NULL , `terms` VARCHAR(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $results = $wpdb->get_results($sql);
    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_warranty` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `period` INT(15) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $results = $wpdb->get_results($sql);
    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_terms` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `document` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $results = $wpdb->get_results($sql);
    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_customer_records` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` VARCHAR(20) NOT NULL , `product` INT(10) NOT NULL , `purchase_date` DATE NOT NULL , `install_date` DATE NOT NULL , `expiry_date` DATE NOT NULL , `serial_number` VARCHAR(100) NOT NULL , `receipt` VARCHAR(200) NOT NULL , `added_on` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $results = $wpdb->get_results($sql);
//    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_extension_records` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` VARCHAR(20) NOT NULL ,`record_id` INT(10) NOT NULL, `product` INT(10) NOT NULL , `purchase_date` DATE NOT NULL , `install_date` DATE NOT NULL , `serial_number` VARCHAR(100) NOT NULL , `receipt` VARCHAR(200) NOT NULL , `added_on` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
//    $results = $wpdb->get_results($sql);
    $sql = 'CREATE TABLE IF NOT EXISTS `wp_wportal_extension_receipts` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` VARCHAR(20) NOT NULL ,`record_id` INT(10) NOT NULL, `purchase_date` DATE NOT NULL , `receipt` VARCHAR(200) NOT NULL ,`nonce` VARCHAR(20) NOT NULL, `packages` INT(10) NOT NULL, `added_on` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;';
    $results = $wpdb->get_results($sql);
}

function create_directories() {
    if (!file_exists(WPORTAL__PRIVATE_DIR)) {
        mkdir(WPORTAL__PRIVATE_DIR);
    }
}

function create_files() {
    $myfile = fopen(WPORTAL__PRIVATE_DIR . "/.htaccess", "w");
    $txt = "order deny,allow\n";
    fwrite($myfile, $txt);
    $txt = "deny from all\n";
    fwrite($myfile, $txt);
    $txt = "allow from localhost ::1\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}

function plugin_deactivation() {
    update_option('portal_activated', 'no');
}

//Removing admin bar
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

//No admin access to customer and CSR
add_action('admin_init', 'no_admin_access', 100);

function no_admin_access() {
    $user = wp_get_current_user();
    if (in_array('csr', (array) $user->roles) || in_array('ecopurecustomer', (array) $user->roles)) {
        wp_redirect(home_url());
        exit();
    }
}

//RADEL Upload files code

add_shortcode('radel-media', 'radel_media_upload');

function radel_media_upload() {
    ob_start();
    ?>
    <form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
        <input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
        <input type="hidden" name="post_id" id="post_id" value="" />
        <?php wp_nonce_field('my_image_upload', 'my_image_upload_nonce'); ?>
        <input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Upload" />
    </form>
    <?php
// Check that the nonce is valid, and the user can edit this post.
    if (isset($_POST['my_image_upload_nonce'], $_POST['post_id']) && wp_verify_nonce($_POST['my_image_upload_nonce'], 'my_image_upload') && current_user_can('edit_post', $_POST['post_id'])) {
        // The nonce was valid and the user has the capabilities, it is safe to continue.
        // These files need to be included as dependencies when on the front end.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        // Let WordPress handle the upload.
        // Remember, 'my_image_upload' is the name of our file input in our form above.
        $attachment_id = media_handle_upload('my_image_upload', $_POST['post_id']);
        echo wp_get_attachment_url($attachment_id);
        if (is_wp_error($attachment_id)) {

            echo 'Some error happened!';
            // There was an error uploading the image.
        } else {
            // The image was uploaded successfully!
        }
    } else {
        // The security check failed, maybe show the user an error.
    }
    return ob_get_clean();
}

//Automatic redirect to loginpage
function my_page_template_redirect() {
    if (!is_page('login') && !is_user_logged_in()) {
        wp_redirect(home_url('/login/'));
        die;
    }
}

//add_action('template_redirect', 'my_page_template_redirect');
