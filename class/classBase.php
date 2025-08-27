<?php


/**
 * Description of classBase
 *
 * @author andreych
 */
class classBase
{
    public function getConnect()
    {   
        include 'cConfig.php';
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
    public function LastId($mysql,$table,$id){
        if(is_null($mysql)) { return false;}
        $sql = "SELECT * FROM ".$table." WHERE ".$id."=LAST_INSERT_ID();";
        $result = mysqli_query($mysql, $sql);
        return mysql_fetch_array($result); 
    }
    
    public function prepareArrayToNull($field)
    {
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


