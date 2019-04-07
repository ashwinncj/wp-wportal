<?php ?>
<style>
    .c100{
        width: 100%;
        margin: auto;
        max-width: 1360px;
        vertical-align: top;
    }
    .c40{
        width: 38%;
        margin: auto;
        display: inline-block;
    }
    .c50{
        width: 47%;
        margin: auto;
        display: inline-block;
        vertical-align: top;
        float: left;
    }
    .c25{
        width: 23%;
        margin: auto;
        display: inline-block;
    }
    .record-information .info-title{
        font-weight: bold;
    }
    .record-information p{
        margin-bottom: 5px;
    }
    .record-information .product-title{
        font-weight: bold;
        font-size: 17px;
    }
    .simple-links{
        color: inherit;
    }
    .record-container{
        width: 400px;
        height: 225px;
        margin: 5px;
        box-shadow: 1px 0px 3px 1px grey;
        display: inline-block;
        transition: all 0.1s;
    }
    .record-container:hover{
        box-shadow: 1px 1px 8px 1px grey;
    }
    #ecopure-register-product-form select{
        width: 100%;
    }
    #ecopure-register-product-form{
        text-align: left;
    }
    #ecopure-register-product-form label{
        font-weight: bold;
    }
    #ecopure-register-product-form input[name="serial_number"]{
        text-transform: uppercase;
    }

</style>
<div class="wrap">
    <a href="#">Go Back</a>
    <div class="c100" style="text-align: center;">
        <?php
        foreach ($results as $item) {
            $warranty = '';
            $datediff = strtotime($item->expiry_date) - time();
            $timeleft = round($datediff / (60 * 60 * 24)) + 1;
            if ($timeleft > 30) {
                $warranty = '<span style="color:green;">In Warranty</span>';
            } elseif ($timeleft > 0 && $timeleft <= 30) {
                $warranty = '<span style="color:yellow;">Expiring Soon!</span>';
            } elseif ($timeleft == 0) {
                $warranty = '<span style="color:Orange;">Expiring Today!</span>';
            } elseif ($timeleft < 0) {
                $warranty = '<span style="color:Red;">Expired!</span>';
            }
            ?>
            <div class="c100" style="text-align: left;min-height: 300px">
                <div class="c50" style="background-image: url('<?php echo $item->product_image; ?>');background-size: cover;height: 300px;background-position: center"></div>
                <div class="c50" style="padding: 25px;height: 100%">
                    <span style="font-size: 28px;"><?php echo $item->product_name; ?></span><br>
                    <span style="font-size: 20px;">Warranty: <?php echo $warranty; ?></span><br>
                    <span style="font-size: 20px;">Expiration: <?php echo $item->expiry_date; ?></span><br>
                    <span style="font-size: 20px;">Purchase: <?php echo $item->purchase_date; ?></span><br>
                    <span style="font-size: 20px;">Install: <?php echo $item->install_date; ?></span><br>
                    <span style="font-size: 20px;">Serial: <?php echo $item->serial_number; ?></span><br>
                </div>
            </div>
            <br>
            <?php
            //Lifetime Extension Section
            if ($item->lifetime_warranty) {
                ?>
                <div class="c100">
                    <div class="c100" style="text-align: left;">
                        <span style="font-size: 24px">Additional warranty extension receipts.</span>
                        <br>
                        <button class="" style="cursor: pointer;color: #fff;border: none;padding: 10px;background-color: #00abee;">Add additional receipt</button><br>
                    </div>
                    <div class="c100">
                        <div class="c40">
                            <form id="ecopure-register-product-form" action="" method="POST" enctype="multipart/form-data">
                                <input type="text" value="true" name="register_additional_product" hidden required>
                                <input type="text" value="<?php echo $user_id; ?>" name="user_id" required hidden>
                                <input type="text" value="<?php echo $record_id; ?>" name="record_id" required hidden>
                                <label>Extension Product</label><br>
                                <select name="product" required>
                                    <option selected disabled value="">Select your product</option>
                                    <?php
                                    global $wpdb;
                                    $sql = "SELECT `id`, `name` FROM `wp_wportal_replacement_products` WHERE 1";
                                    $results = $wpdb->get_results($sql);
                                    foreach ($results as $rep_product) {
                                        echo "<option value='$rep_product->id'>$rep_product->name</option>";
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
                                <input type="submit" value="Update"><br>
                            </form>
                        </div>
                    </div>
                    <div class="record-container" style="">
                        <div class="c50" style="background-image: url('<?php echo $item->product_image; ?>');background-size: cover;height: 100%"></div>
                        <div class="c50 record-information" style="height: 100%;text-align: left;padding: 10px">
                            <div class="c100"><p><span class="product-title"><?php echo $item->product_name; ?></span></p></div>
                            <div class="c100"><p><span class="info-title">Purchase: </span><?php echo $item->purchase_date; ?></p></div>
                            <div class="c100"><p><span class="info-title">Serial: </span><?php echo $item->serial_number; ?></p></div>
                        </div>
                    </div>
                    <div style="width: 400px;height: 10px;margin: 5px;box-shadow: 0px 0px 0px 0px grey;display: inline-block;vertical-align: top;"></div>
                </div>             
                <?php
            }
            if ($item->five_year_warranty) {
                ?>
                <div class="c100">
                    Five Year
                </div>
                <?php
            }
        }
        ?>

    </div>
</div>