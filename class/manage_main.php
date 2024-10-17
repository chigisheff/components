<?php

/**
 * Description of manage_main
 *
 * @author andreych
 */
class manage_main extends pagemain
{
    public $title = "Менеджмент базы данных справочника компонентов  @AGChigisheff";
    public function p_open()
    {
        require_once 'interface/op_pg_head.php';
    }
    public function p_content()
    {
        require_once "interface/op_pg_content.php";
    }
    
}
