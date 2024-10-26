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
        <form enctype="multipart/form-data" id="f_el_list" accept-charset="UTF-8 Windows-1251" method="post" >
            <hr>
            <p>Компонент <input type="text" id="element_cod"  required/></p>
            <p>Корпус 
                <select name="typ_box[]" id="select_dlg">
                    <option value="0">Не выбран</option>
            <?php   
                    $pi->putDataSelectTypes($array)?>
                    </select>
                    <button type="button" id="addbox" ><img src="img/add.v1.png"/></button>
            </p>
            <p>Umax <input type="text" id="Umax"/></p>
            <p>Imax <input type="text" id="Imax"/></p>
            <hr>
            <p>DataSheet</p>
            <input type="file" id="file-upload" />
            <p></p>
            <hr>
            <p><button type="button" id="data_upload" name="datasheet_up">Сохранить</button></p>
        </form>
        <div id="Result"></div>
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
<div class="content_pad_page_collapsed">
    <div class="head_pg_pad">
        <span>
            Что-то еще...
        </span>
        <div class="menu_pad_op">
            <button type="button" id="collaps3" disabled><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button id="expand3"><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
</div>
<script type="text/javascript">
    var ind = 0;
    var unputcontent=[];
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
        if(funct === '0'){$('#dlg_crs h1').html('Новый компонент<br>');}
        else{$('#dlg_crs h1').html('Изменение компонента');}
        $('.back_phone').css("display","block");
        return false;
    });
    $("#collaps1_1").click(function (){
        $('#element_cod,#Umax,#Imax').val('');
        $('#select_dlg option').prop('selected',false);
        $('.back_phone').css("display","none");
        
        $('#Result').empty();
        unputcontent = '';
    });
    $('#addbox').mouseover(function(){
        if($("#select_dlg option:selected").text()==="Не выбран")
            {$('#addbox').css('cursor','default');} else {$('#addbox').css('cursor','pointer');}
    });
    $('#addbox').click(function(){
        const vl = $("#select_dlg option:selected").text();
        const idx = $("#select_dlg option:selected").val();
        if($.inArray(vl,unputcontent)===-1 && vl !== "Не выбран" ){
            var f_data = Array(2);
            f_data[0] = idx; f_data[1] = vl; 
            unputcontent[ind] = f_data;
            const what=`prev_${ind}`;
            $("#Result").append('<p><input type="text" id="'+what+'" form="f_el_list" /></p>');
            $("#"+what).val(vl).prop('disabled',true);
            ind = ind+1;
        }
        $('#select_dlg option:first').prop('selected',true);
    });
    $("#f_el_list").click(function(){
        const arr2string = unputcontent.join(' ');
        var formData = {
            "#element_cod":$("#element_cod").val(),
            "#Umax":$("#Umax").val(),
            "#Imax":$("#Imax").val(),
            "#f_el_list":$("#f_el_list").val(),
            "array_sting":arr2string
        };
    $.ajax({
        url:'interface/data_dlg_table_op.php',
        type:'POST',
        data:JSON.stringify(formData),
        contentType: 'application/json',
        success: function(res){
            alert(res);
        },
        error: function(error){
            console.error('Ошибка', error);
        }
    });
    return false;
    });
            
</script>
