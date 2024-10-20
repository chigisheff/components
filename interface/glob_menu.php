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
<div class="glob_menu"> 
        <!--input list="group" id="grouplist" name="listgroup" class="f_select_d"-->
        <!--datalist  id="group"-->
        <select id="group" name="item" id="grouplist" class="f_select_d">            
<?php   $pi->putDataSelectOptions($row,'Все'); ?>
        </select>
        <!--/datalist-->
        <form>
            <label for="SMD">SMD</label>
            <input id="SMD" type="checkbox">
            U(v)  ≤
            <input type="text" class="f_select_s" id="Uv">
            I(a)  ≤
            <input type="text" class="f_select_s" id="Ia">
            F(MHz)
            <input type="text" class="f_select_s" id="Fmhz">
            <button class="bonoff" disabled>фильтр</button>
        </form>
</div>