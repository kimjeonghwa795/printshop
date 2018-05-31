<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( __DIR__ . '/config.php');

class Photoprint_ext {
    var $name = 'Photoprint';
    var $version = '1.2';
    var $settings_exist =false;
    var $docs_url = '';
		    
    function order_checkout($data){                
        $carts =  array_keys($data['cart']['items']);
        ee()->db->where_in('cart_id' , $carts);        
        ee()->db->update('photoprints',array('order_id'=>$data['order_id']));             
        return $data;
    }   
    function order_status($data){        
        //error_log( __FUNCTION__ .  print_r($data,1));                
        return $data;
    }   
    
    function order_paid($trx){
        //error_log( __FUNCTION__ .  print_r($trx,1));                
        return $trx;
    }
    
    function cart_add(){
		$product_id = $this->ee->input->post('product_id');
        foreach ($_POST as $key => $val){
            if (strpos($key,'product_id') !== false) {
                $product_id = $val;
                break;
            }
        }        
        require_once(PATH_THIRD.'brilliant_retail/mod.brilliant_retail.php');
        $this->ee->brilliant_retail = new Brilliant_retail();
        $this->ee->load->model('product_model');
        //$this->ee->load->helper('brilliant_retail');
        
        unset($_SESSION['layout']);
        unset($_SESSION['item_id']);
        unset($_SESSION['cart_id']);
        unset($_SESSION['product_id']);
        
        $product = $this->ee->brilliant_retail->_get_product($product_id);                                
        $product = $product[0];        
                
        $next = $product['attr:next'][0]['value'] ?  $product['attr:next'][0]['value']  : $this->ee->input->post('next') ;
        $_SESSION['product'] = $product;                        
                        
        $_SESSION['layout'] = array();        
        $_SESSION['layout']['item_id'] = uniqid();
        $_SESSION['layout']['owner_id'] = session_id();
        $_SESSION['layout']['layout_id'] = $product['attr:lay'][0]['value']; 
        $_SESSION['layout']['product_id'] = $product_id;
        $_SESSION['layout']['layout_name'] = $product['title'];
        $_SESSION['layout']['max_selected'] = 1;
        $_SESSION['layout']['qty'] = 1;
        $_SESSION['layout']['sku'] = $product['sku'];
        $_SESSION['layout']['price'] = array( 'price'       => $product['price'],
                                              'base'        => $product['base'],
                                              'price_html'  => $product['price_html'] );
        
        $_SESSION['layout']['max_selected'] = @$product['attr:qty'][0]['value'];
        $_SESSION['layout']['options'] = array();
        ee()->input->delete_cookie('selections');
        if ($next){
            $_SESSION['layout']['instruction'] = sprintf('Please select %d photo to be printed on your square set',  array($_SESSION['layout']['max_selected']) );
            $this->ee->functions->redirect($next);        
        }else{                        
            $this->add_to_cart($_SESSION['layout']);
            $this->ee->functions->redirect('/cart');        
        }            	
	}
    
           
    function activate_extension(){
            $data = array();
			/*
            $data[] = array(
                    'class'     => 'Photoprint_ext',
                    'method'    => 'cart_add',
                    'hook'      => 'br_product_cartadd_after',
                    'priority'  => 10,
                    'version'   => $this->version,
                    'enabled'   => 'y'
                );
			*/
            $data[] = array(
                    'class'     => 'Photoprint_ext',
                    'method'    => 'order_checkout',
                    'hook'      => 'br_order_validate_after',
                    'priority'  => 10,
                    'version'   => $this->version,
                    'enabled'   => 'y'
                );
            $data[] = array(
                    'class'     => 'Photoprint_ext',
                    'method'    => 'order_status',
                    'hook'      => 'br_order_update_after',
                    'priority'  => 10,
                    'version'   => $this->version,
                    'enabled'   => 'y'
                );

            
            $data[] = array(
                    'class'     => 'Photoprint_ext',
                    'method'    => 'order_paid',
                    'hook'      => 'br_process_payment_after',
                    'priority'  => 10,
                    'version'   => $this->version,
                    'enabled'   => 'y'
                );

            ee()->db->insert_batch('extensions', $data);
                    
            return TRUE;
		
	}
	function disable_extension(){
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}
    
}