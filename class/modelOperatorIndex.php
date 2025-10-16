<?php

/**
 * Description of q_oper_page
 *
 * @author andreych
 */
require_once '../class/classBase.php';
class modelOperatorIndex extends classBase
{
    public $id_key, $cnnct;
    public function insertToElementList($connect, $parameterList){
        $table = 'componentlist';
        $field = array("i_cmp","name", "pack_id", "maxP","maxU","maxI","maxF","nuanse_id","datasheet");

        $this->InsertRecord($connect, $table, $field, $parameterList);
    }
    public function getListForElement($parameterKey,$keyField){
        $table = 'itemlist';
        $res = $this->getFor($this->cnnct, $table, $parameterKey, $keyField);

    }
    public function GetDataElements($connect,$id){
        $table = 'nuanses';
        $fieldKey = 'i_element';
        $response = $this->getFor($connect, $table, $id, $fieldKey);
        mysqli_close($connect);
        return $response;
    }
    public function getIdItems($connection,$name){
        $table = 'itemlist';
        $uId = 'u_id';
        $res = $this->getIdForName($connection, $table, $uId, $name);
        mysqli_close($connection);
        return $res;
    }
    public function getAllItems($connection, $limmit, $offset){
        $table = 'itemlist';
        $order = 'nameitem';
        $result = $this->getAllFrom($connection, $table, $order, $limmit, $offset);
        mysqli_close($connection);
        return $result;        
    }
    public function PutDataNuanse($connection,$data){
        $table = 'nuanses';
        $field = array("i_element","name","value");
        for($i=0; $i < count($data);$i++){
          $result  =  $this->InsertRecord($connection, $table, $field, $data[$i]);
        }
        mysqli_close($connection);
        return $result;
    }
    public function PutComponent($connection,$data){
        $table = 'itemlist';
        $field = array("nameitem","engname","tabledata");
        $result = $this->InsertRecord($connection, $table,$field,$data);
        mysqli_close($connection);
        return $result;
    }
}
