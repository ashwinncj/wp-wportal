<?php

header("content-type: image");
isset($_GET['id']) ? isset($_GET['auth']) ? isset($_GET['time'])? : exit() : exit() : exit();
$id = $_GET['id'];
$auth = $_GET['auth'];
$time = $_GET['time'];
if (time() - $time > 5) {
    exit();
}
if (md5('rdl' . $id . $time) != $auth) {
    exit();
}
$file = file_get_contents($_GET['img']);
echo $file;
?>
