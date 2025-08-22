<?php
/**
 * Description of modelOperatorComponentSave
 *
 * @author andreych
 */
if (isset($_POST['action'])&&isset($_POST['data'])&&!empty($_POST['data'])) { // Проверяем параметры на существование и полноту
    header('Content-Type: application/json');
    $function = $_POST['action'];
    $data = json_decode($_POST['data'], true);
    
    if(function_exists($function)){
        $result = $function($data);
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Нет функции, неверное имя']);
        die();
    }
    include modelIndex.php;
}
function unpackingParameters($dataIn){
    $idkey = $dataIn[0];
    $array = $dataIn[1];
    ['id' => $id, 'items' => $items] = $dataIn[1];
    
    
}
function putData($dataset){
    $dataSet = unpackingParameters($dataset);
    $p = new modelIndex();
    $result = $p->PutDataNuanse($p->getConnect(), $keyItem, $dataSet);
}
function getNuanseListForItem($dataIn){
    $id = unpackingParameters($dataIn);    
    $p = new modelIndex();
    $dataonrequest = $p->GetDataElements($p->getConnect(), $id);
    
    return $dataonrequest;
}
