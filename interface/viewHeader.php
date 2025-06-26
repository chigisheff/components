<div class="H_d">
<?php $domen= $_SERVER['REQUEST_SCHEME'] . "://". $_SERVER['HTTP_HOST'] ."/";?>
    <div class="logo_s"><a href="<?php echo $domen;?>"><img src="img/logos.png"></a></div>
    <div class="head_prod"> 
        <a href="<?php echo $domen;?>"> Список компонентов </a>&nbsp; &nbsp;
        <a href="<?php echo $domen;?>/dataop.php"> (Отладочная) Оператор</a>&nbsp; &nbsp;
        <a href="<?php echo $domen;?>/admin.php"> (Отладочная) Администрированное</a>
    </div>
    <?php include_once 'viewGlobalMenu.php'; ?>
</div>