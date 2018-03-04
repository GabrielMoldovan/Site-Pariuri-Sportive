<?php
error_reporting(0);
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
                                        <div class="std"><h2 align='left'>Adauga fonduri</h2>
                                        <p align='left'>Adauga fonduri folosid contul de paypal.</p>

<?php
if(isset($_POST['submit']))
{
  $suma = trim($_POST['suma']);
                 $suma = explode(".",$suma);
                 if(substr($suma[1],1,1) == ""){
                        $suma[1] = $suma[1] . "0";
                 }
                 else
                 {
                   $suma = $suma . ".00";
                 }
                 $suma = $suma[0]. "." .$suma[1];
                 $SQL = mysql_query("SELECT * FROM `settings` WHERE `setname` = 'paypalacc'") or die(mysql_error());
                 $row = mysql_fetch_array($SQL);
                 $paypal = $row['setvalue'];
                 $mesaj = "Reincarcare cu " . $suma . " EUR";
                 require_once('paypal/paypal.php');
                 $server=$_SERVER['HTTP_HOST'];
                 $address = $server . "/paypal/ipn.php";
                 $buyNow = new Paypal;
                 $buyNow->addVar('business',$paypal);
                 $buyNow->addVar('cmd','_xclick');
                 $buyNow->addVar('amount',$suma);
                 $buyNow->addVar('no_shipping','1');
                 $buyNow->addVar('item_name',$mesaj);
                 $buyNow->addVar('quantity','1');
                 $buyNow->addVar('currency_code', 'EUR');
                 $buyNow->addVar('rm','2');
                 $buyNow->addVar('notify_url',$address);
                 $buyNow->addButton(1);
                 $buyNow->showForm();
}
else
{
   echo "<form action='adauga.php' method='POST'>";
   echo '<p><label><strong>Suma: </strong></label><input name="suma" type="text" /><br></p>';
   echo '<p><br /><br /><input type="submit" value="Plateste!" name="submit"/></p>';
   echo '</form>';
   ?>
       <br><br><br>
      
   <?php
}
?>
                                        

<?php
include_once "include/footer.php";
?>
