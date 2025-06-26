<?php
require_once 'class/modelItemList.php';
require_once 'class/viewTableItem.php';
$p = new modelItemList();
$pi = new viewTableItem();
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
        <form>
            <label for="SMD">SMD</label>
            <input id="SMD" type="checkbox">
            P(w)  ≤
            <input type="number" class="f_select_s" id="Pw">
            U(v)  ≤
            <input type="number" class="f_select_s" id="Uv">
            I(a)  ≤
            <input type="number" class="f_select_s" id="Ia">
            F(mHz)
            <input type="number" class="f_select_s" id="Fmhz">
            <button class="bonoff" disabled>фильтр</button>
        </form>
</div>
<script  type="text/javascript">
    $(".glob_menu").on('change', function(e){
        $('.bonoff').attr('disabled',false);
    });
</script>