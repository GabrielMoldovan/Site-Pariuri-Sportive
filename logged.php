<?php
session_start();
include_once "engine/verify.php";
include_once "include/head.php";
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
    <h1>Bine ai venit, <?php echo $_SESSION['uname'] ?> !</h1><br>
                             <br>

    <h1>Iti dorim mult succes. 	</h1> 
      <br><br><br><br><br>
                                        
                                        
                                        

<?php
include_once "include/footer.php";
?>
