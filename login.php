<?php
session_start();
include_once "include/head.php";
include_once "engine/config.php";
include_once "include/loginmic.php";
include_once "include/menu.php";
?>
</div>

</div>
        <div class="main-container col2-right-layout">
            <div class="main">
                                <div class="col-main">
                                        <div class="std">

<?php
if(isset($_POST['submit']))
{
  if((isset($_POST['user'])) && (isset($_POST['pass'])))
  {
    $user = mysql_real_escape_string($_POST['user']);
    $pass = mysql_real_escape_string($_POST['pass']);
    $SQL = mysql_query("SELECT * FROM `accounts` WHERE `uname` = '" . $user . "' and `pass` = '" . md5($pass) . "'") or die (mysql_error());
    if(mysql_fetch_array($SQL))
    {
      $_SESSION['uname'] = $user;
      ?>
      <script>document.location.href='logged.php'</script>
      <?php
    }
    else
    {
      echo "This combination of user and password couldn't be found in our database!<a href='login.php'>Back</a>!";
    }
  }
  else
  {
    echo "All fields are necesary!<a href='login.php'>Back</a>!";
  }
}
else
{
  ?>
                                        
          <form action="login.php" method="post">
        <div class="block-content">
            <label for="mini-login"><b>Username</b>: &nbsp&nbsp&nbsp&nbsp</label><input type="text" name="user" id="mini-login" class="input-text" /><br>
            <label for="mini-password"><b>Password</b>:&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="password" name="pass" id="mini-password" class="input-text" /> <br><br>
            <div class="actions">
            <div class="login_pan_box">
                <button type="submit" name='submit' class="button"><span><span>Login</span></span></button>
                </div>
            </div>
        </div>
    </form>
 <?php
}
 ?>
                                        
                                        
                                        

<?php
include_once "include/footer.php";
?>
