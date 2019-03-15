<!--//Registration form template-->

<div class="wrap">
    <h3>Register</h3>
    <form action="" method="POST">
        <input type="text" required name="full_name" placeholder="Your Full Name"><br>
        <input type="text" required name="user_mobile" placeholder="Your Mobile Number"  pattern="[0-9]{10}" title="Enter a valid Mobile number"><br>
        <input type="email" required name="user_email" placeholder="Your Email"><br>
        <input type="password" required name="user_password" placeholder="Password"><br>
        <input type="text" value="true" name="register" required hidden>
<!--<input type="password" required name="confirm_password" placeholder="Confirm Password">-->
        <input type="submit" value="Register"><br>
    </form>
</div>