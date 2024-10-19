<?php
class q_interface extends classBase{
    public function putDataSelectOptions($inwar, $allselect = ''){
        if($allselect ){
        ?>
            <option value="16777214"> <?php echo $allselect ?></option> <?php
        }
        foreach ($inwar as $str) {
        ?><option value="<?php echo $str[0]; ?>"><?php echo $str[1]; ?></option><?php
        }
    }
    private function putDataColTableTools($menu_y=false, $menu_pos=0,$arrayind,$i=0,$j=0,$key=false){
        //$meny_y - признак включения инструметов
        //$menu_pos - номер столбца для размещения
        //$arrayind - индекс в обрабатываемом массиве
        //$i=0,$j=0 - индексы вывода основного списка из запроса
        //$key - управление состоянием кнопки инструмета TO_DO
        if($menu_y && $j == $menu_pos) {
?>
            <div class="content_menu">
                <button class="content_menu actived" " 
                        id ="<?php echo 'm_' . $i . '_' . $arrayind . '_0'; ?>"
                        value="<?php echo $arrayind;?>"><img src="img/add.v1.png" />
                        <span>Добавить</span> </button>
                <button disabled class="content_menu" 
                        "id ="<?php echo 'm_' . $i . '_' . $arrayind . '_1'; ?>"
                        value="<?php echo $arrayind; ?>">
                        <img src="img/redact.v1.png" /> <span>Изменить</span> </button>
                
            </div>
            <?php
        }
    }
    public function putDataSelectTable($array, $out, $cols = 1, $position = 0, $menu_y = false, $menu_pos = 0){
        //$array - собственно... массив с информацией
        //$out - индекс списка в массиве
        //$cols - индекс колонки таблицы
        //$position - номер колонки вывода
        //$menu_y - разрешение вывода меню в таблице
        //$menu_pos - индекс позиции меню в таблице

        $stop = count($array);
        for ($i = 0; $i < $stop; $i++){
        ?>
        <tr style="color: darkgreen;">
        <?php
        for($j = 0; $j < $cols;$j++){
                ?><td style="vertical-align: middle; ">  <?php
                if($j == $position){
                    echo $array[$i][$out]; //Размещаем список
                    
                    
                }
            $this->putDataColTableTools($menu_y, $menu_pos,$array[$i][0],$i,$j, false);
        ?></td> <?php
    }
    ?></tr> 
    <?php
}

}
}