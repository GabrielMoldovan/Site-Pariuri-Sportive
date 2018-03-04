<?php
if(isset($_GET['id']))
{
  $id = mysql_real_escape_string($_GET['id']);
  $SQL = mysql_query("SELECT * FROM `meciuri` WHERE `id` = '" . $id . "'") or die (mysql_error());
  $row = mysql_fetch_array($SQL);
  $team1 = $row['team1'];$team1c = $row['team1c'];
  $team2 = $row['team2'];$team2c = $row['team2c'];
  $teamx = $row['teamx'];
  if(isset($_POST['submit']))
  {
    if(isset($_POST['rez']))
    {
      $rez = mysql_real_escape_string($_POST['rez']);
      if(($rez >= 0) && ($rez <= 2))
      {
        $SQL2 = mysql_query("SELECT * FROM `pariu` WHERE `pid` = '" . $id . "'") or die (mysql_error());
        $fail = 0; $succ = 0; $sum = 0; $sum2 = 0;
        if($rez == 0)
        {
          $cotawin = "teamx";
        }
        else
        {
         $cotawin = "team" . $rez . "c";
        }
        $cotacastigatoare = $row[$cotawin];
        $server  = $_SERVER['HTTP_HOST'];
        $subjectwin = 'Ai castigat pariul!';
        $subjectfail = 'Ai pierdut pariul!';
        $headers = 'From:bet@' . $server . "\r\n";
        while($row2 = mysql_fetch_array($SQL2))
        {
          $unamewin = $row2['uname'];
          $what = mysql_query("SELECT * FROM `accounts` WHERE `uname` = '" . $unamewin . "'") or die (mysql_error());
          $what2 = mysql_fetch_array($what);
          $money = $what2['money'];
          $email = $what2['email'];
           if($row2['team'] == $rez)
           {
             $money = $money + $row2['suma']*$cotacastigatoare;
             mysql_query("UPDATE `accounts` set `money` = '" . $money . "' WHERE `uname` = '" . $unamewin . "'") or die (mysql_error());
             $succ++;
             $sum = $sum + $row2['suma'];
             $win = 'Salut, ' . $unamewin . '
             ai castigat suma de ' . $row2['suma']*$cotacastigatoare . ' EUR
             la pariul tau!';
             mail($email, $subjectwin, $win, $headers);
           }
           else
           {
             $fail++;
             $fail2 = 'Salut, ' . $unamewin . '
             nu ai castigat nimic la pariul pe care l-ai depus!';
             $sum2 = $sum2 + $row2['suma'];
             mail($email, $subjectfail, $fail2, $headers);
           }
        }
        $sum = $sum*$cotacastigatoare;
        mysql_query("DELETE FROM `pariu` WHERE `pid` = '" . $id . "'") or die (mysql_error());
        mysql_query("DELETE FROM `meciuri` WHERE `id` = '" . $id . "'") or die (mysql_error());
        echo "Premiile au fost acordate,mail-urile au fost trimise!<br><font color='darkgreen'>In total " . $succ . " au castigat in total " . $sum . " EUR</font><br><font color='darkred'>iar " . $fail . " au pierdut in total . " . $sum2 . " EUR!</font>";
      }
      else
      {
        echo "Rezultatul final trebuie sa fie o valoare intre 0 si 2!<a href='admin.php?n=3&id=" . $id . "'>Inapoi</a>!";
      }
    }
    else
    {
      echo "Toate campurile sunt necesare!<a href='admin.php?n=3&id=" . $id . "'>Inapoi</a>!";
    }
  }
  else
  {
    echo "<form action='admin.php?n=3&id=" . $id . "' method='POST'>";
    echo "<p>La rezultat final alegeti o valoare intre 0 1 si 2,<br><br><b>0</b> reprezinta <b>egalitate</b>,<br><b>1</b> reprezinta faptul ca echipa <b>" . $team1 . "</b> a castigat,<br> <b>2</b> reprezinta faptul ca echipa <b>" . $team2 . "</b> a castigat.</p>";
    echo '<p><label><strong>Rezultat final: </strong></label><input name="rez" type="text" /><br></p><br><br>';
    echo '<p><br /><br /><input type="submit" value="Acorda premii!" name="submit"/></p>';
    echo "</form>";
  }
}
else
{
  echo "<font color='red'>ATENTIE!</font>Aici vor aparea doar meciurile care au trecut de 'data pana la pariu'<br>Pentru a incepe,apasa pe un meci!";
  echo "<table cellspacing='0'>";
  echo "<tr><th>Meci</th><th>Detalii</th></tr>";
  $x1 = 0;
  $SQL = mysql_query("SELECT * FROM `meciuri` ORDER BY `id` DESC") or die (mysql_error());
  while($row = mysql_fetch_array($SQL))
  {
   if(strtotime("now") >= $row['date'])
   {
    echo "<tr>";
    echo "<td><a href='admin.php?n=3&id=" . $row['id'] . "'><u>" . $row['team1'] . "</u> vs <u>" . $row['team2'] . "</u></a>";
    echo "<td>";
    echo "COTA(1 : X : 2)";
    echo "<br>" . $row['team1c'] . " : " . $row['teamx'] . " : " . $row['team2c'];
    echo "<br>Ultimul pariu a fost pana la data de: " . date("d-m-Y", $row['date']);
    echo "</td>";
    echo "</tr>";
    $x1++;
   }
  }
  if($x1 == 0)
  {
    echo "<tr><td>Momentan la nici-un meci nu poate fi setat rezultatul!</td><td></td></tr>";
  }
  echo "</table>";
}
?>