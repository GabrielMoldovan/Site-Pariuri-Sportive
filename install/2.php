

<?php
if(isset($_POST['submit']))
{
  if((isset($_POST['user'])) && (isset($_POST['host'])) && (isset($_POST['pass'])) && (isset($_POST['db'])))
  {    
    $user = $_POST['user'];
    $host = $_POST['host'];
    $pass = $_POST['pass'];
    $db = $_POST['db'];
    $dbms_schema = 'engine/db.sql';

    $sql_query = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema)) or die('problem ');
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');

    mysql_connect($host,$user,$pass) or die('Error connecting to database!<a href="index.php?n=1">Back</a>');
    mysql_select_db($db) or die('Cannot select database! <a href="index.php?n=1">Back</a>');

    $i=1;
    foreach($sql_query as $sql)
    {
      mysql_query($sql) or die('Error!');
    }

    $fn = "include/config.php";
    $content = "<?php $" . "dbuser = '" . $user . "'";
    $content = $content . ";";
    $content = $content . "$" . "dbhost = '" . $host . "'";
    $content = $content . ";";
    $content = $content . "$" . "dbpass = '" . $pass . "'";
    $content = $content . ";";
    $content = $content . "$" . "db = '" . $db . "'";
    $content = $content . ";";
    $content = $content . "$" . "con = mysql_connect(" . "$" . "dbhost," . "$" . "dbuser," . "$" . "dbpass)";
    $content = $content . ";";
    $content = $content . "if(!" . "$" . "con)";
    $content = $content . "{ die('Could not connect: ' . mysql_error()); }";
    $content = $content . "mysql_select_db(" . "$" . "db, " . "$" . "con)";
    $content = $content . ";";
    $content = $content . " ?>";
    $fp = fopen($fn,"w") or die ("ERR");
    fputs($fp,$content);
    fclose($fp) or die ("Error closing file!");
    $fn = "../engine/config.php";
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$content);
    fclose($fp) or die ("Error closing file!");
    echo '<a href="index.php?n=3">Next step!</a>';
  }
  else
  {
    echo 'All fields must be completed! <a href="index.php?n=1">Back</a>.';
  }
}
else
{
  echo 'You skipped a stage! <a href="index.php?n=1">Back</a>';
}
?>