<?php
class q_index_page{
    private function getConnect(){
        require_once 'class/q_fields.php';
        $p = new q_fields();
        $request = $p->getConnect();
        return $request;
    }
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
}
