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
        public function insertToElementList($parameterList){
            $table = 'componentlist';
            $field = array("i_cmp","name", "pack_id", "maxP","maxU","maxI","maxF","datasheet");
            
            $this->InsertRecord($this->cnnct, $table, $field, $parameterList);
        }
        public function isNotPresentNuanse($param) {
            
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
        public function PutDataNuanse($connection,$data){
            $table = 'nuanses';
            $field = array("i_element","name","value");
            for($i=0; $i < count($data);$i++){
              $result  =  $this->InsertRecord($connection, $table, $field, $data[$i]);
            }
            mysqli_close($connection);
            return $result;
        }
        
        public function getNewKey($cnnct){
            $table = 'componentlist';
            $Id = 'u_id';
            return $this->LastId($this->cnnct, $table, $Id);    
        }
        
}
