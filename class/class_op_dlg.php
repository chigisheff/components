<?php

/**
 * Description of class_op_dlg
 *
 * @author andreych
 */
class class_op_dlg extends classFileServ
{
    public function compliteLoad($fname)
    {   
        $error = '';
        if (!$this->ifItsLoad($fname)) {
            $error = 'Системная ошибка при загрузке файла';
        } else {
            if (!$this->if_noError($fname)) {
                $error = "Ошибка загрузки файла";
            } elseif (!($this->testExtention($fname['name'])&&$this->mimeReview($fname['name']))){
                    $error = "Неверное расширение или MIME тип файла. Сохранение отменено.";
            } 
        }
        return $error;
    }
}
