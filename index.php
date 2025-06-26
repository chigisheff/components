<!DOCTYPE html> 
<html>
<?php
require_once "class/viewMain.php";
$p = new viewMain();
$p->pHeader();?> 
<div class="m_vindow"><?php
$p->pOpen();
$p->pContent();
$p->pFooter();
?></div></body>

</html>