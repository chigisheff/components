<?php
header('Content-Type: application/json;charset=utf-8');
header('Accept: application/json');
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

//$data = filter_input(INPUT_POST, 'data');
echo 'Информация сохранена';
exit();
