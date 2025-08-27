<?php
require_once "../class/classBase.php";

class modelIndex extends classBase {
    public function GetDataElements($connection,$keyItem)
    {
        if($keyItem < 16777214){
            $query = "SELECT * FROM itemlist ORDER BY nameitem WHERE u_id =". $keyItem.'"';
        }
        else {
            $query = "SELECT * FROM itemlist ORDER BY nameitem";
        }
        $result = mysqli_query($connection, $query);
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {
            $rowout[$i] = $row;
            $i++;
        }
        return $rowout;
    }
    
    public function GetNuanceForItem($connection, $keyItem)
    {
        if ($keyItem > 0) {
            $query = "SELECT nuanses.u_nuanse, nuanses.i_element, nuanses.value"
                . "FROM nuanses "
                . "WHERE i_element = ".$keyItem." "
                . "ORDER BY name, value ";
        } else {
            $query = "SELECT SELECT nuances.u_nuanse, nuances.i_element, nuances.value "
                . "FROM nuanses ORDER BY name, value";
        }
        $result = mysqli_query($connection, $query);
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {
            $rowheap[$i][0] = $row[0];
            $i++;
        }
        $rowout[0] = ['nuanses' => array_unique($rowheap['nuance']) ];
        $rowout[1] = ['values' => $rowheap];
        return $rowout;
    }
    public function GetDataGeneralTable($str_filter = '', $tbl_start = 0, $arr_length = 250)
    {
        $filter = 'WHERE ';
        if ($str_filter != '') {
            
        }
    }
}
