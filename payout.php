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
                                        <div class="std"><h2 align='left'>Retragere fonduri</h2><p align='left'>De aici iti poti emite o cerere de retragere fonduri catre paypal!</p>
<?php
$uname = $_SESSION['uname'];
$SQL = mysql_query("SELECT * FROM `accounts` WHERE `uname` = '" . $uname . "'") or die (mysql_error());
$row = mysql_fetch_array($SQL);
$moneyc = $row['money'];
$emailc = $row['email'];
if(isset($_POST['submit']))
{
  if((isset($_POST['email'])) && (isset($_POST['money'])))
  {
    $email = $_POST['email'];
    $money = $_POST['money'];
    if($moneyc >= $money)
    {
      $moneyn = $moneyc - $money;
      mysql_query("UPDATE `accounts` set `money` = '" . mysql_real_escape_string($moneyn) . "'") or die (mysql_error());
      mysql_query("INSERT into `payout` (`id`, `email`, `sum`) VALUES ('', '" . mysql_real_escape_string($email) . "', '" . mysql_real_escape_string($money) . "')") or die (mysql_error());
      echo "Comanda a fost depusa cu succes!Administratorul o va aproba in cel mai scurt timp!";
    }
    else
    {
      echo "Nu ai atatia bani!<a href='payout.php'>Inapoi</a>!";
    }
  }
  else
  {
    echo "Toate campurile trebuie completate!<a href='payout.php'>Inapoi</a>!";
  }
}
else
{
?>
    <form action='payout.php' method='post'>
     <p>
	<label>Suma: </label><input type='text' name='money'>
	<br class="clearAll" />
     </p>
     
     <p>
	<label>Catre email: </label><input type='text' name='email'>
	<br class="clearAll" /><br />
     </p>
   
     <p><input type="submit" name='submit' value="Trimite Cererea" /></p>
    </form>
<?php
}
include_once "include/footer.php";
?>
