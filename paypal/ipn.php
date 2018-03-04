<?php
include_once "../engine/config.php";
$SQL = mysql_query("SELECT * FROM `settings` WHERE `setname` = 'paypalacc'") or die(mysql_error());
$row = mysql_fetch_array($SQL);
$paypal = $row['setvalue'];
function genRandomString() {
    $length = 12;
    $characters = ’0123456789abcdefghijklmnopqrstuvwxyz’;
    $string = ”;          
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$sum = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$email = $_POST['payer_email'];

if (!$fp) {
echo "Error";
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
   if($paypal == $receiver_email)
   {
       $code = genRandomString();
       mysql_query("INSERT INTO `recharge` (`paycode`, `email`, `sum`) VALUES ('" . mysql_real_escape_string($code) . "', '" . mysql_real_escape_string($email) . "', '" . mysql_real_escape_string($sum) . "')") or die(mysql_error());
       $server  = $_SERVER['HTTP_HOST'];
       $to      = $email;
       $subject = 'Va multumim pentru plata!';
       $message = '

       Va multumim pentru plata

       Mai jos veti gasi codul de incarcare cu credit.

       -------------------------
       Cod: ' . $code . '
       Email: ' . $email . '
       -------------------------

       Pentru a activa trebuie sa va logati pe contul dvs,
       dupa care intrati in ADAUGARE FONDURI si selectati 
       "Am un cod de reincarcare"

       Du-te si activeaza acest cod acum!';
       $headers = 'From:sales@' . $server . "\r\n";
       mail($to, $subject, $message, $headers);
   }
}
else if (strcmp ($res, "INVALID") == 0) {
  }
}
fclose ($fp);
}
?>
