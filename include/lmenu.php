<ul id="nav">

<li class="level0 nav-1 level-top first">
<a class="level-top" href="logged.php">
<span>HOME</span></a></li>

<li class="level0 nav-1 level-top first">
<a class="level-top" href="bet.php">
<span>PARIURI</span></a></li>

<li class="level0 nav-1 level-top first">
<a class="level-top" href="adauga.php">
<span>ADAUGARE FONDURI</span></a></li>

<li class="level0 nav-1 level-top first">
<a class="level-top" href="payout.php">
<span>RETRAGERE FONDURI</span></a></li>

<li class="level0 nav-1 level-top first">
<a class="level-top" href="opt.php">
<span>MODIFICARE DATE</span></a></li>

<li class="level0 nav-1 level-top first">
<a class="level-top" href="logout.php">
<span>LOGOUT</span></a></li>

<?php
$uname = $_SESSION['uname'];
$sql = mysql_query("SELECT * FROM `accounts` WHERE `uname` = '" . $uname . "'") or die (mysql_error());
$row2 = mysql_fetch_array($sql);
$moneyclient = $row2['money'];
?>

<li class="level0 nav-1 level-top first">
<a class="level-top" href="#">
<span><b>Bani: <?php echo $moneyclient; ?> EUR</b></span></a></li>

<?php
if($_SESSION['uname'] == 'admin')
{
  ?>
  <li class="level0 nav-1 level-top first">
  <a class="level-top" href="admin.php">
  <span>ADMINCP</span></a></li>
  <?php
}
?>

</ul>
