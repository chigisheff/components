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
<div class="content_pad_page">
    <div class="head_pg_pad">
        <span>
         Управление datasheet компонентов
        </span>
        <div class="menu_pad_op">
            <button type="button" id="collaps1"><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button type="button" id="expand1" disabled><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
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
<div class="content_pad_page_collapsed">
    <div class="head_pg_pad">
        <span>
            Что-то еще...
        </span>
        <div class="menu_pad_op">
            <button id="collaps2"><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button id="expand2"><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
</div>
<script type="text/javascript">
    const rEvents = document.querySelector('#collaps1');
    const lEvents = document.querySelector('#collaps2');
    const toggleDivs = document.querySelector('.content_pad_page');
    const toggleDivCollapse = document.querySelector('.content_pad_page_collapsed');
    $('#collaps1, #expand2').click(function () {
        $('#expand1,#collaps2').attr('disabled',true);
        $('#collaps1,#expand2').attr('disabled',false);
        $('.content_pad_page').css("height","25");
        $('.content_pad_page_collapsed').css("height","576.719");
        return false;    
    });
    $('#collaps2, #expand1').click(function () {
        $('#expand1,#collaps2').attr('disabled',false);
        $('#collaps1,#expand2').attr('disabled',true);
        $('.content_pad_page').css("height","576.719");
        $('.content_pad_page_collapsed').css("height","25");
        return false;    
    });
</script>
