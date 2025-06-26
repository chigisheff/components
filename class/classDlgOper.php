<?php

/**
 * Description of class_op_dlg
 *
 * @author andreych
 */
require_once '../class/classFileServ.php';
class classDlgOper extends classFileServ
{
    public function compliteLoad($fname)
    {   
        $error = '';
        if (!$this->ifItsLoad($fname)) {
            $error = 'Системная ошибка при загрузке файла';
        } else {
            if (!$this->if_noError($fname)) {
                $error = "Ошибка загрузки файла";
            } elseif (!($this->testExtention($fname['name']))){ //&&$this->mimeReview($fname['name'])
                $error = "Неверное расширение. Сохранение отменено.";
            } 
        }
        return $error;
    }
}
