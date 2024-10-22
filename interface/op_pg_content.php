<?php
    require_once 'class/q_fields.php';
    require_once 'class/q_interface.php';
    $p = new q_fields();
    $pi = new q_interface();
    $mysql = $p->getConnect();
    if ($mysql) {
        $row = $p->getItemList($mysql);
        $array = $p->getPackageList($mysql);
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
<div class="back_phone">
    
    <div id="dlg_crs">
        <div class="head_dlg_pad">
            <div class="head_dlg_pad">
                <h1></h1>
                <button type="button" id="collaps1_1"><img src="img/close.v2.png" alt="Свернуть"/></button>
            </div>
        </div>
        
        <form enctype="multipart/form-data" method="post">
            <hr>
            <p>Элемент <input id="element_cod"/></p>
            <p>Корпус 
                <select name="typ_box[]" id="select_dlg">
                    <option value="0">Не выбран</option>
            <?php   
                    $pi->putDataSelectTypes($array)?>
                </select><button type="button" id="addbox" ><img src="img/add.v1.png"/></button>
            </p>
            <p>Umax <input id="Umax"/></p>
            <p>Imax <input id="Imax"/></p>
            <hr>
            <p>DataSheet</p>
            
            <hr>
            <p><button type="button" id="data_upload" name="datasheet_up">Сохранить</button></p>
        </form>
        
        <p><button type="button" id="detail_upload" name="datasheet_up">Дополнительная информация</button></p>
    </div>
    
</div>
</div>
<div class="content_pad_page_collapsed">
    <div class="head_pg_pad">
        <span>
            Что-то еще...
        </span>
        <div class="menu_pad_op">
            <button type="button" id="collaps2" disabled><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button id="expand2"><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
</div>


<?php

?>
<script type="text/javascript">
    $('#collaps1, #expand2').click(function () {
        $('#collaps1,#expand2').attr('disabled', true);
        $('#collaps2,#expand1').attr('disabled', false);
        $('.content_pad_page').css("height", "25");
        $('.content_pad_page_collapsed').css("height", "576.719").css("overflow-y", "scroll");
        return false;
    });
    $('#collaps2,#expand1').click(function () {
        $('#collaps1,#expand2').attr('disabled', false);
        $('#collaps2,#expand1').attr('disabled', true);
        $('.content_pad_page').css("height", "576.719").css("overflow-y", "scroll");
        $('.content_pad_page_collapsed').css("height", "25");
        return false;
    });
    $(".content_menu").click(function (){
        const Id = $(this).attr('id');
        const val = $(this).attr('value');
        const funct = Id.slice(-1);
        if(funct === '0'){$('#dlg_crs h1').html('Новая таблица<br>');}
        else{$('#dlg_crs h1').html('Изменение таблицы');}
        $('.back_phone').css("display","block");
        return false;
    });
    $("#collaps1_1").click(function (){
        $('#element_cod,#Umax,#Imax').val('');
        $('#select_dlg option').prop('selected',false);
        $('.back_phone').css("display","none");
        
    });
    
</script>
