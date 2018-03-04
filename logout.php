<?php
session_start();
include_once "engine/verify.php";
include_once "include/lhead.php";
include_once "engine/config.php";
include_once "include/loginmic.php";
include_once "include/lmenu.php";
?>
</div>

</div>
        <div class="main-container col2-right-layout">
            <div class="main">
                                <div class="col-main">
                                        <div class="std">
         <h2 align='left'>Logout</h2>
         Logout-ul s-a desfasurat cu succes!
         <?php
         unset($_SESSION['uname']);
         ?>
         <script>document.location.href='index.php'</script>
         <?php
         session_destroy();
         ?>
                                        
                                        

<?php
include_once "include/footer.php";
?>
