<?php
$user_id = get_current_user_id();
global $wpdb;
$sql = "SELECT b.`name` AS product_name , b.`image` AS product_image, `purchase_date`, `expiry_date`, `serial_number`,a.id as record_id FROM `wp_wportal_customer_records` a JOIN `wp_wportal_products` b ON a.product=b.id WHERE `user_id`='$user_id' ORDER BY purchase_date DESC";
$results = $wpdb->get_results($sql);
?>
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
        width: 450px;
        height: 250px;
        margin: 5px;
        box-shadow: 1px 0px 3px 1px grey;
        display: inline-block;
        transition: all 0.1s;
    }
    .record-container:hover{
        box-shadow: 1px 1px 8px 1px grey;
    }
</style>
<div class="wrap">
    <div class="c100" style="text-align: left;">
        <a href="#ecopure-register-product" data-lity><button style="margin-bottom: 15px;cursor: pointer;color: #fff;border: none;padding: 10px;background-color: #00abee;width: 200px;text-transform: uppercase">Register your product</button></a><br>
    </div>
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
            <a class="simple-links" href="<?php echo site_url() . '/record/?record=' . $item->record_id; ?>">
                <div class="record-container" style="">
                    <div class="c50" style="background-image: url('<?php echo $item->product_image; ?>');background-size: contain;background-repeat: no-repeat;background-position: center;height: 100%"></div>
                    <div class="c50 record-information" style="height: 100%;text-align: left;padding: 10px">
                        <div class="c100"><p><span class="product-title"><?php echo $item->product_name; ?></span></p></div>
                        <div class="c100"><p><span class="info-title">In Warranty: </span><?php echo $warranty; ?></p></div>
                        <div class="c100"><p><span class="info-title">Expiration: </span><?php echo $item->expiry_date; ?></p></div>
                        <div class="c100"><p><span class="info-title">Purchase: </span><?php echo $item->purchase_date; ?></p></div>
                        <div class="c100"><p><span class="info-title">Serial: </span><?php echo $item->serial_number; ?></p></div>

                    </div>
                </div>
            </a>
            <?php
        }
        ?>
        <div style="width: 450px;height: 10px;margin: 5px;box-shadow: 0px 0px 0px 0px grey;display: inline-block;vertical-align: top;"></div>
    </div>
</div>