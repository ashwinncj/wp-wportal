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
            <input type="text" name="upload_warranty" value="true" hidden>
            <input type="text" name="id" value="<?php echo $warranty_id; ?>" hidden>
            <label>Warranty Name</label><br>
            <input type="text" name="name" value="<?php echo $warranty_name; ?>" placeholder="Warranty Name"><br>
            <label>Period</label><br>
            <input type="text" name="period" value="<?php echo $warranty_period; ?>" placeholder="Period"><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <?php if ($warranty != 'new') { ?>
        <div>
            <hr>
            <h3>To delete the product please click below.</h3>
            <a href="<?php echo admin_url("admin.php?page=wportal_delete&item=warranty&id=$warranty_id&name=$warranty_name"); ?>"><button>Delete this Warranty</button></a>
        </div>
    <?php } ?>
</div>