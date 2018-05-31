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

class Shipping_rates_matrix extends Brilliant_retail_shipping {
	public $title 	= 'Rates Matrix';
	public $label  	= 'Shipping Rates';
	public $descr 	= 'Rates Matrix';
	public $enabled = true;
	public $version = '1.1';

	function quote($data,$config){
		$this->rates = array();
		$rows = unserialize($config["rates_matrix"]);
		if($rows){                    
			foreach($rows as $key => $val){				
				if ($res = $this->match_row($data,$val)){					
					$val[7] = floatval($val[7] );
					$this->rates[$key] = array('code' => 'rates_matrix',
												'rate' => $this->_currency_round( $val[7] * 1 ),
												'label' => $val[8] 
											);
								
				}
			}
		}

		if(count($this->rates) > 1){
			usort($this->rates,array($this,'_rate_sort'));
		}
		return $this->rates;
	}
	
	function install($config_id){
		$data[] = array('config_id' => $config_id, 
                                'label'	 	=> 'rates_matrix', 
                                'code' 		=> 'rates_matrix',
                                'type' 		=> 'table', 
                                'options' 	=> 'country|state|zip_code|from_price|to_price|from_weight|to_weight|rate|label',
                                'sort' 		=> 1 
                        );
                $data = $this->install_data($data);
                foreach($data as $d){
			$this->EE->db->insert('br_config_data',$d);
		}
		return true;
	}
	
	function remove($config_id){
		return true;
	}
	
	function update($current = '',$config_id = ''){
		return true;
	}
	
	
	function match_wildcard( $wildcard_pattern, $haystack ) {
	   $regex = str_replace(
	     array("\*", "\?"), // wildcard chars
	     array('.*','.'),   // regexp chars
	     preg_quote($wildcard_pattern)
	   );
	
	   return preg_match('/^'.$regex.'$/is', $haystack);
	}
    function match_row($data,$val){
		
		$is_good = TRUE;
		if($val[0] != ''){                
			$country = strtoupper($data["to_country"]);         
			$a = explode('|',$val[0]);									
			if (!in_array($country,$a)) return false;
		}		
		// [1] To State
		if($val[1] != ''){                
			$state = strtoupper($data["to_state"]);
			$a = explode('|',$val[1]);			
			if (!in_array($state,$a)) return false;
		}
		
	    // [2] To Zip / Postal 
        if($val[2] != ''){
            $a = explode("|",strtoupper($val[2]));
			$zip = strtoupper($data["to_zip"]);			
			$zip_match = true;
			foreach($a as $b){
				$zip_match = true;
				if( $this->match_wildcard($b, $zip)) {break;} 
				$zip_match = false;
			}
			if (!$zip_match) return false;
        }
		
		if (($val[3] != '' && $data["total"] < $val[3])) return false;	
		if (($val[4] != '' && $data["total"] > $val[4])) return false;
		if (($val[5] != '' && $data["weight"] < $val[5])) return false;
		if (($val[6] != '' && $data["weight"] > $val[6])) return false;

        return $val;
    }        
    function install_data($data){
            $file = __DIR__ . '/' . $data[0]['code']. '.csv';            
            if (!file_exists($file)) return  $data;
            $csv = array_map('str_getcsv', file($file));
            if (!is_numeric($csv[0][7])) array_shift($csv);
            $data[0]['value'] = serialize($csv);        
            return $data;
        }
}