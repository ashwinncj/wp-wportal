<style>
    .editproduct-form input{
        margin: 5px;
    }
    .editproduct-form input[type="text"]{
        width: 350px;
    }
</style>
<div class="wrap">
    <h1>Ecopure Warranty Portal <span class="portal-title"> >> <?php echo $page_name; ?></span>    </h1>
    <hr>
    <h4 class="vanish">
        <?php
        echo $error;
        $error = '';
        ?>
    </h4>
    <div class="edit-form">
        <form method="post" action="">
            <input required type="text" name="upload_product" value="true" hidden>
            <input type="text" name="id" value="<?php echo $product_id; ?>" hidden>
            <label>Product Name</label><br>
            <input required type="text" name="name" value="<?php echo $product_name; ?>" placeholder="Product Name"><br>
            <label>Featured Image</label><br>
            <img id="product-image-preview" src="<?php echo $product_image == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $product_image; ?>" style="max-width: 350px;max-height: 250px;"><br>
            <button type="button" onclick="select_product_image();">Select Product Image</button><br>
            <input required type="text" id="product-image" name="image" value="<?php echo $product_image; ?>" placeholder="Product Image" hidden><br>
            <label>Warranty Type</label><br>
            <select required name="warranty_type">
                <option value="" disabled selected>Select Warranty</option>
                <?php
                foreach ($warranty_list as $warranty_item) {
                    ?>
                    <option value="<?php
                    echo $warranty_item->id;
                    ?>"
                            <?php
                            echo $product_warranty_type == $warranty_item->id ? 'selected' : '';
                            ?>>
                                <?php echo $warranty_item->name; ?>
                    </option>
                    <?php
                }
                ?>
            </select><br>
            <label>Terms and Conditions</label><br>
            <select required name="terms">
                <option value="" disabled selected>Select Terms and Conditions</option>
                <?php
                foreach ($terms_list as $term_item) {
                    ?>
                    <option value="<?php
                    echo $term_item->id;
                    ?>"
                            <?php
                            echo $product_terms == $term_item->id ? 'selected' : '';
                            ?>>
                                <?php echo $term_item->name; ?>
                    </option>
                    <?php
                }
                ?>
            </select><br>
            <input type="checkbox" value="1" <?php echo $product_lifetime_warranty; ?> name="lifetime_warranty"><label>Lifetime Warranty</label><br>
            <input type="checkbox" value="1" <?php echo $product_five_year_warranty; ?> name="five_year_warranty"><label>Five years Warranty</label><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <?php if ($product != 'new') { ?>
        <div>
            <hr>
            <h3>To delete the product please click below.</h3>
            <a href="<?php echo admin_url("admin.php?page=wportal_delete&item=product&id=$product_id&name=$product_name"); ?>"><button>Delete this product</button></a>
        </div>
    <?php } ?>
</div>
<script>
    function select_product_image() {
        open_media_uploader_image();
        jQuery(document).ready(function ($) {
            media_uploader.on("insert", function () {
                var json = media_uploader.state().get("selection").first().toJSON();

                var image_url = json.url;
                var image_caption = json.caption;
                var image_title = json.title;
                //console.log(image_url);
                media = {
                    url: image_url,
                    caption: image_caption,
                    title: image_title
                };
                $('#product-image').val(media.url);
                $('#product-image-preview').attr('src', media.url);
            });

        });
    }
</script>