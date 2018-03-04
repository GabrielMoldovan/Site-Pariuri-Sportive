<?php
if(isset($_GET['del']))
{
  $del = mysql_real_escape_string($_GET['del']);
  mysql_query("DELETE FROM `payout` WHERE `id` = '" . $del . "'") or die (mysql_error());
  echo "Cererea cu id-ul " . $del . " a fost stearsa cu succes!<a href='admin.php?n=4'>Inapoi</a>";
}
else
{
  echo "Stergeti cererile de plata din baza de date(dupa ce le platiti) pentru a tine o evidenta mai usoara!";
  echo "<br>Cand stergeti cererile,clientul nu va primi inapoi banii pe care i-a cerut!";
  echo "<table cellspacing='0'>";
  echo "<tr><th>Catre email</th><th>Suma de</th><th></th></tr>";$x1 = 0;
  $SQL = mysql_query("SELECT * FROM `payout` ORDER BY `id` ASC") or die (mysql_error());
  require_once('paypal/paypal.php');
  $mesaj = "Retragere bani";
  while($row = mysql_fetch_array($SQL))
  {
    $suma = $row['suma'];
    echo "<tr>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $suma . " EUR</td>";
    echo "<td>";
    $buyNow = new Paypal;
    $buyNow->addVar('business',$row['email']);
    $buyNow->addVar('cmd','_xclick');
    $buyNow->addVar('amount',$suma);
    $buyNow->addVar('no_shipping','1');
    $buyNow->addVar('item_name',$mesaj);
    $buyNow->addVar('item_number','1');
    $buyNow->addVar('quantity','1');
    $buyNow->addVar('currency_code', 'EUR');
    $buyNow->addVar('rm','2');
    $buyNow->addButton(1);
    $buyNow->showForm();
    echo "<br><br>";
    echo "<a href='admin.php?n=4&del=" . $row['id'] . "'>Sterge cererea</a>";
    echo "</td>";
    echo "</tr>";$x1++;
  }
  if($x1 == 0)
  {
    echo "<tr><th>Momentan nu exista cereri de retragere bani!</th><th></th><th></th></tr>";
  }
  echo "</table>";
}
?>