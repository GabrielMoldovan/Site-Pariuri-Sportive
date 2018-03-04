<?php
if(!((isset($_SESSION['uname']))))
{
 if($_SESSION['uname'] != 'admin')
 {
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'login.php';
  header("Location: http://$host$uri/$extra");
  echo "<a href='index.php'>Eroare de sesiune!</a>";
  exit;
 } 
}
?>