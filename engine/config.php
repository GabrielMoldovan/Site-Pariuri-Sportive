<?php
$dbuser = "root";
$dbhost = "localhost";
$dbpass = "";
$db = "bet";
$con = mysql_connect($dbhost,$dbuser,$dbpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($db, $con);
?>
