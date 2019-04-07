<?php
$user_id = get_current_user_id();
$user_meta = get_user_meta($user_id);
$first_name = get_user_meta($user_id, 'first_name', TRUE);
$last_name = get_user_meta($user_id, 'last_name', TRUE);
$user_email = get_user_meta($user_id, 'user_email', TRUE);
$address_line_1 = get_user_meta($user_id, 'address_line_1', TRUE);
$address_line_2 = get_user_meta($user_id, 'address_line_2', TRUE);
$city = get_user_meta($user_id, 'city', TRUE);
$state = get_user_meta($user_id, 'user_state', TRUE);
$zipcode = get_user_meta($user_id, 'zip_code', TRUE);
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
</style>
<div class="wrap">
    <div class="c100" style="background-color: #f0f0f0;padding: 15px;padding-left: 25px">
        <div style="font-size: 30px;"><?php echo $first_name . ' ' . $last_name; ?></div>
        <div style="font-size: 20px;"><?php echo $user_email; ?></div>
        <div style="font-size: 20px;"><?php echo $address_line_1; ?></div>
        <div style="font-size: 20px;"><?php echo $address_line_2; ?></div>
        <div style="font-size: 20px;"><?php echo $city . ', ' . $state . ', ' . $zipcode; ?></div>
    </div>
</div>