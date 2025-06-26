<!DOCTYPE html> 
<html>
    <?php
    require_once 'class/viewAdmin.php';
    $p = new viewAdmin();
    $p->pHeader();?> 
    <div class="m_vindow"><?php
    $p->pOpen();
    $p->pContent();
    $p->pFooter();
    ?></div></body>
</html>
