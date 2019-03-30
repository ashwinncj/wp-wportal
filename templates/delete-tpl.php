<div class="wrap">
    <h1>Ecopure Warranty Portal</h1>
    <h2></h2>
    <h3>You are trying to delete the following item - </h3>
    <h2><?php echo $name; ?></h2>
    <h3>Are you sure ?</h3>
    <form action="" method="POST">
        <input type="text" name="item" hidden value="<?php echo $item; ?>">
        <input type="text" name="id" hidden value="<?php echo $id; ?>">
        <?php echo '<a href="' . admin_url('admin.php?page=' . $return_page) . '"><button type="button">Cancel and go back</button></a>'; ?>
        <input type="submit" value="Confirm Delete">
    </form>
</div>