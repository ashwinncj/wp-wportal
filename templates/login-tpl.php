<!--//Login form template-->
<style>
    #radel-login-form input,#radel-login-form select{
        width: 100%;
    }
</style>
<div class="wrap">
    <form id="radel-login-form" action="" method="POST">
        <label>Email*</label><br>
        <input type="email" required name="user_email" placeholder="Your Email"><br>
        <label>Password*</label><br>
        <input type="password" required name="user_password" placeholder="Your Password"><br>
        <input type="text" value="true" name="signon" required hidden>
        <input type="submit" value="Login" style="width:180px;"><br>
    </form>
</div>