<?php
include 'cConfig.php';
/**
 * Description of classBase
 *
 * @author andreych
 */
class classBase
{
    public function getConnect()
    {   
        $p = new cConfig();
        $db = new mysqli($p->HOST, $p->USERDB, $p->PWDUSRBD, $p->DBNAME);
        if (!$db) {
            return false;
        }
        return $db;
    }
    public function InsertRecord($mysql, $table, $field= array(), $value= array()){
        if(is_null($mysql)){return false;}
        if(!is_array($field)){return false;}
        if(!is_array($value)){return false;}
        $sql="INSERT INTO ".$table.' ('.implode(",",$field).') '." VALUES (". implode(", ", $value).');';
        $result = mysqli_query($mysql, $sql);
        return $result;
    }
    public function getFor($connect,$table,$key, $fieldKey, $offset=0) {
        if(is_null($connect)){return false;}
        if(is_null($key)||($key == '')){return false;}
        $sql = 'SELECT * FROM '.$table.' WHERE `'.$fieldKey.'` = '.$key.' LIMIT 250 OFFSET '.$offset;
        $result = mysqli_query($connect, $sql);
        return $result;
    }
    public function getIdForName($connect,$table,$uId,$name){
        if(is_null($connect)){return false;}
        if(is_null($name)||($table == '')||is_null($uId)){return false;}
        $sql = 'SELECT `'.$uId.'` FROM '.$table.' WHERE nameitem = "'.$name.'"';
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    
    public function getAllFrom($connection, $table,$orderby ='', $limit=250, $offset=0) {
        if(is_null($connect)){return false;}
        if($table === ''){return false;}
        $sql = 'SELECT * FROM '.$table. ' ORDER BY '.$orderby.'  LIMIT '.$limit.' OFFSET '.$offset;
        $result = mysqli_query($connection, $sql);
        if($result){
            while ($row = mysqli_fetch_row($result)) {
            $rowout[]= $row;
            }
        } else {
            return false;
        }
        return $rowout;
    }
    public function prepareArrayToNull($field){
        $lengthArray = count($field);
        for ($i = 0; $i < $lengthArray; $i++) {
            $p1 = ($field[$i] == '')? 'Y':'N';
            $p2 = (is_null($field[$i])) ? 'Y' : 'N';
            if ($field[$i] == ''|| is_null($field[$i])) {
                $field[$i] = 'NULL';
            }
        }
        return $field;
    }
}


