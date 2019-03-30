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
            <input type="text" name="upload_terms" value="true" hidden>
            <input type="text" name="id" value="<?php echo $terms_id; ?>" hidden>
            <label>Terms and Conditions Name</label><br>
            <input type="text" name="name" value="<?php echo $terms_name; ?>" placeholder="Terms and Conditions Name"><br>            
            <input type="text" id="terms-document" name="document" value="<?php echo $terms_document; ?>" placeholder="Document" hidden>
            <label>Document</label><br>
            <button type="button" onclick="select_terms_document();">Select the document</button>
            <a target="blank" id="terms-document-link" href="<?php echo $terms_document; ?>"><?php echo $terms_document == '' ? '*No Document Selected' : $terms_document; ?></a><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <?php if ($terms != 'new') { ?>
        <div>
            <hr>
            <h3>To delete the product please click below.</h3>
            <a href="<?php echo admin_url("admin.php?page=wportal_delete&item=terms&id=$terms_id&name=$terms_name"); ?>"><button>Delete this T&C</button></a>
        </div>
    <?php } ?>
</div>
<script>
    function select_terms_document() {
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
                $('#terms-document').val(media.url);
                $('#terms-document-link').html(media.title);
                $('#terms-document-link').attr('href', media.url);
            });

        });
    }
</script>
