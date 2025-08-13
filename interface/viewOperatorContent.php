<?php
    require_once 'class/modelItemList.php';
    require_once 'class/viewTableItem.php';
    $p = new modelItemList();
    $pi = new viewTableItem();
    $mysql = $p->getConnect();
    if ($mysql) {
        $row = $p->getItemList($mysql);
        $array = $p->getPackageList($mysql);
    } else {
        echo "Ошибка соединения с базой данных";
    }
    
?>

<div class="content_pad_page"id="wnd_1">
    <div class="head_pg_pad" id="list_one">
        <span>
            Доступные компоненты
        </span>
        <div class="menu_pad_op">
            <button type="button" id="collaps1"><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button type="button" id="expand1" disabled><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
    <div class="select_page"></div>
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
        <div class="head_dlg_pad" id="wnd_1">
            <div class="head_dlg_pad"  id="list_one">
                <h1></h1>
                <button type="button" id="collaps1_1"><img src="img/close.v2.png" alt="Свернуть"/></button>
            </div>
        </div>
        <div class="element">
            <p><span>Наименование</span><br>
                <input type="text" id="NameElement" required />
            </p>
            <p><button type="button" id="detail_upload" name="datasheet_up">Datasheet</button></p>
        </div>
        <div class="nuanses">
            <p id = "headDlg"></p>
            <span>Характеристики</span><br>
            <p class="inputcol1">Наименование<br>
                
            </p> 
            <p class="empty">&nbsp;<br> &nbsp;</p>
            <p class="inputcol2">
               Значение<br>
                
            </p>
            <p class="inputNuanseString">
                <input type="text" class="nuanse-input" id="NameNuanse_" required />
                <input type="text" class="nuanse-input" id="CntNuanse_" />
            </p>
        </div>
        <div class="component"> 
            <form enctype="multipart/form-data" id="f_el_list" accept-charset="UTF-8 Windows-1251" method="post" >
                <hr>
                <p>Компонент* <input type="text" id="element_cod"  required /></p>
                <p>Корпус* 
                    <select name="typ_box[]" id="select_dlg"  onchange="onSelectChange(event)" disabled>
                        <option value="0">Не выбран</option>
                <?php   
                        $pi->putDataSelectTypes($array)?>
                        </select>
                        <button type="button" id="addbox" ><img src="img/add.v1.png"/></button>
                </p>
                <p>Pmax(W) <input type="number" id="Pmax" disabled/></p>
                <p>Umax(V)* <input type="number" id="Umax" disabled/></p>
                <p>Imax(A)* <input type="number" id="Imax" disabled/></p>
                <p>Fmax(mHz)* <input type="number" id="Fmax" disabled/></p>
                <p>DataSheet</p><hr>
                <input type="file" id="file-upload" accept=".pdf,.doc,.docx,.xlsx,.xls,.odt,.ods" name="file_push" disabled/>
                <p></p>
                <hr>
            </form>
            <p><button type="button" id="detail_upload" name="datasheet_up" disabled>Datasheet</button></p>
        </div>
        
        <div id="Result"></div>
        <p><button type="button" id="data_upload" name="datasheet_up" form="f_el_list" disabled>Сохранить</button></p>
        
    </div>
</div>
</div>
<div class="content_pad_page_collapsed" id="wnd_2">
     <div class="head_pg_pad" id="list_two">
        <span>
            DataSheet:
        </span>
        <div class="menu_pad_op">
            <button type="button" id="collaps2" disabled><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button id="expand2"><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
    <div class="back_phone_DSh">
        <div id="dlg_DSh">
            <div class="head_dlg_pad"  id="list_three">
                <h1 id="component_name_ds"></h1>
                <button type="button" id="collaps2_1"><img src="img/close.v2.png" alt="Свернуть"/></button>
            </div>
            
        </div>
    </div>
</div>
<div class="content_pad_page_collapsed" id="wnd_3">
     <div class="head_pg_pad" id="list_three">
        <span>
            Компоненты : 
        </span>
        <div class="menu_pad_op">
            <button type="button" id="collaps3" disabled><img src="img/collapse.v1.png" alt="Свернуть"/></button>
            <button id="expand3"><img src="img/expand.v1.png" alt="Развернуть"/></button>
        </div> 
    </div>
</div>
<script type="text/javascript">
    var menu_action;
    var win_size = new Array();
    var blck;
    var ind = 0;
    var Idx_element;
    var inputcontent=[];
    var files;
    var arr2string='';
    var old_content_span = "Компоненты : ";
    var m_formData;
    var openPage = 1;
    var actModeDialog;
    var arrNuanses = [];
    var raw_DialogArray =[];
    var arrNuansesCount = 0;
    var readyNuanceForSave =[];
    var interrupt_off = false;
    
    $('.m_listing tr').click(function(e){
        var title_tab = ($(this).find('td').eq(0).text()).trim();
        $('#list_three span').text('');
        $($('#list_three span')).text(old_content_span+' '+title_tab);
    });
    //$(document).on('focus', '.nuanses p input', focus());
    //$(document).on('blur', '.nuanses p input', blur());
    $('#element_cod').focusout(function(){
        if($('#element_cod').val() !== ''){
            $('#select_dlg').prop('disabled',false).focus();
            $('#Pmax').prop('disabled',false);
            $('#Umax').prop('disabled',false);
            $('#Imax').prop('disabled',false);
            $('#Fmax').prop('disabled',false);
            $('#file-upload').prop('disabled',false);
            $('#data_upload').prop('disabled',false);
            $('.component #detail_upload').removeAttr('disabled');
        }
    });
    
    $('#file-upload').on('change',function(){
        files = this.files;
        if(files[0]['name'].length){
            $('#dataUpload_done').remove();
            $('#Result').prepend('<p><input type="text" id="dataUpload_done"  form="f_el_list" /> </p>');
            $('#dataUpload_done').val(files[0]['name']).prop('disabled',true);
        }
    });
    
    $('#expand1, #expand2, #expand3').click(function () {
        const saved_wnd = $(this).attr('id').slice(-1);// вкладка включающая сработавшую кнопку
        const cr_pad = "#wnd_"+saved_wnd; // получаем Id content_pad_page для обработки
        const new_pad = "#wnd_"+openPage;
        const own_collaps   ='#collaps'+openPage;
        const new_collaps   ='#collaps'+saved_wnd;
        const own_expand    ='#expand' +openPage;
        const new_expand    ='#expand' +saved_wnd;
        openPage = saved_wnd;
        $(new_collaps).attr('disabled',false);
        $(new_expand).attr('disabled',true);
        $(own_collaps).attr('disabled',true);
        $(own_expand).attr('disabled',false);
        $(new_pad).addClass('content_pad_page_collapsed').removeClass('content_pad_page');
        $(cr_pad).removeClass('content_pad_page_collapsed').addClass('content_pad_page');
        return false;
    });
    
    $('#collaps1, #collaps2, #collaps3').click(function () {
        const saved_wnd = $(this).attr('id').slice(-1); // вкладка включающая сработавшую кнопку
        //openPage = (openPage < 3) ? Number(openPage)+1:1;
        openPage = (openPage < 3) ? +openPage+1:1;
        const cr_pad = "#wnd_"+saved_wnd; // получаем Id content_pad_page для обработки
        const new_pad = "#wnd_"+openPage;
        const own_collaps   ='#collaps'+saved_wnd;
        const new_collaps   ='#collaps'+openPage;
        const own_expand    ='#expand' +saved_wnd;
        const new_expand    ='#expand' +openPage;
        $(new_collaps).attr('disabled',false);
        $(new_expand).attr('disabled',true);
        $(own_collaps).attr('disabled',true);
        $(own_expand).attr('disabled',false);
        $(cr_pad).addClass('content_pad_page_collapsed').removeClass('content_pad_page');
        $(new_pad).removeClass('content_pad_page_collapsed').addClass('content_pad_page');
        return false;
    });
    
    $(".content_menu").click(function (){
        const Id = $(this).attr('id');
        const val = $(this).attr('value');
        const funct = Id.slice(-1);
        actModeDialog = Number(funct);
        var messageDlg;
        Idx_element = (Id.split('_'))[2];
        $("#dlg_crs").attr('data-id',Id);
        $('.back_phone').css("display","block");
        win_size = [$('#dlg_crs').width(), $('#dlg_crs').height()];
        const pos = $('.content_pad_page').offset().top;
        $('.content_pad_page').scrollTop(-pos);
        menu_action = funct;
        switch (funct){
            case '0':
                messageDlg = 'Новый элемент';
                $('#NameElement').prop('disabled',false).val('');
                $('.element, .nuanses').css('display','block');
                $('.nuanses input').prop('disabled',true);
                $('#element_cod').focus();
                break;
            case '1':
                messageDlg = 'Изменение элемента';
                $('#NameElement').prop('disabled',true).val($('.m_listing tr:eq('+Idx_element+') td:eq(0)').text());
                $('.nuanses input').prop('disabled',false);
                $('.element, .nuanses').css('display','block');
                break;
            case '2':
                messageDlg = 'Специфические параметры';
                $('.nuanses #headDlg').html('<br>'+$('.m_listing tr:eq('+Idx_element+') td:eq(0)').text());
                $('.nuanses').css('display','block');
                $('.nuanses p input').prop('disabled',false);
                var idF = $($('.nuanses p input').first().prop('disabled',false)).attr('id')+arrNuansesCount;
                var idL = $($('.nuanses p input').last().prop('disabled',true)).attr('id')+arrNuansesCount;
                $($('.nuanses p input').first().prop('disabled',false)).attr('id',idF);
                $($('.nuanses p input').last().prop('disabled',true)).attr('id',idL);
                var firstOfPairs = $('.nuanses p input').first().prop("id");
                var lastOfPairs = $('.nuanses p input').last().prop("id");
                arrNuanses[arrNuansesCount] = [firstOfPairs,lastOfPairs];
                break;
            case '3':
                messageDlg = 'Новый компонент';
                $('#file-upload').prop('disabled',true);
                $('.component').css('display','block');               
                break;
        }
        $('#dlg_crs h1').html(messageDlg);
        return false;
    });
    // #detail_upload click
    $(".component #detail_upload, #detail_upload").click(function(){
        $("#expand2").click();
        $(".back_phone_DSh").css("display","block");
        $("#component_name_ds").html('<p> Компонент: '+$("#element_cod").val()+'</p>');
    });
    

    function clearForm() {
        
        $('.component, .nuanses, .element').css('display', 'none');
        $('.nuanses input').val('').remove(); // Удаляем все динамические поля
        $('.nuanses').append(`
                <p class="inputNuanseString">
                    <input type="text" class="nuanse-input" id="NameNuanse_0" required>
                    <input type="text" class="nuanse-input" id="CntNuanse_0">
                </p>
        `); // Восстанавливаем начальную пару полей
        arrNuanses = [[$('#NameNuanse_0'), $('#CntNuanse_0')]];
        arrNuansesCount = 0;
        $('#element_cod, #Pmax, #Umax, #Imax, #Fmax').val('');
        $('#Pmax, #Umax, #Imax, #Fmax').prop('disabled', true);
        $('#select_dlg').prop('disabled', true);
        $('#select_dlg option').prop('selected', false);
        ind = 0;
        $('#Result').empty();
        inputcontent = [];
        interrupt_off=false;
        $('#select_dlg option:first').text('Не выбран');
        };
        function clearFormDS(){
            console.log('form datasheet closed');
    };
    
    $("#collaps1_1").click(function (){
        $('.back_phone').css("display","none");
        clearForm();
    });
    $("#collaps2_1").click(function (){
        $('.back_phone_DSh').css("display","none");
        clearFormDS();
    });
    
    function onSelectChange(event) {
        const selectedValue = event.target.value;
        const vl = $("#select_dlg option:selected").text();
        const idx = $("#select_dlg option:selected").val();
        if(ind===0 && vl !== "Не выбран"){
            fill_in(vl,idx);
        }
    };   
    
    $(document).on('focus','.nuanses p.inputNuanseString input.nuanse-input',function() {
        if(!interrupt_off){
            const $this = $(this);
            const id = $this.attr('id');
            if (id.startsWith('NameNuanse_')) {
                $('#data_upload').prop('disabled', false);
            } else if (id.startsWith('CntNuanse_')) {
                speechClue('Двойной клик по "наименование" прерывает режим ввода');
                $('#data_upload').prop('disabled', true);
            }
        }
        return false;
    });
    
    $(document).on('dblclick','.nuanses p.inputNuanseString input.nuanse-input',function(){
        var $this = $(this);
        const id = $this.attr('id');
        if(id.startsWith('NameNuanse_')){
            speechClue('Пары, содержащие пустые поля не сохраняются.');
            interrupt_off = true;
            $('#data_upload').prop('disabled', false);
            $('#data_upload').focus();   
        } else {
            $this.focus();
            speechClue('Для удаления очистите поле "Значение".');
        }
        
    });
    
    $(document).on('blur','.nuanses p.inputNuanseString input.nuanse-input',function() {
        var $this = $(this);
        const id = $this.attr('id');
        const value = $this.val();
        const counter = arrNuanses.length-1;
        const index = +id.substr(id.indexOf('_')+1);
        var prevValue;
        var lastValue;
        const dutyIndex = ( index === counter ) ? arrNuansesCount: index; // переключение между режимом ввода и редактирования
        
        if (value.length === 0 && id.startsWith('CntNuanse_')){ // не допускаем пустого значения характеристики
            
            if(value.length === 0){
                speechClue('Прерывание ввода характеристик - двойной клик по любому полю "наименование"');
            }
            
            $('#'+arrNuanses[dutyIndex][1]).prop('disabled', false);
            $('#'+arrNuanses[dutyIndex][1]).focus();    
            return false;
        }
        
        prevValue = $('#'+arrNuanses[dutyIndex][0]).val();
        lastValue = $('#'+arrNuanses[dutyIndex][1]).val();
        if(prevValue.length >0 && lastValue.length > 0){
            raw_DialogArray[dutyIndex] = [prevValue, lastValue];
        }
        
        if (value.length > 0 && id.startsWith('NameNuanse_')) {
            if (arrNuanses[dutyIndex] && arrNuanses[dutyIndex][1]) {
                $('#'+arrNuanses[dutyIndex][1]).prop('disabled', false);
                $('#'+arrNuanses[dutyIndex][1]).focus();
            }
            
        } else if (value.length >= 0 && id.startsWith('CntNuanse_')) {
                
                if (!arrNuanses[arrNuansesCount]) {
                    console.error('Ошибка: arrNuanses не инициализирован');
                    return;
                }
                
                if(index === counter){ //  блок работает в режиме ввода новой записи
                    
                    prevValue = $('#'+arrNuanses[arrNuansesCount][0]).val();
                    arrNuansesCount++;
                    $('.nuanses p.inputNuanseString').append(`<input type="text" class="nuanse-input" id="NameNuanse_${arrNuansesCount}" required> `);
                    $('.nuanses p.inputNuanseString').append(`<input type="text" class="nuanse-input" id="CntNuanse_${arrNuansesCount}">`);        
                    arrNuanses[arrNuansesCount] = [
                        'NameNuanse_' + arrNuansesCount,
                        'CntNuanse_' + arrNuansesCount
                        ];
                    $('#'+arrNuanses[arrNuansesCount][0]).val(prevValue); // повторение последнего наименования характеристики
                    $('#'+arrNuanses[arrNuansesCount][0]).focus();
                }
                
            }
            return false;
    });
    
    $('#addbox').mouseover(function(){
        var sign = $("#select_dlg option:selected").text();
        if(sign ==="Не выбран"&& sign ==="Добавить")
            {$('#addbox').css('cursor','default');} else {$('#addbox').css('cursor','pointer');}
    });
    
    $('#addbox').click(function(){
        const vl = $("#select_dlg option:selected").text();
        const idx = $("#select_dlg option:selected").val();
        if($.inArray(idx,inputcontent)===-1 && (vl !== "Не выбран" && vl !== "Добавить" )){
            fill_in(vl,idx);
        }
        $('#select_dlg option:first').prop('selected',true);
        
    });
    
    function ay_yay_ay(obj){
        $(obj).css('backgroundColor', 'red');
        setTimeout(() => {
            $(obj).css('backgroundColor', '');
            $(obj).focus();
        }, 1000);            
        $(obj).focus();
    };
    
    function speechClue(clue){
        $('.clue').text(clue); 
        setTimeout(() => {
            $('.clue').text('');
        }, 6000);
    }
   
    function fill_in(vl,idx){
            inputcontent[ind] = [idx,vl];
            const what=`prev_${ind}`;
            $("#Result").append('<p><input type="text" id="'+what+'" form="f_el_list" /></p>');
            $("#"+what).val(vl).prop('disabled',true);
            ind = ind+1;
            $('#select_dlg option:first').prop('selected',true);
            $('#select_dlg option:first').text('Добавить');
    };
    
    function saveFormData(){ // Управление диалогом на первой вкладке страницы реализация меню в списке элементов 
        $.ajax({
            url:'interface/modelTableDataOperator.php',
            type:'POST',
            cache: false,
            processData:true,
            data: JSON.stringify(m_formData),
            contentType:'json',
            success: function(msg){
                console.log(msg);    
            }
        });
    };
    
    function prepareFormData(){ // Следим за отклонениями от правильности заполнения формы f_el_list
        m_formData = {
            "elenent_indx"  : Idx_element,
            "element_cod"   : "'"+$('#element_cod').val()+"'",
            "Pmax"          : ($('#Pmax').val().length)>0   ? "'"+$('#Pmax').val().replaceAll(',','.')+"'" : null,
            "Umax"          : "'"+$('#Umax').val().replaceAll(',','.')+"'",
            "Imax"          : "'"+($('#Imax').val()).replaceAll(',','.')+"'",
            "Fmax"          : "'"+$('#Fmax').val().replaceAll(',','.')+"'",
            "FName"         : ($('#dataUpload_done').length) ? "'"+$('#dataUpload_done').val()+"'" : null,
            "array_string"  : arr2string 
        };
    //
    };
    
    $('#Umax,#Imax,#Fmax').focusout(function(e){
        if($(this).val().length === 0){
            ay_yay_ay(this);
            $(this).css('backgroundColor','');
        };
        speechClue('Требуется числовое значение в поле');
    });
    
    function readFieldDial(){
        //readyNuanceForSave
        
    };
    $("#data_upload").click(function(event){
        event.stopPropagation();
        event.preventDefault();
        speechClue('Сохранение данных');
        var furl='';
        if(menu_action === 3){
            furl = 'interface/modelOperatorDataSheetUpload.php';
            if($("#select_dlg option:selected").text()==='Не выбран'){ay_yay_ay("#select_dlg");return false;}
            if ($('#Umax').val()===''){ay_yay_ay('#Umax');return false;}
            if ($('#Imax').val()===''){ay_yay_ay('#Imax');return false;}
            if ($('#Fmax').val()===''){ay_yay_ay('#Fmax');return false;}
            var t_data = new FormData();
            t_data.append('files',$("#file-upload")[0].files[0]);
            $.ajax({
                url:furl,
                type:"POST",
                cache:false,
                contentType:false,
                processData:false,
                data:t_data,
                dataType:'json',
                success: function(msg){ // при наличии внешнего datasheet от производителя компонента сохраняем 
                    //его, при отсутствии сохраняем в базе данных более подробные характеристики 
                    console.log(msg); // отладочное. Если загружен DSh, то будет true, ну или не будет ничего, если файл не загружен
                    arr2string = inputcontent.join('_');
                    prepareFormData();
                    speechClue('Данные сохранены!');
                    saveFormData();
                    clearForm();
                },
                error: function(error){
                    speechClue('Ошибка сохранения данных');
                    alert(error);
                }
            });
            $('#file-upload').val(null);
        } else {
            readFieldDial();
            let action ='';
            
            switch (menu_action){
                case 0:
                    break;
                case 1:
                    break;
                case 2:
                    break;
            };
            $.ajax({
                url: furl,
                type: "POST",
                action: action,
                dataType: 'json',
                data: readFieldDial(),
                success: function(response) {
                    alert(response);
                },
                error: function(error){
                    alert(error,' Ошибка сохранения');
                }
            });
        }
         
     });
 
</script>
