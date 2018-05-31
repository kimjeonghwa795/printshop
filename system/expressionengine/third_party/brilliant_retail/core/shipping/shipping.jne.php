<?php
class Shipping_jne extends Brilliant_retail_shipping {
	public $title 	= 'JNE Rates Matrix';
	public $label  	= 'JNE Shipping Rates';
	public $descr 	= 'JNE Rates Matrix';
	public $enabled = true;
	public $version = '1.0';

	function quote($to,$config){
		$this->rates = array();		
		$file = unserialize($config['jne_file']);
		//error_log($file . PHP_EOL . print_r($to,1));
		$csv = array_map('str_getcsv', file($file['file']));
//		error_log($file['file']);
		array_shift($csv);                    
		$i = 1;                                
		$keys = explode('|',$config['jne_header']);		
		$cnt = 0;
		foreach($csv as $key => $val){
			$data = array_combine($keys, $val);			
			//error_log(__LINE__ . print_r($to,1) . PHP_EOL . print_r($data,1));
			if ($res = $this->match_row($to,$data)){					
				$cnt ++;
				//error_log($cnt . ' ' .print_r($res,1));
				$res['rate'] = floatval($res['rate'] );
				$this->rates[ ($res['label']) ] = array('code' => 'jne',
										   'rate' => $this->_currency_round($res['rate']*1),
										   'label' => $res['label'] 
										);				
			}
		}
		

		if(count($this->rates) > 1){
			usort($this->rates,array($this,'_rate_sort'));
		}
		return $this->rates;
	}
	
	function install($config_id){
		$data[] = array('config_id' => $config_id, 
                                'label'	 	=> 'File Header', 
                                'code' 		=> 'jne_header',
                                'type' 		=> 'text', 
                                'value' 	=> 'country|state|city|district|zip_code|rate|label',
                                'sort' 		=> 1 
                        );
		$data[] = array('config_id' => $config_id, 
                                'label'	 	=> 'Data File', 
                                'code' 		=> 'jne_file',
                                'type' 		=> 'file', 
                                'value' 	=> '',								
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
    
	function match_row($dest,$data){
        $is_good = TRUE;            
		
		if ( ( @$dest['to_zip'] && $data['zip_code']) && $data['zip_code'] == $dest['to_zip']) return $data;
		if ( ( @$dest['to_district'] && $data['district']) && $data['district'] == $dest['to_district']) {
			if ( ( @$dest['to_city'] && $data['city']) && $data['city'] == $dest['to_city']) {
				if ( ( @$dest['to_state'] && $data['state']) && $data['state'] == $dest['to_state']) {
					if ( (@$dest['to_country'] && $data['country']) && $data['country'] == $dest['to_country']) {return $data;}
				}
			}
		}
		return false;
		
		if($data['country'] != ''){                
			$country = ($dest["to_country"]);         
			$a = explode('|',$data['country']);									
			if (count(array_filter($a,function($i) use ($country) {return strcasecmp($i,$country) == 0 ; })) < 1 ) return false  ;
		}		
		// [1] To State
		if($data['state'] != ''){                
			$state = trim($dest["to_state"]);
			$a = explode('|',$data['state']);			
			if (count(array_filter($a,function($i) use($state) {return strcasecmp($i,$state) == 0 ; })) < 1 ) return false  ;
		}
		
		if($data['city'] != '' && @$dest["to_city"]){                
			$state = trim(@$dest["to_city"]);
			$a = explode('|',$data['city']);						
			if (count(array_filter($a,function($i) use($state) {return strcasecmp($i,$state) == 0 ; })) < 1 ) return false  ;
		}
		$withdistrict = false;
		if($data['district'] != '' && @$dest["to_district"] ){                
			$state = trim((@$dest["to_district"]));
			$a = explode('|',$data['district']);						
			if (count(array_filter($a,function($i) use($state) {return strcasecmp($i,$state) == 0 ; })) < 1 ) return false  ;
		}
/*			    
        if($val['zip_code'] != ''){
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
*/		
		if ($withdistrict) $data['label'] = $data['district'] . ' ('. $data['label'] .')';
        return $data;
    }
        
    function install_data($data){
            $file = __DIR__ . '/' . $data[0]['code']. '.csv';            
            if (!file_exists($file)) return  $data;
            $csv = array_map('str_getcsv', file($file));            
            if (!is_numeric($csv[0][7])) array_shift($csv);
            $data[0]['value'] = serialize($csv);        
            return $data;
        }
        
        function _get_csv_data($state=''){
            $csv = array_map('str_getcsv', file($file));
            array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header            
            if ($state){
                $csv = array_filter($csv, function($item){
                    return $item['state'] == '' || $item['state'] == $state ;
                });
            }
            return $csv;
        }
        
        
        
}