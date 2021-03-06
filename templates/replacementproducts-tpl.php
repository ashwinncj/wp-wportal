<style>
    .output-table th{
        text-align: left;
        background-color: #f8f8ff;
    }
    .output-table tbody tr:nth-child(even){
        background-color: #f8f8ff;
    }
    .output-table tbody tr:nth-child(odd){
        background-color: #fffcfc;
    }
</style>
<div class="wrap">
    <h1>Ecopure Warranty Portal</h1>
    <h2>Replacement Products<span style="font-size: 12px;margin-left: 20px;"><a href="<?php echo admin_url('admin.php?page=wportal_replacement_product'); ?>"><button>Add new</button></a></span></h2>
    <table id="output-table" class="output-table">
        <thead>
            <tr>
                <th>Sl.</th>
                <th>Replacement Product Name</th>
                <th>Warranty</th>
                <th>Terms & Conditions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = $pagination + 1;
            foreach ($products as $item) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=wportal_replacement_product&product='.$item->id); ?>"><?php echo $item->name; ?></a></td>
                    <td><?php echo $item->warranty_type; ?></td>
                    <td><?php echo $item->terms; ?></td>
                </tr>
                <?php
                $count++;
            }
            ?>
        </tbody>
    </table>
    <?php
    $next = $pagination + 30 < $total_products ? TRUE : FALSE;
    $next_page = $pgno + 1;
    $prev_page = $pgno - 1;
    echo $pgno > 1 ? "<a href=" . admin_url("admin.php?page=warranty_portal_replacement_products&pgno=$prev_page") . ">Prev page | " : '';
    echo $next ? "<a href=" . admin_url("admin.php?page=warranty_portal_replacement_products&pgno=$next_page") . ">Next page" : '';
    ?>
    <script>
        jQuery(document).ready(function ($) {
            $(document).ready(function () {
                $('#output-table').DataTable({
                    "paging": false,
                    "ordering": false,
                    "info": false
                });
            });
        });
    </script>
</div>