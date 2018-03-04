<?php
       $SQL = mysql_query("SELECT * FROM `meciuri` ORDER by `date` DESC") or die (mysql_error());
	$x1 = 1;
	while(($row = mysql_fetch_array($SQL)) && ($x1 != 5))
        {
          $tip = $row['tip'];
         if($tip == "Hockey")
         {
          echo '<li>';
          echo "<h2 class='product-name'><b>" . $row['team1'] . "</b> vs <b>" . $row['team2'] . "</b></h2>";
          echo '<span class="price">';
          $team1c = $row['team1c']; $team2c = $row['team2c']; $teamx = $row['teamx'];
          if(round($team1c) == $team1c){ $team1c = $row['team1c'] . ".00"; }
          if(round($team2c) == $team2c){ $team2c = $row['team2c'] . ".00"; }
          if(round($teamx) == $teamx){ $teamx = $row['teamx'] . ".00"; }
          echo "<u>1 : X : 2</u>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
          echo "<u>" . $team1c . " : " . $teamx . " : " . $team2c . "</u><br>";
          //echo "<b>Pana la data de: </b><u>" . date('d-m-Y',$row['date']) . "</u>";
          echo '</span>';
          echo '</li><br>';
          $x1++;
         }
        }
        ?>