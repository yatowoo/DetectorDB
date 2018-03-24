<?php 
    $data = json_decode(file_get_contents('tbdata.json'), true);
    echo json_encode($data[$_GET['tbname']]);
?>