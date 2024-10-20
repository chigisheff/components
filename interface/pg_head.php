<div class="H_d">
<?php $domen= $_SERVER['REQUEST_SCHEME'] . "://". $_SERVER['HTTP_HOST'] ."/";?>
    <div class="logo_s"><a href="<?php echo $domen;?>"><img src="img/logos.png"></a></div>
    <div class="head_prod"> <a href="<?php echo $domen;?>"> Список компонентов </a> </div>
    <?php include_once 'glob_menu.php'; ?>
</div>

    <dialog id="my-dialog" class="type_r_input">
        <p>Это простое диалоговое окно.</p>
        <button id="close-dialog-btn">Закрыть</button>
    </dialog>
    <!--script>
        const showDialogBtn = document.querySelector('#grouplist');
        const myDialog = document.querySelector('#my-dialog');
        const closeDialogBtn = document.querySelector('#close-dialog-btn');

        showDialogBtn.addEventListener( 'dblclick', () => {
            myDialog.showModal();
        });

        closeDialogBtn.addEventListener('click', () => {
            myDialog.close();
        });
    </script-->
