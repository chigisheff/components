<?php

/**
 * Description of q_oper_page
 *
 * @author andreych
 */
class q_oper_page
{
    private function getConnect(){
        require_once 'class/q_fields.php';
        $p = new q_fields();
        $request = $p->getConnect();
        return $request;
    }
    
}
