<?php
/**
 * Description of modelOperatorComponentSave
 *
 * @author andreych
 */
header('Content-Type: application/json');
include '../class/modelOperatorIndex.php';

if (isset($_POST['action'])&&isset($_POST['data'])&&!empty($_POST['data'])) { // Проверяем параметры на существование и полноту

    $function = $_POST['action'];
    $data = json_decode( $_POST['data'], true);
    if (!in_array($function, 
        [
            'putData',
            'getNuanseListForItem',
            'putItemAndHimData',
            'getItemListAfterUpdate',
            'putNuanseFromInputField'
        ])
    )   {
        $response = ['status' => 'error', 'message' => 'Вызвана недопустимая функция'];
        echo json_encode($response);
        exit;
    }
    if(function_exists($function)){
        $result = $function($data);
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Нет функции, неверное имя']);
        die();
    }
    
}
function isNotPresentNuanse($dataIn){
    $inarray = $dataIn[1]['items'];
    $keyItem = $dataIn[1]['id'];
    $p = new modelOperatorIndex();
    for ($i = 0; $i < count($inarray);$i++){        
        if($p->isNotPresentNuanse(['key'=> $keyItem, 'arrayOne' => $inarray[$i]])){
            
        }  
    }
}
function unpackingParameters($dataIn){
    $repackedArray =[];
    $nameItem = $dataIn[0];
    $idkey = $dataIn[1]['id'];
    $idarray = $dataIn[1]['items'];
    if($idkey === 0){
        $p = new modelOperatorIndex();
        $idkey = $p->getIdItems($p->getConnect(),$nameItem);
    }
    for($i=0;$i < count($idarray);$i++){
        $repackedArray[$i][0] = $idkey;
        for($j=0;$j < count($idarray[$i]);$j++){
            $repackedArray[$i][$j+1]="'".$idarray[$i][$j]."'";
        }
    }
    return ['idkey' => $idkey, 'idname' =>$nameItem, 'arrayRecord' => $repackedArray ];
}
function unpackItemSet($dataIn){ // Работает
    for($i=0;$i<count($dataIn);$i++){
        $dataIn[$i] = '"'.$dataIn[$i].'"';
    }
    return $dataIn;
}
function putData($dataset){
    $dataSet = unpackingParameters($dataset);    
    $p = new modelOperatorIndex();
    $result = $p->PutDataNuanse($p->getConnect(), $dataSet['arrayRecord']);
    header('Content-Type: application/json');
    if($result){
        echo json_encode(['status' => 'success', 'message' => 'Данные сохранены' ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Проблемы при записи информации']);
    }
}
function putItemAndHimData($dataset){
    $dataItem = unpackItemSet($dataset[0]);
    $p = new modelOperatorIndex();
    $result = $p->PutComponent($p->getConnect(), $dataItem);
        if($result){
            $dataSet = unpackingParameters($dataset[1]);
            if(count($dataSet['arrayRecord'])>0){
                $p->PutDataNuanse($p->getConnect(), $dataSet['arrayRecord']);
                
            } else {
            return json_encode(['status' => 'error', 'message' =>'Проблемы при сохранении элемента']);
        }
        return json_encode(['status' => 'success', 'message' =>'Элемент сохранен']);
    }
}
function putNuanseFromInputField($dataIn){
    
}
function getNuanseListForItem($dataIn){
    $id = json_encode($dataIn);    
    $p = new modelOperatorIndex();
    $dataonrequest = $p->GetDataElements($p->getConnect(), $id);
    $result=[];
    while($row = $dataonrequest->fetch_assoc()){
        $result[] = [$row['name'],$row['value']];
    }
    return json_encode($result);
}
function getItemListAfterUpdate($plug) {
    $p = new modelOperatorIndex();
    $response = $p->getAllItems($p->getConnect(), $plug['limmit'], $plug['offset']);
    return json_encode($response, JSON_UNESCAPED_UNICODE);
}
