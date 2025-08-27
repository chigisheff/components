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
            'getNuanseListForItem'
        ]))
    {
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
    for($i=0;$i<count($idarray);$i++){
        $repackedArray[$i][0] = $idkey;
        for($j=0;$j<count($idarray);$j++){
            $repackedArray[$i][$j+1]="'".$idarray[$i][$j]."'";
        }
    }
    return ['idkey' => $idkey, 'idname' =>$nameItem, 'arrayRecord' => $repackedArray ];
}
function putData($dataset){
    $dataSet = unpackingParameters($dataset);
    
    $p = new modelOperatorIndex();
    $result = $p->PutDataNuanse($p->getConnect(), $dataSet['arrayRecord']);
    header('Content-Type: application/json');
    if($result){
        echo json_encode(['status' => 'success', 'message' =>'Данные сохранены' ]);
    } else {
        echo json_encode(['status' => 'error','message' => 'Проблемы при записи информации']);
        }
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
