<!DOCTYPE html> 
<html>
<?php
    require_once 'class/pagemain.php';
    require_once "class/manage_main.php";
    $p0 = new pagemain();
    $p = new manage_main();
    $p->p_header();
?> <div class="m_vidow"><?php
    $p->p_open();
    $p->p_content();
    $p->p_close();
?></div></body>
</html>