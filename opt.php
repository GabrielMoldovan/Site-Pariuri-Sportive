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
                                        <div class="std"> <h2 align='left'>Modificare Date</h2>
<?php
if(isset($_POST['submit']))
{
  if((isset($_POST['cpass'])) && (isset($_POST['passn1'])) && (isset($_POST['passn2'])))
  {
    $cpass = mysql_real_escape_string($_POST['cpass']);
    $uname = $_SESSION['uname'];
    $SQL = mysql_query("SELECT * FROM `accounts` WHERE `uname` = '" . $uname . "' and `pass` = '" . md5($cpass) . "'") or die (mysql_error());
    if(mysql_fetch_array($SQL))
    {
      $passn1 = mysql_real_escape_string($_POST['passn1']);
      $passn2 = mysql_real_escape_string($_POST['passn2']);
      if($passn1 == $passn2)
      {
        mysql_query("UPDATE `accounts` set `pass` = '" . md5($passn1) . "' WHERE `uname` = '" . $uname . "'") or die (mysql_error());
        echo "Date modificate cu succes!<a href='logged.php'>Catre zona membrilor</a>!";
      }
      else
      {
        echo "Cele doua parole nu se potrivesc!<a href='opt.php'>Inapoi</a>!";
      }
    }
    else
    {
      echo "Parola curenta a fost gresita!<a href='opt.php'>Inapoi</a>!";
    }
  }
  else
  {
    echo "Toate campurile sunt necesare!<a href='opt.php'>Inapoi</a>!";
  }
}
else
{
?>
   <form action='opt.php' method='post'>
   <p>
	<label>Parola curenta: </label><input type='text' name='cpass'>
	<br class="clearAll" />
   </p>
   
   <p>
	<label>Parola noua: </label><input type='text' name='passn1'>
	<br class="clearAll" />
   </p>

   <p>
	<label>Parola noua(iarasi): </label><input type='text' name='passn2'>
	<br class="clearAll" /><br />
   </p>

   <p><input type="submit" name='submit' value="Modificare!" /></p>

   </form>
<?php
}
include_once "include/footer.php";
?>
