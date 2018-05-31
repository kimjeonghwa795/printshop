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
class Gateway_veritrans extends Brilliant_retail_gateway {
	public $title 	= 'Veritrans';
	public $label 	= 'Veritrans';
	public $descr 	= 'Accept payments via Veritrans';
	public $enabled = true;
	public $version = '1.0';
	public $ipn_enabled = true;
	public $osc_enabled = true;
	public $cart_button = false;
	
    public function process($data,$config){
	$details = array("Method" => "Midtrans Payments" );
    
        $trans = array('status' => -1, 
                        'transaction_id' => $data["transaction_id"],
                        'payment_card' => "",
                        'payment_type' => 'Midtrans Standard', 
                        'amount' => $data["order_total"],
                        'details' => serialize($details), 
                        'approval' => "" 
                );
        
        return $trans;
    }

	// Start IPN Call
    public function start_ipn($data,$config){
//        include('config.php');

        $transaction_details = array(
                'order_id' 		=> @$data['order_id'] ,
                'gross_amount' 	=> @$data['order_total']
        );

        // Populate items        
		
        $items = [] ;        
        foreach ($data['cart']['items'] as $item ){
            $items[] = array(
					'id' 		=> @$item['item_id'],
					'price' 	=> @$item['price'],
					'quantity' 	=> @$item['quantity'],
					'name' 		=> @$item['title'],
                );
        }
		
		if ($data['cart_shipping']){
            $items[] = array(
					'id' 		=> @$data['d012b9116a3a4764f8e0818f24a04135'],
					'price' 	=> @$data['cart_shipping'],
					'quantity' 	=> 1,
					'name' 		=> 'Shipping',
                );
		
		}
        if ($data['cart_discount']){
            $items[] = array(
					'id' 		=> @data['coupon_code'],
					'price' 	=> $data['cart_discount'],
					'quantity' 	=> -1,
					'name' 		=> @data['coupon_code'],
                );		
		}
        
        // Populate customer's billing address
        $billing_address = array(
                'first_name' 		=> $data['br_billing_fname'],
                'last_name' 		=> $data['br_billing_lname'],
                'address' 			=> $data['br_billing_address1'] . ', ' . $data['br_billing_address2'] ,
                'city' 				=> $data['br_billing_city'],
                'postal_code' 		=> $data['br_billing_zip'],
                'phone' 			=> $data['br_billing_phone'],
                'country_code'		=> 'IDN'
                );
        //$billing_address =  $data['billing_address'];
        // Populate customer's shipping address
        $shipping_address = array(
                'first_name' 		=> $data['br_shipping_fname'],
                'last_name' 		=> $data['br_shipping_lname'],
                'address' 			=> $data['br_shipping_address1'] . ', ' . $data['br_billing_address2'] ,
                'city' 				=> $data['br_shipping_city'],
                'postal_code' 		=> $data['br_shipping_zip'],
                'phone' 			=> $data['br_shipping_phone'],
                'country_code'		=> 'IDN'
                );
        //$billing_address =  $data['billing_address'];
        // Populate customer's Info
        $customer_details = array(
                'first_name' 		=> $data['br_billing_fname'],
                'last_name' 		=> $data['br_billing_lname'],
                'email' 			=> $data['email'],
                'phone' 			=> $data['br_billing_phone'],
                'billing_address' 	=> $billing_address,
                'shipping_address'	=> $shipping_address
                );

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
                'payment_type' 			=> 'vtweb', 
                'vtweb' 				=> array(
										'enabled_payments' 	=> ['credit_card'],
										'credit_card_3d_secure' => true
										),
                'transaction_details'	=> $transaction_details,
                'item_details' 			=> $items,
                'customer_details' 	 	=> $customer_details
        );

        $json_transaction_data = json_encode($transaction_data);

        // Mengirimkan request dengan menggunakan CURL
        // HTTP METHOD : POST
        // Header:
        //	Content-Type : application/json
        //	Accept: application/json
        // 	Basic Auth using server_key
		$url = $config['ENDPOINT'];
		
		if (@$config['sandbox'] == 'TRUE' && strpos($url,'sandbox') === false ){
			$url = str_replace('api','api.sandbox',$url);
		}
		if ( substr($url,-1) != '/'){$url .='/';}		
		
        $request = curl_init($url . 'charge');
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($request, CURLOPT_POSTFIELDS, $json_transaction_data);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        $auth = sprintf('Authorization: Basic %s', base64_encode($config['SERVER_KEY'].':'));
        curl_setopt($request, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
                'Accept: application/json',
                $auth 
                )
        );
		//error_log(print_r($transaction_data,1));
		
        // Excute request and parse the response
        $response = json_decode(curl_exec($request));
		//error_log(__LINE__ . print_r($response,1));
        // Check Response
		
        if($response->status_code == "201"){
			ee()->functions->redirect($response->redirect_url);               
        }else{
            //var_dump($response);
			ee()->functions->redirect('/payment/confirm');               
        }
    }

    // Process IPN Calls 
    public function gateway_ipn($config){
        //Contoh untuk menangani HTTP (POST) notifikasi yang dikirim Veritrans
        $json_result = file_get_contents('php://input');
		error_log(__LINE__ . " Menerima notifikasi dari Veritrans: "  . print_r($json_result,1));
        $result = (json_decode($json_result));
		error_log(__LINE__ . " Menerima notifikasi dari Veritrans: "  . print_r($result,1));		
		if (!$result) {
			$result = (object)$_GET;			
		}
		
        error_log("Menerima notifikasi dari Veritrans: "  . print_r($result,1));
		error_log("Status transaksi untuk order id ".$result->order_id .": ".$result->status_code);
		
		$statuses = array(200 => 2, 201 => 2, 202=>1,);
		$status = isset($statuses[$result->status_code]) ? $statuses[$result->status_code] :  1;
		$url = ($status == 2)  ? '/payment/success' : '/payment/confirm';		
		$this->ipn_create_order($result->order_id , $status );
		ee()->functions->redirect($url);               
    }

    // Create a inputs for the checkout form
    public function form(){
        
            $form = '<a href="#" onclick="">'
                    . '<img  src="https://midtrans.com/assets/images/logo-midtrans-white.svg" border="0" alt="Midtrans">'
                    . '</a>'
                    . '<script>'
                    . 'function veritrans_gateway(){'
                    . '' 
                    . 'window.open(\'https://www.paypal.com/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsVeritrans-outside\',\'olcwhatispaypal\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350\');'
                    . '}'
                    . '</script>';
            return $form;
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
                        'value' 	=> 'https://api.midtrans.com/v2/',
                        'sort' 		=> 2
                        );	
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'SERVER KEY', 
                        'code' 		=> 'SERVER_KEY',
                        'type' 		=> 'text', 
                        'value' 	=> 'VT-server-2On5mA4-Kj8ANECUKSVljC8w',
                        'sort' 		=> 2
                        );	
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Client Key', 
                        'code' 		=> 'CLIENT_KEY',
                        'type' 		=> 'text', 
                        'value' 	=> 'VT-client-SQ9ir8XoBqlOkfCA',
                        'sort' 		=> 2
                        );        
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Merchant Id', 
                        'code' 		=> 'merchant_id',
                        'type' 		=> 'text', 
                        'value' 	=> '',
                        'sort' 		=> 2
                        );        
        $data[] = array(
                        'config_id'     => $config_id, 
                        'label'	 	=> 'Thank you page', 
                        'code'		=> 'thank_you_url', 
                        'type' 		=> 'text',
                        'descr' 	=> '(Optional) The path to your thank you page. <b>Note:</b> BrilliantRetail will 
                                                        build the full url. Example: "thankyou" will automatically be built into '.$this->_secure_url('thankyou'),
                        'sort' 		=> 3,
                        'value'		=> 'thankyou' 
                        );
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Image Url', 
                        'code'		=> 'image_url', 
                        'type' 		=> 'text',
                        'descr' 	=> '(Optional) The URL of the 150x50-pixel image displayed as your logo in the upper left corner of the Veritrans checkout pages. Default � Your business name',
                        'sort' 		=> 4
                        );
        $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Header Image', 
                        'code'		=> 'cpp_header_image', 
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
            return '<a href="'.$target.'"><img src="//midtrans.com/assets/images/logo-midtrans-white.svg"></a>';
    }
}