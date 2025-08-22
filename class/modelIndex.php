<?php
require_once "class/classBase.php";

class modelIndex extends classBase {
    public function GetDataElements($connection,$keyItem)
    {
        if($keyItem < 16777214){
            $query = "SELECT * FROM itemlist ORDER BY el_name WHERE i_id =". $keyItem.'"';
        }
        else {
            $query = "SELECT * FROM itemlist ORDER BY el_name";
        }
        $result = mysqli_query($connection, $query);
        $i = 0;
        while ($row = mysqli_fetch_row($result)) {
            $rowout[$i] = $row;
            $i++;
        }
        return $rowout;
    }
    public function PutDataNuanse($connection,$keyItem,$data){
        
    }
    public function GetNuanceForItem($connection, $keyItem)
    {
        if ($keyItem > 0) {
            $query = "SELECT nuances.nuance, nuances.i_nu, nuances.v_nuance"
                . "FROM nuances "
                . "WHERE el_key = ".$keyItem." "
                . "ORDER BY nuance, v_nuance ";
        } else {
            $query = "SELECT nuances.nuance, nuances.i_nu, nuances.v_nuance "
                . "FROM nuances ORDER BY nuance, v_nuance";
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
