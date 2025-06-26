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
            <p>DataSheet</p>
            <input type="file" id="file-upload" accept=".pdf,.doc,.docx,.xlsx,.xls,.odt,.ods" name="file_push" disabled/>
            <p></p>
            <hr>
            
        </form>
        <p><button type="button" id="detail_upload" name="datasheet_up" disabled>Datasheet</button></p>
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

