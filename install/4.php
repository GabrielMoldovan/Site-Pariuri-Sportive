<?php
if(isset($_POST['submit']))
{
  if((isset($_POST['pass'])) && (isset($_POST['payacc'])))
  {
    $pass = $_POST['pass'];
    $payacc = $_POST['payacc'];
    $SQL = mysql_query("INSERT into `accounts` (`uname`, `pass`, `email`, `money`) VALUES ('admin', '" . md5($pass) . "', 'default@default.com', '1000')") or die(mysql_error());
    $SQL = mysql_query("UPDATE `settings` set `setvalue` = '" . $payacc . "' WHERE `setname` = 'paypalacc'") or die (mysql_error());
    echo "You succesfully installed the script!Please delete the install folder!";
  }
  else
  {
    echo "All fields must be completed! <a href='index.php?n=3'>Back</a>.";
  }
}
else
{
  echo "You didn't pressed submit! <a href='index.php?n=3'>Back</a>.";
}
?>