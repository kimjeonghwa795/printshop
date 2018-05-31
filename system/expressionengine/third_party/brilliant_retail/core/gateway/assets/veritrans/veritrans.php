<?php
/**
 * Payment Gateway
 *
 * This library provides generic payment gateway handling functionlity
 * to the other payment gateway classes in an uniform way. Please have
 * a look on them for the implementation details.
 *
 * @package     Payment Gateway
 * @category    Library
 * @author      Md Emran Hasan <phpfour@gmail.com>
 * @link        http://www.phpfour.com

/**
 * Paypal Class
 *
 * Integrate the Paypal payment gateway in your site using this easy
 * to use library. Just see the example code to know how you should
 * proceed. Btw, this library does not support the recurring payment
 * system. If you need that, drop me a note and I will send to you.
 *
 * @package		Payment Gateway
 * @category	Library
 * @author      Md Emran Hasan <phpfour@gmail.com>
 * @link        http://www.phpfour.com
 */

class VeritransGw extends PaymentGateway
{

    /**
	 * Initialize the Paypal gateway
	 *
	 * @param none
	 * @return void
	 */
	public function __construct()
	{
        parent::__construct();

        // Some default values of the class
		$this->gatewayUrl = 'https://www.paypal.com/cgi-bin/webscr';
		$this->ipnLogFile = 'paypal.ipn_results.log';

		// Populate $fields array with a few default
		$this->addField('rm', '2');           // Return method = POST
	}

    /**
     * Enables the test mode
     *
     * @param none
     * @return none
     */
    public function enableTestMode()
    {
        $this->testMode = TRUE;
        $this->gatewayUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    }

    /*
	* 	Validate the IPN notification
	*/
	public function validateIpn()
	{
		// parse the paypal URL
		$urlParsed = parse_url($this->gatewayUrl);

		$string = "cmd=_notify-validate";
		
		foreach ($_POST as $key => $value)
		{
			// Put the key / value in our ipnData array. 
				$this->ipnData[$key] = $value;
			$clean = (get_magic_quotes_gpc()) ? stripslashes(str_replace("\n", "\r\n", $value)) : str_replace("\n", "\r\n", $value);
			$string .= "&".$key."=".urlencode($clean);
		}
		
		$ch = curl_init('https://'.$urlParsed['host'].'/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		$this->ipnResponse = curl_exec($ch);

        
		if (strpos(strtoupper($this->ipnResponse), "VERIFIED"))
		{
		 	return true;
		}
		else
		{
			return false;
		}
	}

	function fsockopen_process($url){ 
		$parts	= parse_url($url);
		$host	= $parts['host'];
		$path	= ( ! isset($parts['path'])) ? '/' : $parts['path'];
		$port	= ($parts['scheme'] == "https") ? '443' : '80';
		$ssl	= ($parts['scheme'] == "https") ? 'ssl://' : '';
		
		
		if (isset($parts['query']) && $parts['query'] != '')
		{
			$path .= '?'.$parts['query'];
		}
		
		$postdata = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value)
		{
			// str_replace("\n", "\r\n", $value)
			// put line feeds back to CR+LF as that's how PayPal sends them out
			// otherwise multi-line data will be rejected as INVALID
			$this->ipnData[$key] = $value;
			$postdata .= "&$key=".urlencode(stripslashes(str_replace("\n", "\r\n", $value)));
		}
		
		$info = '';

		$fp = @fsockopen($ssl.$host, $port, $error_num, $error_str, 8); 

		if (is_resource($fp))
		{
			fputs($fp, "POST {$path} HTTP/1.0\r\n"); 
			fputs($fp, "Host: {$host}\r\n"); 
			fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n"); 
			fputs($fp, "Content-Length: ".strlen($postdata)."\r\n"); 
			fputs($fp, "Connection: close\r\n\r\n"); 
			fputs($fp, $postdata . "\r\n\r\n");
			
			while($datum = fread($fp, 4096))
			{
				$info .= $datum;
			}

			@fclose($fp); 
		}
		
		return $info; 
	}

}
