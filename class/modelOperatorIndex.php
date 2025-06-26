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
        public function insertToElementList($cnnct, $parameterList){
            $table = 'element_list';
            $field = array("u_id","el_name", "box_id", "Pmax","maxU","maxI","maxF","datasheet_way");
            
            $this->InsertRecord($cnnct, $table, $field, $parameterList);
        }

        public function getNewKey($cnnct){
            $table = 'element_list';
            $Id = 'i_cod';
            return $this->LastId($cnnct, $table, $Id);
            
        }
        
}
