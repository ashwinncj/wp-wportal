<!--//Login form template-->

<div class="wrap">
    <h3>Login to the site to continue.</h3>
    <form action="" method="POST">
        <input type="email" required name="user_email" placeholder="Your Email">
        <input type="password" required name="user_password" placeholder="Your Password">
        <input type="submit">
    </form>
</div>
//<?php
//function login_function_backup() {
//    ob_start();
//    ?>
<!--    <style>

    </style>
    <div class="wrap">
        <form>
            <div class="radel-text-input">
                <input class="radel-input" id="user_email" name="user_email" type="email">
                <label><span class="prop_mandatory">* </span>Email</label>
            </div>
            <div class="radel-text-input">
                <input type="text" name="built_area">
                <label><span class="prop_mandatory">* </span>Built Up Area</label>
            </div>
        </form>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $('.radel-text-input input').change(function () {
                if ($(this).val() !== '') {
                    $(this).next().addClass('rdl-up');
                    $(this).next().css('top', '-50px');
                } else {
                    $(this).next().removeClass('rdl-up');
                    $(this).next().css('top', '');
                }
            });
            $('.radel-text-input label').click(function () {
                $(this).prev().focus();
            });
        });
    </script>-->
    //<?php
//    return ob_get_clean();
//}
