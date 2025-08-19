<?php
/**
 * Description of modelOperatorComponentSave
 *
 * @author andreych
 */
if (isset($_POST['action'])&&isset($_POST['data'])&&!empty($_POST['data'])) { // Проверяем параметры на существование и полноту
    header('Content-Type: application/json');
    $function = $_POST['action'];
    $data = $_POST['data'];
    if(function_exist($function)){
        $result = $function($data);
        echo json_encode($result);
    } else {
        
        echo json_encode(['error' => 'Нет функции, неверное имя']);
        die();
    }
    
}
function unpackingParameters(){
    
}
function putData($dataset){
    
}
function getNuanseListForItem($dataIn){
    $id = unpackingParameters($dataIn);
    include modelIndex.php;
    $p = new modelIndex();
    $dataonrequest = $p->GetDataElements($p->getConnect(), $id);
    
    return $dataonrequest;
}
