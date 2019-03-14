<div class="wrap">
    <h1>Ecopure Warranty Portal</h1>
    <h2>Products</h2>

</div>

<?php

function test($_options) {
    //default values
    $default_options = array(
        'name' => 'Name Not Set ',
        'value' => 'Value Empty'
    );
    is_array($_options) ? $options = array_merge($default_options, $_options) : $options = $default_options;
    echo 'Name: ' . $options['name'] . '<br>';
    echo 'Value: ' . $options['value'];
}

//$product['name'] = 'Product1';
$product['value'] = 154;
//$product = 'Test';
test($product);
?>