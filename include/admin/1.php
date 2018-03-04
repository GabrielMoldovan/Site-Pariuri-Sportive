<?php
if(isset($_POST['submit']))
{
  if((isset($_POST['t1'])) && (isset($_POST['t2'])) && (isset($_POST['tip'])) && (isset($_POST['t1c'])) && (isset($_POST['tx'])) && (isset($_POST['t2c'])) && (isset($_POST['date'])))
  {
    $t1 = mysql_real_escape_string($_POST['t1']);
    $t2 = mysql_real_escape_string($_POST['t2']);
    $t1c = mysql_real_escape_string($_POST['t1c']);
    $t2c = mysql_real_escape_string($_POST['t2c']);
    $tx = mysql_real_escape_string($_POST['tx']);
    $type = mysql_real_escape_string($_POST['tip']);
    $date = strtotime($_POST['date']);
    mysql_query("INSERT into `meciuri` (`id`, `tip`, `team1`, `team2`, `team1c`, `team2c`, `teamx`, `date`) VALUES ('', '" . $type . "', '" . $t1 . "', '" . $t2 . "', '" . $t1c . "', '" . $t2c. "', '" . $tx . "', '" . $date . "')") or die (mysql_error());
    echo "Meciul a fost adaugat cu succes!<a href='admin.php'>Inapoi la admin area!</a>";
  }
  else
  {
    echo "Toate campurile sunt necesare pentru a adauga un meci nou!<a href='admin.php?n=1'>Inapoi</a>!";
  }
}
else
{
?>
 <form action='admin.php?n=1' method='post'>
 <p align='left'><label><strong>Meci de: </strong></label>
 <input type="radio" name="tip" value="Fotbal"> Fotbal<br>
 <input type="radio" name="tip" value="Baschet"> Baschet<br>
 <input type="radio" name="tip" value="Hochey"> Hockey<br><br><br><br>
 <p><label><strong>Echipa 1: </strong></label><input name="t1" type="text" /><br></p><br>
 <p><label><strong>Echipa 2: </strong></label><input name="t2" type="text" /><br></p><br><br><br><br>
 <p><label><strong>Cota echipa 1: </strong></label><input name="t1c" type="text" /><br></p><br>
 <p><label><strong>Egalitate: </strong></label><input name="tx" type="text" /><br></p><br>
 <p><label><strong>Cota echipa 2: </strong></label><input name="t2c" type="text" /><br></p><br><br><br><br>

 <b><p align='left'><font color='red'>Atentie!</font><br>Pentru a seta o data,setati in formatul d-m-Y ( zi-luna-an)<br>Ex: 05-07-2011</p></b><br>
 <p><label><strong>Pariuri pana la data de: </strong></label><input name="date" type="text" /><br></p><br><br>

 <p><br /><br /><input type="submit" value="Adauga" name="submit"/></p>
 </form>
<?php
}
?>