<?php
    $DATA_DIR = '/home/yato/DATA/';
    $file = $DATA_DIR . $_GET['tbname'] . '.json';
    $data = json_decode(file_get_contents($file), true);
    echo json_encode($data);
?>