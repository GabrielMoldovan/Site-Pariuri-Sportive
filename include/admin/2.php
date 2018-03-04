<?php
if(isset($_GET['id']))
{
  $id = mysql_real_escape_string($_GET['id']);
  mysql_query("DELETE FROM `meciuri` WHERE `id` = '" . $id . "'") or die (mysql_error());
  mysql_query("DELETE FROM `pariu` WHERE `pid` = '" . $id . "'") or die (mysql_error());
  echo "Meciul a fost sters cu <font color='darkgreen'>succes</font>!<a href='admin.php?n=2'>Inapoi la stergere meciuri</a>.";
}
else
{
  echo "<font color='red'>ATENTIE!</font> Daca apesi pe un meci il vei sterge impreuna cu toate pariurile facute pe el!";
  echo "<table cellspacing='0'>";
  echo "<tr><th>Meci</th><th>Detalii</th></tr>";
  $x1 = 0;
  $SQL = mysql_query("SELECT * FROM `meciuri` ORDER BY `id` DESC") or die (mysql_error());
  while($row = mysql_fetch_array($SQL))
  {
   if(strtotime("now") <= $row['date'])
   {
    echo "<tr>";
    echo "<td><a href='admin.php?n=2&id=" . $row['id'] . "'><u>" . $row['team1'] . "</u> vs <u>" . $row['team2'] . "</u></a>";
    echo "<td>";
    echo "COTA(1 : X : 2)";
    echo "<br>" . $row['team1c'] . " : " . $row['teamx'] . " : " . $row['team2c'];
    echo "<br>Pariuri pana la data de: " . date("d-m-Y", $row['date']);
    echo "</td>";
    echo "</tr>";
    $x1++;
   }
  }
  if($x1 == 0)
  {
    echo "<tr><td>Momentan nu au fost adaugate meciuri!</td><td><a href='admin.php?n=1'>Adauga unul acum!</a></td></tr>";
  }
  echo "</table>";
}
?>