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
    <h2>Terms and Conditions<span style="font-size: 12px;margin-left: 20px;"><a href="<?php echo admin_url('admin.php?page=wportal_terms'); ?>"><button>Add new</button></a></span></h2>
    <table id="output-table" class="output-table">
        <thead>
            <tr>
                <th style="width: 25px;">Sl.</th>
                <th style="width: 200px;">Name</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = $pagination + 1;
            foreach ($terms as $item) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=wportal_terms&terms='.$item->id); ?>"><?php echo $item->name; ?></a></td>
                    <td><?php echo $item->document; ?></td>
                </tr>
                <?php
                $count++;
            }
            ?>
        </tbody>
    </table>
    <?php
    $next = $pagination + 30 < $total_terms ? TRUE : FALSE;
    $next_page = $pgno + 1;
    $prev_page = $pgno - 1;
    echo $pgno > 1 ? "<a href=" . admin_url("admin.php?page=warranty_portal_terms&pgno=$prev_page") . ">Prev page | " : '';
    echo $next ? "<a href=" . admin_url("admin.php?page=warranty_portal_terms&pgno=$next_page") . ">Next page" : '';
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