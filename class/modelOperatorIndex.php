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
        public function getListForElement($parameterKey,$keyField){
            $table = 'itemlist';
            $res = $this->getFor($this->cnnct, $table, $parameterKey, $keyField);
            
        }

        public function getNewKey($cnnct){
            $table = 'componentlist';
            $Id = 'u_id';
            return $this->LastId($this->cnnct, $table, $Id);    
        }
        
}
