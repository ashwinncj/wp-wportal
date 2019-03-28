<?php
global $wpdb;
$sql = 'SELECT `id`,`name` FROM `wp_wportal_products` WHERE 1;';
$results = $wpdb->get_results($sql);
$user_id = get_current_user_id();
?>
<style>
    .c100{
        width: 100%;
        margin: auto;
        max-width: 1360px;
    }
    .c40{
        width: 38%;
        margin: auto;
        display: inline-block;
    }
    .c25{
        width: 23%;
        margin: auto;
        display: inline-block;
    }
    #ecopure-register-product-form select{
        width: 100%;
    }
    #ecopure-register-product-form label{
        font-weight: bold;
    }
    #ecopure-register-product-form input[name="serial_number"]{
        text-transform: uppercase;
    }

</style>
<div class="wrap">
    <div class="c100">
        <form id="ecopure-register-product-form" action="" method="POST" enctype="multipart/form-data">
            <input type="text" value="true" name="register_new_product" hidden required>
            <input type="text" value="<?php echo $user_id; ?>" name="user_id" required hidden>
            <label>Product</label><br>
            <select name="product" required>
                <option selected disabled value="">Select your product</option>
                <?php
                foreach ($results as $product) {
                    echo "<option value='$product->id'>$product->name</option>";
                }
                ?>
            </select><br>
            <label>Purchase Date</label><br>
            <input type="date" name="purchase_date" required><br>
            <label>Install Date</label><br>
            <input type="date" name="install_date" required><br>
            <label>Serial Number</label><br>
            <input type="text" name="serial_number" required><br>
            <label>Purchase Receipt</label><br>
            <input type="file" multiple="false" name="purchase_receipt" required><br>
            <input type="submit" value="Register"><br>
        </form>
    </div>
</div>