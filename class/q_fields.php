<?php
require_once "class/classBase.php";

class q_fields extends classBase{
    
    public function getItemList($mysql){
        $query = "SELECT u_cod,u_i_name,u_i_table_name FROM itemlist ORDER BY u_i_name";
        $result = mysqli_query($mysql, $query); 
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {
            $rowout[$i]= $row;
            $i++;
        }
        return $rowout;
    }
    
}