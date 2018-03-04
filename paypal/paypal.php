<?php
class Paypal {

	private $VARS;
	private $button;
	private $logFile;
	private $isTest=false;

	function getLink()
	{
		$url = $this->getPaypal();
		$link = 'https://'.$url.'/cgi-bin/webscr?';
		foreach($this->VARS as $item => $sub){
			$link .= $sub[0].'='.$sub[1].'&';
		}
		return $link;
	}

	function showForm()
	{
		$url = $this->getPaypal();
		$FORM  = '<form action="https://'.$url.'/cgi-bin/webscr" method="post" target="_blank" style="display:inline;">'."\n";

		foreach($this->VARS as $item => $sub){
			$FORM .= '<input type="hidden" name="'.$sub[0].'" value="'.$sub[1].'">'."\n";
		}

		$FORM .= $this->button;
		$FORM .= '</form>';
		echo $FORM;
	}

	function addVar($varName,$value)
	{
		$this->VARS[${'varName'}][0] = $varName;
		$this->VARS[${'varName'}][1] = $value;
	}

	function addButton($type,$image = NULL)
	{
		switch($type)
		{
			case 1:
				$this->button = '<input type="image" height="21" style="width:86;border:0px;"';
				$this->button .= 'src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" ';
				$this->button .= 'alt="PayPal - The safer, easier way to pay online!">';
				break;
			case 2:
				$this->button = '<input type="image" height="26" style="width:120;border:0px;"';
				$this->button .= 'src="https://www.paypal.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit"';
				$this->button .= 'alt="PayPal - The safer, easier way to pay online!">';
				break;
			case 3:
				$this->button = '<input type="image" height="47" style="width:122;border:0px;"';
				$this->button .= 'src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit"';
				$this->button .= 'alt="PayPal - The safer, easier way to pay online!">';
				break;
			case 4:
				$this->button = '<input type="image" height="47" style="width:179;border:0px;"';
				$this->button .= 'src="https://www.paypal.com/en_US/i/btn/btn_giftCC_LG.gif" border="0" name="submit"';
				$this->button .= 'alt="PayPal - The safer, easier way to pay online!">';
				break;
			case 5:
				$this->button = '<input type="image" height="47" style="width:122;border:0px;"';
				$this->button .= 'src="https://www.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit"';
				$this->button .= 'alt="PayPal - The safer, easier way to pay online!">';
				break;
			default:
				$this->button = '<input type="image" src="'.$image.'" border="0" name="submit"';
				$this->button .= 'alt="PayPal - The safer, easier way to pay online!">';
		}
		$this->button .= "\n";
	}

	function setLogFile($logFile)
	{
		$this->logFile = $logFile;
	}

	private function doLog($wtf)
	{
		ob_start();
		echo '<pre>'; print_r($wtf); echo '</pre>';
		$logInfo = ob_get_contents();
		ob_end_clean();

		$file = fopen($this->logFile,'a');
		fwrite($file,$logInfo);
		fclose($file);
	}

	function checkPayment($wtf)
	{
		$req = 'cmd=_notify-validate';

		foreach ($wtf as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		$url = $this->getPaypal();

                $header = "";
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		//$fp = fsockopen ('ssl://'.$url, 443, $errno, $errstr, 30);

		$fp = fsockopen ($url, 80, $errno, $errstr, 30);

		if (!$fp) {
			return false;
		} else {
			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				if (strcmp ($res, "VERIFIED") == 0) {
					return true;
				} else {
					if($this->logFile != NULL){
						$this->doLog($wtf);
					}
					return false;
				}
			}
			fclose ($fp);
		}
		return false;
	}

	/* Set Test */
	function useSandBox($value)
	{
		$this->isTest=$value;
	}

	/* Private function to get paypal url */
	private function getPaypal()
	{
		if($this->isTest == true){
			return 'www.sandbox.paypal.com';
		} else {
			return 'www.paypal.com';
		}
	}
}
?>
