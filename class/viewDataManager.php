<?php

/**
 * Description of manage_main
 *
 * @author andreych
 */
class viewDataManager extends viewMain
{
    public $title = "Управление справочником компонентов  @AGChigisheff";
    public function pOpen()
    {
        require_once 'interface/viewOperatorHead.php';
    }
    public function pContent()
    {
        require_once "interface/viewOperatorContent.php";
    }
    
}
