<style>
    .editproduct-form input{
        margin: 5px;
    }
    .editproduct-form input[type="text"]{
        width: 350px;
    }
</style>
<div class="wrap">
    <h1>Ecopure Warranty Portal</h1>
    <h2><?php echo $page_name; ?></h2>    
    <h4 class="vanish">
        <?php
        echo $error;
        $error = '';
        ?>
    </h4>
    <div class="editproduct-form">
        <form method="post" action="">
            <input type="text" name="upload_product" value="true" hidden>
            <input type="text" name="id" value="<?php echo $product_id; ?>" hidden>
            <input type="text" name="name" value="<?php echo $product_name; ?>" placeholder="Product Name"><br>
            <img id="product-image-preview" src="<?php echo $product_image == '' ? WPORTAL__PLUGIN_URL . '/assets/img/no-image-available.png' : $product_image; ?>" style="max-width: 350px;max-height: 250px;"><br>
            <button type="button" onclick="select_product_image();">Select Product Image</button><br>
            <input type="text" id="product-image" name="image" value="<?php echo $product_image; ?>" placeholder="Product Image" hidden><br>
            <select name="warranty_type">
                <option disabled selected>Select One</option>
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
            <select name="terms">
                <option disabled selected>Select One</option>
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