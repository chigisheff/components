<?php
class q_fields{
    public function getConnect(){
        $db = new mysqli('localhost','componentsd','JsCyZabq]gJg3!BF','components');
        if(!$db){
            return false;
        }
        return $db;
        
    }
    public function getItemList($mysql){
        $query = "SELECT u_cod,u_i_name FROM itemlist ORDER BY u_i_name";
        $result = mysqli_query($mysql, $query); 
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {
            $rowout[$i]= $row;
            $i++;
        }
        return $rowout;
        
    }
    
}