<?php
if(isset($_GET['n']))
{
  $n = $_GET['n'];
  switch($n)
  {
    case 1:
      include_once "1.php";
    break;
    case 2:
      include_once "engine/functions.php";
      include_once "2.php";
    break;
    case 3:
      include_once "3.php";
    break;
    case 4:
      include_once "include/config.php";
      include_once "engine/functions.php";
      include_once "4.php";
    break;
  }
}
else
{
   echo "<a href='index.php?n=1'>Let's begin!</a>";
}
?>