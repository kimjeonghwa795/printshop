<?php
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		David Dexter  								*/
/* 	@copyright	Copyright (c) 2010-2014						*/
/* 	@license	http://brilliantretail.com/license.html		*/
/* 	@link		http://brilliantretail.com 					*/
/*															*/
/************************************************************/
/* NOTICE													*/
/*															*/
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF 	*/
/* ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED	*/
/* TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 		*/
/* PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT 		*/
/* SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY */
/* CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION	*/
/* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR 	*/
/* IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 		*/
/* DEALINGS IN THE SOFTWARE. 								*/	
/************************************************************/

//include 'assets/ipay88/IPay88.class.php';
class Gateway_ipay88 extends Brilliant_retail_gateway {
	public $title 	= 'iPay88';
	public $label 	= 'iPay88';
	public $descr 	= 'Accept payments via iPay88';
	public $enabled = true;
	public $version = '1.0';
	public $ipn_enabled = true;
	public $osc_enabled = true;
	public $cart_button = false;
	
    public function process($data,$config){
	$details = array("Method" => "iPay88 Payments" );            
        $trans = array('status' => -1, 
                        'transaction_id' => $data["transaction_id"],
                        'payment_card' => "",
                        'payment_type' => 'iPay88 Standard', 
                        'amount' => $data["order_total"],
                        'details' => serialize($details), 
                        'approval' => "" 
                );
        
        return $trans;
    }

	// Start IPN Call
    public function start_ipn($data,$config){                                
        
        $ipay88Fields = array(
                'MerchantCode' => $config['MerchantCode'],
                'UserName' 	=> @$data['br_fname'] . ' '. @$data['br_lname'],                
                'UserEmail' 	=> @$data['email'],
                'UserContact' 	=> @$data['phone'] ,
                'RefNo'         => $data['order_id'],
                'ProdDesc'      => @$data['ref'],
                'Currency'      => $data['currency'],
                'Amount'        => $data["order_total"] . '00',                
                'ResponseURL'   => $config['response_url'],
                'BackendURL'    => @$data['sagepay_return'],                        
                );
        
        
        $signature = $config['MerchantKey'] ;
        $signature .= $config['MerchantCode'];
        $signature .= $data['order_id'];
        $signature .= $data['order_total'] . '00';
        $signature .= 'IDR';
        $signature = base64_encode($this->_hex2bin(sha1($signature)));
        $ipay88Fields['Signature'] = $signature;
        error_log(print_r($ipay88Fields),1);
        
        /*
        error_log('print_r' . print_r($ipay88Fields,1));
        $request = curl_init($config['ENDPOINT']);
        //curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($request, CURLOPT_POST, sizeof($ipay88Fields));        
        curl_setopt($request, CURLOPT_POSTFIELDS, $ipay88Fields );
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        //$auth = sprintf('Authorization: Basic %s', base64_encode($config['MerchantKey'].':'));
        //curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json',$auth ));
        
        // Excute request and parse the response        
        error_log('RESPONSE'. curl_exec($request));
        curl_close($request);
        */
        
        echo '<html><head></head><body>';
        echo '<div style="display:none">';
        echo '<form method="POST" action="' . $config['ENDPOINT'] . '" name="ipay">'; 
        foreach($ipay88Fields as $name => $value){
            echo "<input type='hidden' name='$name' value='$value' style='display:none'/>";
        }        
        echo '</form><script>document.ipay.submit();</script>';        
        echo '</div></body></html>';                
    }

    // Process IPN Calls 
    public function gateway_ipn($config){
        //Contoh untuk menangani HTTP (POST) notifikasi yang dikirim Ipay        
        $result = array();
        parse_str(file_get_contents('php://input'),$result);
        error_log(print_r($result,1));
        if($result['Status']) {
                //OK, trancaction is success
                $order_id = $result['RefNo'];
                $amount = $result['Amount'];                
                $trxId = $result['TransId'];
                $cur = $result['Currency'];                
                if ($order_id){
                    $this->ipn_create_order($order_id , 3 );
                }
        }
        return $this->EE->functions->redirect($this->EE->functions->create_url($this->_config["store"][$this->site_id]["thankyou_url"]));
    }

    // Create a inputs for the checkout form
    public function form(){        
        return '<div>All transactions will be settled at Jakarta, Indonesia. </div>';
    }

    // Check the status of an existing subscription	
    public function status_subscription(){
            return true;
    }
	
	// Install the gateway
    public function install($config_id){
        $data = array();
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Business E-mail', 
                        'code'		=> 'email', 
                        'type' 		=> 'text',
                        'required' 	=> true,
                        'sort' 		=> 1
                        );
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Sandbox Mode', 
                        'code' 		=> 'sandbox',
                        'type' 		=> 'dropdown', 
                        'options' 	=> 'TRUE:True|FALSE:False (Transactions are Live)',
                        'value' 	=> 'TRUE',
                        'sort' 		=> 2
                        );	
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'End Point', 
                        'code' 		=> 'ENDPOINT',
                        'type' 		=> 'text', 
                        'value' 	=> 'https://sandbox.ipay88.co.id/epayment/entry.asp',
                        'sort' 		=> 2
                        );	
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'MerchantCode', 
                        'code' 		=> 'MerchantCode',
                        'type' 		=> 'text', 
                        'value' 	=> '',
                        'sort' 		=> 1
                        );	
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Merchant Key', 
                        'code' 		=> 'MerchantKey',
                        'type' 		=> 'text', 
                        'value' 	=> '',
                        'sort' 		=> 1
                        );        
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Signature', 
                        'code' 		=> 'Signature',
                        'type' 		=> 'text', 
                        'value' 	=> '',
                        'sort' 		=> 2
                        );        
        $data[] = array(
                        'config_id'     => $config_id, 
                        'label'	 	=> 'Response Url', 
                        'code'		=> 'response_url', 
                        'type' 		=> 'text',
                        'sort' 		=> 3,
                        'value'		=> 'thankyou' 
                        );
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Backend Url', 
                        'code'		=> 'backend_url', 
                        'type' 		=> 'text',
                        'sort' 		=> 4
                        );
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Logo Image', 
                        'code'		=> 'logo_image', 
                        'type' 		=> 'text',
                        'descr' 	=> '(Optional) The image at the top left of the checkout page. The image�s maximum size is 750 pixels wide by 90 pixels high. Veritrans recommends that you provide an image that is stored only on a secure (https) server.',
                        'sort' 		=> 5
                        );

        foreach($data as $d){
                $this->EE->db->insert('br_config_data',$d);
        }				
        return true;
    }

// Remove the gateway
    public function remove($config_id){
            return true;		
    }

    public function cart_button($config){
            $target = $this->_secure_url(QUERY_MARKER.'ACT='.$this->EE->functions->fetch_action_id('Brilliant_retail', 'process_ipn').'&GID='.$config["config_id"]);
            return '<a href="'.$target.'"><img src="//veritrans.co.id/images/veritrans@2x.png"></a>';
    }
    private function _hex2bin($source) {
        $bin = '';
        for ($i = 0; $i < strlen($source); $i += 2) {
            $bin .= chr(hexdec(substr($source, $i, 2)));
        }
        return $bin;
    }
}
