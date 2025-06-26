<!DOCTYPE html> 
<html>
<?php
    require_once 'class/viewMain.php';
    require_once "class/viewDataManager.php";
    $p0 = new viewMain();
    $p = new viewDataManager();
    $p->pHeader();
?> <div class="m_vindow" id="element"><?php
    $p->pOpen();
    $p->pContent();
    $p->pFooter();
?></div></body>
</html>