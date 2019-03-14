<?php
//Plugin basic functions here

require_once WPORTAL__PLUGIN_DIR . '/shortcodes.php';
add_action('wp_enqueue_scripts', 'plugin_styles');

function plugin_styles() {
    wp_register_style('radel-css', WPORTAL__PLUGIN_URL . '/assets/css/radel-css.css', false, '1.1', 'all');
    wp_enqueue_style('radel-css');
}

function plugin_activation() {
    update_option('portal_activated', 'yes');
    add_role('radelcustomer', 'RADEL Customer', array('read' => TRUE));
    add_role('csr', 'RADEL CSR', array('read' => TRUE));
    $role = get_role('csr');
    $role->add_cap('edit_radelcustomer');
    $role = get_role('administrator');
    $role->add_cap('edit_radelcustomer');
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
    if (in_array('csr', (array) $user->roles) || in_array('radelcustomer', (array) $user->roles)) {
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
