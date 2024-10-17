<!DOCTYPE html> 
<html>
<?php
require_once "class/pagemain.php";
$p = new pagemain();
$p->p_header();
?> <div class="m_vidow"><?php
$p->p_open();
$p->p_content();
$p->p_close();
?></div></body>

</html>