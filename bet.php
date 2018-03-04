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
                                      
                                       

<?php
if((isset($_GET['cat'])) || (isset($_GET['prod'])))
{
 if(isset($_GET['cat']))
 {
  switch($_GET['cat'])
  {
    case 'fotbal':
    $cat = 'Fotbal'; //modifici link-uri dar uiti de php, care se bazeaza pe structura link-ului
    break;
    case 'hockey':
    $cat = 'Hockey';
    break;
    case 'baschet':
    $cat = 'Baschet';
    break;
    default:
    die("Error!<a href='bet.php'>Inapoi</a>!");
    break;
  }
  $SQL = mysql_query("SELECT * FROM `meciuri` ORDER by `id` DESC") or die (mysql_error());
  echo "To bet on a tie in a game, press on 'vs'!";
  echo "<table cellspacing='0'><tr><th>Meci</th><th>Bound<br>(1 : X : 2)</th><th>Betting till</th></tr>"; $x1 = 0;
  while($row = mysql_fetch_array($SQL))
  {
    if($row['tip']  == $cat)
    {
     if(strtotime("now") <= $row['date'])
     {
      echo "<tr>";
      echo "<td><a href='bet.php?prod=" . $row['id'] . "&team=1'>" . $row['team1'] . "</a> <a href='bet.php?prod=" . $row['id'] . "&team=x'>vs</a> <a href='bet.php?prod=" . $row['id'] . "&team=2'>" . $row['team2'] . "</a></td>";
      echo "<td>" . $row['team1c'] . " : " . $row['teamx'] . " : " . $row['team2c'] . "</td>";
      echo "<td>" . date("d-m-Y", $row['date']) . "</td>";
      echo "</tr>";
      $x1++;
     }
    }
  } 
  if($x1 == 0)
  {
    echo "<tr><td>Momentan nu avem nici un meci activ!</td><td></td><td></td></tr>";
  }
  echo "</table>";
 }
 if((isset($_GET['prod'])) && (isset($_GET['team'])))
 {
   $team = mysql_real_escape_string($_GET['team']);
   $prod = mysql_real_escape_string($_GET['prod']);
   switch($team)
   {
     case 'x';
     break;
     case 1:
     break;
     case 2:
     break;
     default:
       die("Error!<a href='bet.php'>Back</a>!");
     break;
   }
   if(isset($_POST['submit']))
   {
     if(isset($_POST['suma']))
     {
     $SQL = mysql_query("SELECT * FROM `meciuri` WHERE `id` = '" . $prod . "'") or die(mysql_error());
     if(mysql_fetch_array($SQL))
     {
       $SQL = mysql_query("SELECT * FROM `meciuri` WHERE `id` = '" . $prod . "'") or die(mysql_error());
       $row = mysql_fetch_array($SQL);
       if(strtotime("now") <= $row['date'])
       {
        $suma = mysql_real_escape_string($_POST['suma']);
        $uname2 = $_SESSION['uname'];
        if(($moneyclient >= $suma) && ($suma > 0))
        {
         $moneyclient = $moneyclient - $suma;
         mysql_query("UPDATE `accounts` set `money` = '" . $moneyclient . "' WHERE `uname` = '" . $uname2 . "'") or die (mysql_error());
         mysql_query("INSERT into `pariu` (`id`, `pid`, `team`, `uname`, `suma`) VALUES ('', '" . $prod . "', '" . $team . "', '" . $uname . "', '" . $suma . "')") or die (mysql_error());
         echo "<font color='darkgreen'><p>Your bet has been added!You will receive an email with the bet result at the end of the game on your email!</p></font>";
        }
        else
        {
         echo "<font color='darkred'>Nu detineti suficienti bani pentru a paria!</font><a href='adauga.php'>Recharge account</a>!";
        }
       }
       else
       {
         echo "<font color='darkred'>Pariurile pentru acest meci au fost oprite!</font><a href='bet.php'>Back</a>!";
       }
      } 
      else
      {
        echo "<font color='darkred'>Acest meci nu a fost gasit!<a href='bet.php'>Back</a>!";
      }
     }
     else
     {
       echo "<font color='darkred'>Toate campurile trebuie completate!</font><a href='bet.php?prod=" . $prod . "&team=" . $team . "'>Back</a>";
     }
   }
   else
   {
     $SQL = mysql_query("SELECT * FROM `meciuri` WHERE `id` = '" . $prod . "'") or die(mysql_error());
     if(mysql_fetch_array($SQL))
     {
       $SQL2 = mysql_query("SELECT * FROM `meciuri` WHERE `id` = '" . $prod . "'") or die(mysql_error());
       $row = mysql_fetch_array($SQL2);
      if($team != 'x')
      {
       $cauta = "team" . $team;
       $ech = $row[$cauta];
       $cauta = $cauta . "c";
       $cot = $row[$cauta];
        echo "<table cellspacing='0'>";
        echo "<tr><th>Bet on : <b>" . $ech . "</b><br>(bound: " . $cot . ") in game <br><u>" . $row['team1'] . "</u> vs <u>" . $row['team2'] . "</u></th></tr>";
        echo "<tr><th>Bound  (1 : X : 2) <br>" . $row['team1c'] . " : " . $row['teamx'] . " : " . $row['team2c'] . "</th></tr>";
        echo "<tr><th>";
        echo "<form action='bet.php?prod=" . $prod . "&team=" . $team . "' method='post'>";
        echo "<p><label><strong>Amount: </strong></label><input name='suma' type='text' /> ";
        echo '<input type="submit" name="submit" value="Bet!" /></p>';
        echo "</form>";
        echo "</th></tr>";
        echo "</table>";
      }
      else
      {
        $cot = $row['teamx'];
        echo "<table cellspacing='0'>";
        echo "<tr><th>Bet on : tie(bound: " . $cot . ") in game <br><u>" . $row['team1'] . "</u> vs <u>" . $row['team2'] . "</u></th></tr>";
        echo "<tr><th>Bound  (1 : X : 2) <br>" . $row['team1c'] . " : " . $row['teamx'] . " : " . $row['team2c'] . "</th></tr>";
        echo "<tr><th>";
        echo "<form action='bet.php?prod=" . $prod . "&team=" . $team . "' method='post'>";
        echo "<p><label><strong>Amount: </strong></label><input name='suma' type='text' /> ";
        echo '<input type="submit" name="submit" value="Bet!" /></p>';
        echo "</form>";
        echo "</th></tr>";
        echo "</table>";
      }
     }
     else
     {
       echo "Acest meci a fost dezactivat!";
     }
   }
 }
}
else
{
?>

  <table> 
   <th>
   <a href='bet.php?cat=fotbal'><font face="Impact" size = 25> Fotbal</font></a><br>
   </th>
   <th>
   <a href='bet.php?cat=baschet'><font face="Impact" size = 25>Baschet</font></a><br>
   </th>
   <th>
   	<a href='bet.php?cat=hockey'><font face="Impact" size = 25>Hockey</font></a><br>
   </th>
 
   </table>
   <div class="clear">
<?php
}
include_once "include/footer.php";
?>
