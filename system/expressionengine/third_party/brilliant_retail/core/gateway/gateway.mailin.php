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

class Gateway_mailin extends Brilliant_retail_gateway {
	public $title 	= 'Bank Transfer';
	public $label 	= 'Bank Transfer Payment';
	public $descr 	= 'Allow users to Bank Transfer payment after the purchase.';
	public $enabled = TRUE;
	public $admin_enabled 	= TRUE;
	public $version = .5;
	
	function form(){ 
            $configs = ee()->db->select('code,value')->from('br_config_data')->where('code','banks')->get()->row_array();            
            $accounts = explode(',',$configs['value']);
            $accs = array();
            foreach ($accounts as $acc){                
                $ac  = explode('|',$acc);
                $accs[$ac[0]] = $ac;
            }            
            
            $s = ' <p>We will sent you an email contain bank account detail & information</p>
                    <div class="bank-name">
                        <label>Transfer to :</label>
                        <div class="field-cont width-xs">
                            <select class="form-control cus-field" name="payment_details[bank]" required onchange="$(\'.bank-payment\').hide(); console.log($(this).val(),$(\'.bank-payment#\'+ $(this).val() )); $(\'.bank-payment#\' + $(this).val() ).show();">';
            $s.='<option> Select Bank</option>';
            foreach ($accs as $code => $info ){
            $s.='                                <option value="b'.$info[1].'" >'. $info[0] .' - '. $info[1].'</option>';
            }                    
            $s.='                </select>
                        </div>
                    </div>';
            
            $s .='<div class="payment-options" style="">';
            foreach ($accs as $code=> $bank ){
            $s .='  <div class="desc bank-payment" id="b'.$bank[1].'" style="display:none">
                        <p>Please transfer to this account :</p>
                        <p>'. $bank[0]. ' - '.$bank[1].'</p>
                        <p>'. $bank[2].'</p>
                        <div class="logo-cont">
                            <img style="height:30px" src="/images/'. strtolower($code) .'.png">
                        </div>
                    </div>
                 ';            
            }
            $s .='    </div>';
            return $s;
	}
	
	function process($data){
		$id =  md5(time());                 		
                $details = array_merge($data['payment_details'],array("Method" => $this->title,"Transaction ID" => $id ));
		
		if($this->admin_order === FALSE){
			$amount = 0;
		}else{
			$amount = $data["order_total"];
		}
									
		$trans = array(
                                'status' => 2, 
                                'amount' => $amount,
                                'transaction_id' =>$id, 
                                'payment_card' => 'Bank Payment', 
                                'payment_type' => 'Bank Payment', 
                                'details' => serialize($details), 
                                'approval' => '' 
                        );
		return $trans;
	}
	
	function install($config_id){
            $data = array();
            
            $data[] = array(
                        'config_id' => $config_id, 
                        'label'	 	=> 'Bank Account List', 
                        'code'		=> 'banks', 
                        'type' 		=> 'text',
                        'descr'         => 'In format :  Bank Name|Bank Account|Owner Name, comma(,) separated for multiple banks',
                        'required' 	=> true,
                        'sort' 		=> 1
                        );
            
            foreach($data as $d){
                ee()->db->insert('br_config_data',$d);
            }				
		return true;
	}
	function remove(){
		
	}
	function update($current = '',$config_id = ''){
		return true;
	}
}
/* End of file gateway.mailin.php */