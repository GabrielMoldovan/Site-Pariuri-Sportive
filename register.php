<?php
error_reporting(0);
include_once "include/head.php";
include_once "engine/config.php";
include_once "include/loginmic.php";
include_once "include/menu.php";
function checkEmail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL) == $email){
		$aux = explode('@',$email);
		return checkdnsrr($aux[1],'MX');
	}
	return false;
}
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
  if((isset($_POST['uname'])) && (isset($_POST['email'])) && (isset($_POST['pass'])))
  {
    $errmes = '';
    $uname = mysql_real_escape_string($_POST['uname']);
    $email = mysql_real_escape_string($_POST['email']);
    $pass = mysql_real_escape_string($_POST['pass']);
    $SQL = mysql_query("SELECT * FROM `accounts` WHERE `uname` = '" . $uname . "'") or die (mysql_error());
    if(mysql_fetch_array($SQL))
    {
      $errmes = $errmes . 'This account already exists!<br>';
    }
    $SQL = mysql_query("SELECT * FROM `accounts` WHERE `email` = '" . $email . "'") or die (mysql_error());
    if(mysql_fetch_array($SQL))
    {
      $errmes = $errmes . 'An account has been already registered on this email address!<br>';
    }
    $isemail = checkEmail($email);
    if($isemail == false)
    {
      $errmes = $errmes . "Please enter a valid email!<br>";
    }
    if($errmes == '')
    {
      mysql_query("INSERT into `accounts` (`id`, `uname`, `pass`, `email`, `money`) VALUES ('', '" . $uname . "', '" . md5($pass) . "', '" . $email . "', '0')") or die (mysql_error());
      echo "Your account has been succesfully created!<a href='login.php'>Login</a>";
    }
    else
    {
      echo $errmes . "<a href='register.php'>Back</a>!";
    }
  }
  else
  {
    echo "All fields are necesary!<a href='register.php'>Back</a>!";
  }
}
else
{
?>
<form action="register.php" method="post">
            <b>User</b>:&nbsp&nbsp&nbsp<input type="text" name="uname" id="mini-login" class="input-text" /><br>
            <b>Email</b>:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="email" id="mini-login" class="input-text" /><br>
            <b>Password</b>:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="pass" id="mini-password" class="input-text" /><br><br><br>
            <button type="submit" name='submit' class="button"><span><span>Register</span></span></button>
    </form>
<?php
}
?>
                                        
                                        
                                        

<?php
include_once "include/footer.php";
?>
