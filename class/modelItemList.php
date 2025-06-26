<?php
require_once "class/classBase.php";

class modelItemList extends classBase{
    
    public function getItemList($mysql){
        $query = "SELECT `u_id`,`nameitem`,`tabledata`,`engname` FROM itemlist ORDER BY nameitem";
        $result = mysqli_query($mysql, $query); 
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {
            $rowout[$i]= $row;
            $i++;
        }
        return $rowout;
    }
    public function getPackageList($mysql){
        $query = "SELECT u_id,packname FROM packagelist ORDER BY packname";
        $result = mysqli_query($mysql, $query);
        $i=0;
        while ($row = mysqli_fetch_row($result)) {
            $rowout[$i]=$row;
            $i++;
        }
        return $rowout;
    }
    
}