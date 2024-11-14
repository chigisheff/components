<?php
if ((count($_FILES)) > 0) {
    $input_name = 'files';
    $path = $_SERVER['DOCUMENT_ROOT'] . '/datasheets/';
    $error = $success = '';
    require_once '../class/class_op_dlg.php';
    $p = new class_op_dlg();
    $fname = $_FILES[$input_name];
    $result = $p->compliteLoad($fname);
    if ($result != '') {
        $response = $result;
    } else {
        // Перемещаем файл в директорию /datasheets/.
            $newname = $p->translitera($fname['name']);
            if (move_uploaded_file($fname['tmp_name'], $path . $newname)) {
                // Далее можно сохранить название файла в БД и т.п.
                $success = $response = $newname;
            } 
        }
} else {    $response = false;} // Продолжаем без сохранения файла
header('Content-Type: application/json');
echo json_encode($response);

