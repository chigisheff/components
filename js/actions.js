var win_size = new Array();
    var blck;
    var ind = 0;
    var Idx_element;
    var unputcontent=[];
    var files;
    var arr2string='';
    var old_content_span = "Компоненты : ";
    var m_formData;
    var openPage = 1;
    
    $('.m_listing tr').click(function(e){
        //console.log($(this).index());
        //console.log($(this).find('td').text());
        var title_tab = ($(this).find('td').eq(0).text()).trim();
        $('#list_three span').text('');
        $($('#list_three span')).text(old_content_span+' '+title_tab);
    });
    
    $('#element_cod').focusout(function(){
        if($('#element_cod').val() !== ''){
            $('#select_dlg').prop('disabled',false).focus();
            $('#Pmax').prop('disabled',false);
            $('#Umax').prop('disabled',false);
            $('#Imax').prop('disabled',false);
            $('#Fmax').prop('disabled',false);
            $('#file-upload').prop('disabled',false);
            $('#data_upload').prop('disabled',false);
            $('#detail_upload').prop('disabled',false);
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
    
    /*function menu_switch(obj){    
        $('#expand1,#expand2,#expand3').attr('disabled', false);
        $(own_expand).attr('disabled',true);
    };*/
    
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
        //menu_switch($(this));
        $(new_pad).addClass('content_pad_page_collapsed').removeClass('content_pad_page');
        $(cr_pad).removeClass('content_pad_page_collapsed').addClass('content_pad_page');
        return false;
    });
    
    $('#collaps1,#collaps2,#collaps3').click(function () {
        const saved_wnd = $(this).attr('id').slice(-1); // вкладка включающая сработавшую кнопку
        openPage = (openPage < 3) ? openPage+1:1;
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
        $('.back_phone').css("display","block");
        const Id = $(this).attr('id');
        const val = $(this).attr('value');
        const funct = Id.slice(-1);
        Idx_element = (Id.split('_'))[2];
        $("#dlg_crs").attr('data-id',Id);
        if(funct === '0'){$('#dlg_crs h1').html('Новый компонент<br>');}
        else{$('#dlg_crs h1').html('Изменение компонента');}
        win_size = [$('#dlg_crs').width(), $('#dlg_crs').height()];
        const pos = $('.content_pad_page').offset().top;
        if(funct === '0'){$('#element_cod').focus();}
        $('.content_pad_page').scrollTop(-pos);
        
        return false;
    });
    
    function clearForm(){
        $('#element_cod,#Pmax,#Umax,#Imax,#Fmax').val('');
        $('#Pmax,#Umax,#Imax,#Fmax').prop('disabled',true);
        $('№select_dlg').prop('disabled','disabled');
        $('#select_dlg option').prop('selected',false);
        ind=0;
        $('#Result').empty();
        unputcontent = [];
        $('#select_dlg option:first').text('Не выбран');
    };
    
    $("#collaps1_1").click(function (){
        $('.back_phone').css("display","none");
        clearForm();
    });
    
    function onSelectChange(event) {
        const selectedValue = event.target.value;
        const vl = $("#select_dlg option:selected").text();
        const idx = $("#select_dlg option:selected").val();
        if(ind===0 && vl !== "Не выбран"){
            fill_in(vl,idx);
        }
    };
    
    $('#addbox').mouseover(function(){
        var sign = $("#select_dlg option:selected").text();
        if(sign ==="Не выбран"&& sign ==="Добавить")
            {$('#addbox').css('cursor','default');} else {$('#addbox').css('cursor','pointer');}
    });
    
    $('#addbox').click(function(){
        const vl = $("#select_dlg option:selected").text();
        const idx = $("#select_dlg option:selected").val();
        if($.inArray(idx,unputcontent)===-1 && (vl !== "Не выбран" && vl !== "Добавить" )){
            fill_in(vl,idx);
        }
        $('#select_dlg option:first').prop('selected',true);
        
    });
    
    function ay_yay_ay(obj){
        //prev = $(obj).css('backgroundColor');
        blck = setTimeout(function(){
            $(obj).css('backgroundColor',"red");
            setInterval(function(){
            blck = setTimeout(function(){$(obj).css('backgroundColor','');});
            },1000);
        },500);
            
        $(obj).focus();
    };
   
    function fill_in(vl,idx){
        var f_data = '';
            f_data = idx; 
            unputcontent[ind] = f_data;
            const what=`prev_${ind}`;
            $("#Result").append('<p><input type="text" id="'+what+'" form="f_el_list" /></p>');
            $("#"+what).val(vl).prop('disabled',true);
            ind = ind+1;
            $('#select_dlg option:first').prop('selected',true);
            $('#select_dlg option:first').text('Добавить');
    };
    
    function saveFormData(){
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
        var f = !$.trim($('#Pmax').val().replaceAll(',','.').length);
        m_formData = {
            "elenent_indx"  : Idx_element,
            "element_cod"   : "'"+$('#element_cod').val()+"'",
            "Pmax"          : ($('#Pmax').length)<1   ? "'"+$('#Pmax').val().replaceAll(',','.')+"'" : null,
            "Umax"          : "'"+$('#Umax').val().replaceAll(',','.')+"'",
            "Imax"          : "'"+($('#Imax').val()).replaceAll(',','.')+"'",
            "Fmax"          : "'"+$('#Fmax').val().replaceAll(',','.')+"'",
            "FName"         : ($('#dataUpload_done').length) ? "'"+$('#dataUpload_done').val()+"'" : null,
            "array_string"  : arr2string //
        };
    //
    };
    
    $('#Umax,#Imax,#Fmax').focusout(function(e){
        if($(this).val().length === 0){
            ay_yay_ay(this);
            $(this).css('backgroundColor','');
        };
    });
    
    $("#data_upload").click(function(event){
        event.stopPropagation();
        event.preventDefault();
        if($("#select_dlg option:selected").text()==='Не выбран'){ay_yay_ay("#select_dlg");return false;}
        if ($('#Umax').val()===''){ay_yay_ay('#Umax');return false;}
        if ($('#Imax').val()===''){ay_yay_ay('#Imax');return false;}
        if ($('#Fmax').val()===''){ay_yay_ay('#Imax');return false;}
        var t_data = new FormData();
        t_data.append('files',$("#file-upload")[0].files[0]);
        $.ajax({
            url:'interface/modelOperatorDataSheetUpload.php',
            type:"POST",
            cache:false,
            contentType:false,
            processData:false,
            data:t_data,
            dataType:'json',
            success: function(msg){
                console.log(msg);
                if(unputcontent.length>1){
                arr2string = unputcontent.join('_');
                } else {arr2string = unputcontent[0][0];}
                prepareFormData();
                saveFormData();
                clearForm();
            },
            error: function(error){
                alert(error);
            }
        });
        $('#file-upload').val(null);
     });


