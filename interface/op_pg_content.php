<?php
    require_once 'class/q_fields.php';
    require_once 'class/q_interface.php';
    $p = new q_fields();
    $pi = new q_interface();
    $mysql = $p->getConnect();
    if ($mysql) {
        $row = $p->getItemList($mysql);
    } else {
        echo "Ошибка соединения с базой данных";
    }
    
?>
<div class="content_pad">
<table class="m_listing">
    <tr>
        <th id="elmnt">
            Элемент
        </th>
        
        <th>
            Доступные инструменты
        </th>
    </tr>
    <?php $pi->putDataSelectTable($row, 1, 2, 0, true, 1)?>
    
</table>

</div>
<script type="text/javascript">
    $(function(){
        $(".content_menu").click(function () {
            alert('click!');
        return false;    
        });
    });
</script>
