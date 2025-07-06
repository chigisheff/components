<?php
header('Content-Type: application/json;charset=utf-8');
header('Accept: application/json');
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $unpackBox= explode('_', $data['array_string']);
    $field[0] = (trim($data['elenent_indx']));
    $field[1] = (trim($data['element_cod']));
    $field[2] = (trim($data['array_string'][0]));
    $field[3] = $data['Pmax'];
    $field[4] = (trim($data['Umax']));
    $field[5] = (trim($data['Imax']));
    $field[6] = (trim($data['Fmax']));
    $field[7] = (!is_null($data['FName'])) ? (trim($data['FName'])):"'intro'";
    require_once '../class/modelOperatorIndex.php';
    $p = new modelOperatorIndex();
    $rd_field = $p->prepareArrayToNull($field);
    $mysql = $p->getConnect();
    foreach ($unpackBox as $value) {
        $rd_field[2] = $value[0]; // Для каждого типа корпуса новая запись
        $rd_field[7] = (is_null($rd_field[7])) ? "'intro'":$rd_field[7];
        $p->insertToElementList($mysql, $rd_field);
    }
    //$lastRec = $p->getNewKey($mysql);

echo json_encode('Информация сохранена'. $field[7]);

