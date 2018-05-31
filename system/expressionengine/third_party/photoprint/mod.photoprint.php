<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( __DIR__ . '/config.php');
//if (!function_exists('rrmdir')) {
    
    function rrmdir($dir) { 
      if (strpos($dir,'uploads') === false || strpos($dir,'working') === false) return;
      $files = glob($dir . '/') ;
      foreach($files as $file) { 
        if(is_dir($file)) rrmdir($file); else unlink($file); 
      } 
      rmdir($dir); 
    }        
//}



class Photoprint {
    var $_name = 'photoprint';
    var $layout_id ;
    var $order_id;
    var $owner_id;
    var $im;
    var $is_admin = FALSE;

    function __construct() {
        @session_start();
        $this->ee =  & get_instance();
        $this->owner_id = session_id();
        $this->working_dir = FCPATH . 'working/' ;
        $this->upload_dir = FCPATH . 'uploads/' ;
        $this->page = filter_input(INPUT_GET,'page');
        $this->mode =  filter_input(INPUT_GET,'mode');
    }

    function get_user_dir(){
        //if (  ee()->session->userdata('member_id') ) return  $this->working_dir . ee()->session->userdata('member_id') .'/';
        return $this->upload_dir . session_id() .'/';
    }
    function _load_product($product_id) {
        //if ( isset($_SESSION['product']) && $_SESSION['product']['product_id'] == $product_id ) return $_SESSION['product'];
        
        require_once(PATH_THIRD.'brilliant_retail/mod.brilliant_retail.php');
        $this->ee->brilliant_retail = new Brilliant_retail();
        $this->ee->load->model('product_model');
        
        $product = $this->ee->product_model->get_products($product_id);                                
        $product = $product[0];        
        unset($product['related']);
        unset($product['detail']);
        unset($product['detail_id']);
        $attributes = array();
        //error_log(print_r($product,1));
        if (@$product['attribute']){
        foreach(@$product['attribute'] as $att){
           $val = $att['value'][0];
           foreach($att['options'] as $opt){
               if ($opt['attr_option_id'] == $val){
                   $val = $opt['label'];
               }
           }
           $attributes[$att['code']] = $val;
        }
        }
        $amt = $this->ee->brilliant_retail->_check_product_price($product,1);
        $product['price'] = $amt;        
        $product['attributes'] = $attributes;        
        $_SESSION['product'] = $product;
        $_SESSION['layout']['product_id']   = $product_id;
        $_SESSION['layout']['layout_id']    = @$product['attributes']['lay'];
        $_SESSION['layout']['max_selected'] = isset($product['attributes']['qty']) ? $product['attributes']['qty'] : 1;
        $_SESSION['layout']['layout_name']  = $product['url'];
        $_SESSION['layout']['qty'] = 1;
        $_SESSION['layout']['cover'] = $product['image_thumb'];
        
        $_SESSION['layout']['options'] = array();     
        //error_log(print_r($_SESSION['layout'],1));
        return $product;
    }
    
    function _get_product_from_sku($sku){
        //if ( isset($_SESSION['layout']['sku']) && $_SESSION['layout']['sku'] == $sku) return $_SESSION['layout']['product'];        
        $product_id = ee()->db->select('product_id')->where('sku',$sku )->get('br_product_configurable')->row('product_id');        
        
        if (!$product_id) {
            $this->ee->functions->redirect('/products');
        }
        
        $_SESSION['layout']['sku'] = $sku;
        
        if ( in_array(substr($sku,0,2), array('cp' , 'mg') )) {
            $_SESSION['layout']['max_selected'] = (int)substr($sku,4,2);
        }
        $product = $this->_load_product($product_id);
        $configurable = array();        
        foreach($product['configurable'] as $conf){        
            if ($conf['sku'] == $sku){ 
                $configurable = $conf;
                break;                
            }
        }
        $product['configurabled'] = $configurable;
        $product['price']['price'] = $product['price']['base'] + (float)$configurable['adjust'];        
        $product['price']['adjust'] = (float)$configurable['adjust'];
        $product['price']['price_html'] = @$this->ee->brilliant_retail->_config["currency_marker"]. ' ' . number_format($product['price']['price'],0,'.',',');
        $_SESSION['layout']['product'] = $product;
        $_SESSION['layout']['product_id'] = $product_id;        
        $_SESSION['layout']['sku'] = $sku;
        $_SESSION['layout']['cover'] = $product['image_thumb'];
        return $product;
    }
    function _get_sku_from_options($product_id,$options){
        
    }    
    function product(){
        $product_id = $this->ee->input->post('product_id');
        $sku = $this->ee->input->post('sku');
        $configs = array();
        foreach ($_POST as $key => $val){
            if (strpos($key,'product_id') !== false) {
                $product_id = $val;
                break;
            }
            
            if (strpos($key,'configurable') !== false) {
                $configs[] = $val;
            }
        }
                        
        unset($_SESSION['layout']);
        unset($_SESSION['item_id']);
        unset($_SESSION['cart_id']);
        unset($_SESSION['product_id']);
        $_SESSION['layout'] = array();
        
        $product = $this->_load_product($product_id);
        if ($product['type_id'] == 3 && count($configs)) {
            //error_log(print_r($product,1));
        }
                
        $_SESSION['layout']['item_id'] = uniqid();
        $_SESSION['layout']['owner_id'] = session_id();
        if ($sku){
            $_SESSION['layout']['sku'] = $sku;
        }
        ee()->input->delete_cookie('selections');
                                
        $next = isset($product['attributes']['next']) ?  @$product['attributes']['next']   : $this->ee->input->post('next') ;
                
        if ($next){
            $_SESSION['layout']['instruction'] = sprintf('Please select %d photo to be printed on your square set',  array(@$_SESSION['layout']['max_selected']) );
            $this->ee->functions->redirect($next);        
        }else{                        
            $this->add_to_cart($_SESSION['layout']);
            $this->ee->functions->redirect('/cart');        
        }            
    }

    function parameter(){        
        $var = $this->ee->input->post('var');
        $val = $this->ee->input->post( $var );        
        $_SESSION['layout'][$var] = $val;        
        $_SESSION['layout']['sku']  = $this->get_sku($_SESSION['layout']['product_id'],$var,$val);        
        if ($this->ee->input->post('label')){
            $prev_opts = $_SESSION['layout']['options'] ;
            $opts =  array( ucwords (str_replace('-',' ',$var))  => $this->ee->input->post('label') );
            $_SESSION['layout']['options']  = array_merge($prev_opts,$opts);        
        }
            
        if ($this->ee->input->post('add_to_cart') == true ) {
            $this->add_to_cart($_SESSION['layout']);
        }
        $next = $this->ee->input->post('next') ? $this->ee->input->post('next') : '/instagram';
        //error_log( print_r($_REQUEST,1) . PHP_EOL . $_SESSION['layout']['sku'] . PHP_EOL  . print_r($_SESSION['layout'],1));
        if (substr($_SESSION['layout']['sku'],0,2) == 'cp' || substr($_SESSION['layout']['sku'],0,2) == 'pp' ) $next .= '/' . $_SESSION['layout']['sku'];
        $this->ee->functions->redirect($next);        
    }    
    
    function get_sku($product_id,$var,$val){                
        //if ($product_id){ $product_id = $_SESSION['product']['product_id'];}
        error_log( print_r($_REQUEST,1) . PHP_EOL . $_SESSION['layout']['sku'] . PHP_EOL  . print_r($_SESSION['layout'],1));
        $sku_pref = $_SESSION['product']['sku'];
        $prev_sku = isset($_SESSION['layout']['sku']) ? $_SESSION['layout']['sku'] : $_SESSION['product']['sku'];
        $val =  str_pad($val,2,'0',STR_PAD_LEFT);
        switch($var){
        case  'quantity':
            $_SESSION['layout']['max_selected'] = (int)$val;
            return $prev_sku ?  substr_replace($prev_sku,$val,4,2): substr_replace($sku_pref,$val,4,2);
        case  'background':
            return substr_replace($prev_sku, $val, 0,2);            
        case  'title':
            return $prev_sku;
        default :
            return substr_replace($sku_pref, $val, 2,2);            
        }        
    }
    function aspect_ratio($sku=''){     
		if ( ! $sku ) {
			$sku = @ee()->TMPL->fetch_param('sku');
		}
		$aspectRatios = array(
          'cp02'    => 1063/709,
          'cp03'    => 1500/1051,
          'cp04'    => 1795/1205,
          'cp05'    => 2102/1500,
          'cp06'    => 2398/1795,
          'cp10'    => 3000/2398,
          'cp11'    => 3602/2398,
          'cv23'    => 3602/2398,
          'cv46'    => 7087/4724,
		);
        return isset($aspectRatios[substr($sku,0,4)]) ? $aspectRatios[substr($sku,0,4)] : 1 ;
    }        

    function select(){        
        $owner_id = $this->ee->input->post('owner_id');        
        $sku = $this->ee->input->post('sku');
        $seq = 1;                
        $item_id  = $this->ee->input->post('item_id');
        
        
        $working_dir = $this->working_dir . $item_id . '/';
        $upload_dir = $this->get_user_dir();
        $selections  = json_decode($this->ee->input->cookie('selections'),JSON_OBJECT_AS_ARRAY ) ;                
        $total = count($selections);
        $max = $_SESSION['layout']['max_selected'];        
        
        if ($total < $max) $this->ee->functions->redirect($_SERVER['HTTP_REFERER']);
                
        @rrmdir($working_dir);
        @mkdir($working_dir);            
            
        $userfiles = glob($upload_dir.'/*.{jpg,jpeg,png,bmp,gif,JPG,JPEG,PNG,BMP,GID}',GLOB_BRACE);
        $files = array();
        foreach($userfiles as $f) {
            $files[pathinfo($f,PATHINFO_FILENAME)] = $f;
        }
        
        $selects = array();        
        $db = $this->ee->db;
        foreach ($selections as $seq => $id){
            $file = @$files[$id];
            if (!$file) break;
            
            $file_path =  $file;                
            $file = str_replace($upload_dir . '/','',$file);
            $working_file = $working_dir . '/'. $file;
            copy($file_path,$working_file);
            $metafile = ($upload_dir . $id. '.meta');
            $meta = @file_get_contents($metafile);
            $meta = mb_convert_encoding($meta,'UTF-8'); 
//            error_log($meta);
            $selects[] = array( 'file' => $file,
                                'layout_id' => $sku ,
                                'sequence' => $seq + 1,
                                'owner_id' => $owner_id,
                                'item_id' => $item_id,                                
                                'meta' => $db->escape_str($meta),
                            );                        
        }
        
        if (count($selects) == $max){         
            if ( substr($sku,0,2) == 'pb' ){
                $cover = end($selects);
                $cover['sequence'] = 0;
                $selects[] = $cover;
            }
            ee()->db->query("SET NAMES 'utf8mb4';");
            ee()->db->delete('photoprints',array('item_id' => $item_id , 'owner_id' => $owner_id ));
            ee()->db->insert_batch('photoprints',$selects);            
            $next = '/arrange/' . $item_id ;
        }else{
            $next = $_SERVER['HTTP_REFERER'];
        }       
        //error_log(count($selects) .":". $max . ':' .$next);
        if ( $this->ee->input->is_ajax_request() ){
            $this->ee->output->send_ajax_response("window.location = '$next';");
        }else{
            $this->ee->functions->redirect($next );
        }
        
        
    }
    function arrange(){        
        $layout_id = $this->ee->input->post('sku') ;
        $sku = $this->ee->input->post('sku') ;
        $owner_id = $this->ee->input->post('owner_id') ?  $this->ee->input->post('owner_id') :@$_SESSION['owner_id'];
        $item_id = $this->ee->input->post('item_id') ?  $this->ee->input->post('item_id') : FALSE;
        $selections = $this->ee->input->post('positions');        
        $cropdata = $this->ee->input->post('crop_data');        
        $metas = $this->ee->input->post('metas');
        $db = $this->ee->db;        
        $new_item = false;
        
        if ( ! $item_id ) {
            $item_id = uniqid($sku.'-');
            $new_item = true;
            $_SESSION['layout']['item_id'] = $item_id  ;         
        }                       
        
        $ins =  array();
        foreach ($selections as $seq => $file) {
            $working_file = $this->working_dir . $item_id . '/' . $file;
            if (!file_exists($working_file) || !is_file($working_file) ) continue;            
            $metas[$seq] = json_encode(json_decode(str_replace('\"','"',$metas[$seq]) ,JSON_OBJECT_AS_ARRAY));            
            $file_data =   array(  'sequence'  => $seq,
                        'item_id'   => $item_id,
                        'file'      => $file,
                        'owner_id'  => $owner_id,                        
                        'layout_id' => $sku,
                        'crop_data' => @$cropdata[$seq],
                        'meta'      => $db->escape_str(@$metas[$seq]),
                    );
                        
            $ins[] = $file_data;
        }              
                
        if (count($ins)) {
            $db->delete('photoprints',array('item_id' => $item_id ));
            $db->insert_batch('photoprints',$ins);
        }
        
        reset($selections);       
        $_SESSION['layout']['cover'] = '/working/'.$item_id .'/'.  current($selections);
        
        $_SESSION['layout']['options']['Title'] = $_SESSION['layout']['title'] = $_SESSION['layout']['title'] = $title = $this->ee->input->post('title');

        $add_to_cart = $this->ee->input->post('add_to_cart');        
        if ($add_to_cart){
            $cart_id = $this->add_to_cart($_SESSION['layout']);
        }
               
        if ($next = $this->ee->input->post('next')){
            $this->ee->functions->redirect($next );
        }else {
            $this->ee->functions->redirect('/cart/' .$cart_id );
        }        
    }
    function delete_selection(){
        $file =  $this->ee->input->get('file');
        $owner_id =  $this->ee->input->get('owner_id');
        $seq =  $this->ee->input->get('seq');
        if ($this->ee->db->delete('photoprints',array('file'=>$file,'sequence'=>$seq, 'owner_id' => $owner_id ))){
            $this->ee->output->send_ajax_response(true);
        }else {
            $this->ee->output->send_ajax_response(false);
        }        
    }
    
    function files(){
        $item_id = $this->ee->TMPL->fetch_param('item_id');        
        
        $files = ee()->db->from('photoprints')->where('item_id',$item_id)->order_by('sequence')->get()->result_array();                
        
        if ( ! count($files) ){
            return ee()->TMPL->no_results();
        }
        if ( @$_SESSION['layout']['sku'] != $files[0]['layout_id'] ){
            $this->_get_product_from_sku($files[0]['layout_id']);
        }
        
        $res = array('cover'=>array(),'owner_id'=>$files[0]['owner_id'],'layout_id'=> $files[0]['layout_id'], 'next'=>''); 
        if (substr($files[0]['layout_id'],0,2) == 'pb'){
            $res['cover'][] = array_shift($files);
            $res['next']  = '/review/' . $item_id;
            //error_log(print_r($res['cover'],1));
        }
        if (substr($files[0]['layout_id'],0,2) == 'pp'){
            $res['next']  = '/photoprint/background/' . $item_id;
        }
        $res['aspectratio'] = $this->aspect_ratio($files[0]['layout_id']);        
        $res['results'] = $files;
        return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, array($res) );
    }
    
    
    function _get_price($product,$sku,$qty){
        $amt = $this->ee->brilliant_retail->_check_product_price($product,$qty);
        //error_log(__LINE__ . print_r($amt,1));
        $configurable = array();        
        foreach($product['configurable'] as $conf){
            if ($conf['sku'] == $sku){ 
                $configurable = $conf;
                break;                
            }
        }

        if ($configurable['adjust']){
            $amt["price"] = $this->ee->brilliant_retail->_currency_round(($amt["price"] - abs($configurable["adjust"])));
        }else{
            $amt["price"] = $this->ee->brilliant_retail->_currency_round(($amt["price"] - abs($configurable["adjust"])));
        }
        
        return $amt;
    }
    function add_to_cart($info,$new_item=TRUE){        
        
        //error_log(print_r($info,1));
                
        $product_id =  $info['product_id'];               
        $item_id    =  @$info['item_id'];
        $qty        =  @$info['qty'] ? $info['qty'] : 1.0;
        $sku        =  @$info['sku'];
        require_once(PATH_THIRD.'brilliant_retail/mod.brilliant_retail.php');
        $this->ee->brilliant_retail = new Brilliant_retail();
        //$this->ee->load->model('product_model');
        //$this->ee->load->helper('brilliant_retail'); 
        $cart_id  = $this->ee->input->post('cart_id');            
        
        if (isset($_SESSION['itemmaps'][$item_id])) return $_SESSION['itemmaps'][$item_id];
                
        if ( ! $new_item && $cart_id) {
            $this->ee->db->delete('br_cart', array('cart_id' => $cart_id,'status' => 0));        
        }
        
        if ($sku){
            $product = $this->_get_product_from_sku($sku);
        }else{
            $product = $this->_load_product($product_id);    
            $sku = $product['sku'];
        }
        
        
        //error_log(print_r($product,1));
        
        $opts   = '<li><label>SKU</label> '. $sku .'</li>';        
        $opts  .= '<li><label>ItemId</label> '. @$info['item_id'].'</li>';        
        $options = array_filter($info['options']);
        foreach ($options as $op => $opt) {
            $opts .= '<li><label>'  . $op .'</label> '.$opt.'</li>';
        }
        $content = array('product_id'		=> 	$product["product_id"],
                        'type_id'		    => 	$product["type_id"],
                        'url_title' 		=> 	$product["url"],
                        'sku' 			    => 	$sku,
                        'configurable_id' 	=>  @$product['configurabled']['configurable_id'],
                        'quantity'  		=> 	$qty ,
                        'image_large' 		=> 	$info['cover'] ,
                        'image_thumb' 		=> 	$info['cover'] ,
                        'price_html' 		=> 	$product['price']["price_html"],
                        'base'   		    => 	$product['price']["base"],
                        'price'   		    => 	$product['price']["price"],
                        'cost' 			    => 	$product["cost"],
                        'adjust'		    => 	(float)@$product['price']['adjust'],
                        'discount'		    => 	$this->_discount_amount($product['price']["price"]),
                        'title'    		    => 	isset($info['title']) ? $product["title"] . ' - ' . $info['title'] : $product["title"],
                        'taxable' 		    => 	$product["taxable"],
                        'weight' 		    => 	$product["weight"],
                        'shippable' 		=> 	$product["shippable"],
                        'options' 		    =>  serialize($opts),
                        'subtotal' 		    => 	number_format($product['price']["price"] * $qty ,0,'.',''),
                        );        
        $data = array('member_id' => $this->ee->session->userdata["member_id"], 
                'session_id' => session_id(),
                'content'   => serialize($content),
                'updated'  => date("Y-n-d G:i:s"));

        if($this->ee->extensions->active_hook('br_product_cartadd_before') === TRUE){
                $data = $this->ee->extensions->call('br_product_cartadd_before', $data);
        }
        
        $data['cart_id'] = $this->ee->product_model->cart_set($data);
        
        $this->ee->db->where('item_id' , $item_id);        
        $this->ee->db->update('photoprints',array('cart_id'=> $data['cart_id']));
        
        if (isset($_SESSION['itemmaps'])){
            $_SESSION['itemmaps'][$item_id] = $data['cart_id'];
        }else {
            $_SESSION['itemmaps'] = array($item_id => $data['cart_id']);
        }

        if($this->ee->extensions->active_hook('br_product_cartadd_after') === TRUE){
            $data = $this->ee->extensions->call('br_product_cartadd_after', $data);                        
        }
        
        return $data['cart_id'] ;        
    }
    
    
    function get_image(){
       
       $type    = $this->ee->input->get('type');
       $order_id= $this->ee->input->get('order_id');
       $new     = $this->ee->input->get('new');
       $item_id = $this->ee->input->get('item_id');
       $sku     = $this->ee->input->get('sku');
       
       $layout = substr($item_id,0,6);
       $format = '.png';
               
       $this->ee->db->where('item_id',$item_id);       
       //$this->ee->db->where('sequence >',$item_id);       
       $this->ee->db->order_by('sequence');       
       $this->ee->db->from('photoprints');       
       $photoprint = $this->ee->db->get()->result_array();              
       //error_log(__LINE__ . ':'. count($photoprint) . PHP_EOL .print_r($photoprint,1) );
       $images = array();
       
       $working_dir = $this->working_dir .$order_id .'/'. $item_id .'/';       
       if ($new ){
          rrmdir($working_dir);
       }
       
       if (!file_exists($working_dir)){
           mkdir($working_dir,0777,true);
       }
       
       $this->ee->load->helper('download_helper');
       if ($type=='t'){
           $f = current($photoprint);        
           $img = $this->working_dir . $f['item_id'] . '/' . $f['file'] ;
           //error_log(__LINE__ . $img);           
           header('Content-Type : image/png');
           echo file_get_contents($img);
           exit();
       }
       set_time_limit(0);
       ignore_user_abort(1);
       ini_set('memory_limit','2048M');
       
       //image preprocess;
	   $layout_id = current($photoprint)['layout_id'];
	   $aR = $this->aspect_ratio($layout_id);
       foreach($photoprint as  $f){
           
           $file = $this->working_dir . $f['item_id'] . '/' . $f['file'] ;
           $ext  = pathinfo($file,PATHINFO_EXTENSION);
           $dest = $working_dir . $f['sequence'] . '.' . $ext;
           if ( ($f['crop_data']) ) {
               $this->crop($file,$f['crop_data'], $dest );
           }else{
               //error_log(__LINE__ . ' __ '. $f['sequence'].' : '. $file. ':' . $aR );
               $this->crop($file,$aR,$dest);               
           }
           $images[$f['sequence']] = $dest ;
           $metas[$f['sequence']] = $f['meta'];
       }

       
       
       $product = $this->_get_product_from_sku($layout_id);       
       $layout_file = $this->_find_layout_file($layout_id,@$product['attributes']['file']);
                     
       if ( substr($layout_file,-4) =='.svg'){
           $layout = $this->_convert_svg($layout_file);
       }else {
           $layout = include $layout_file;
       }
       
       
       if (substr($layout_id,0,2) == 'pb'){
           $cover   = $images[0];
           unset($images[0]);
           $meta    = $metas[0];
           unset($metas[0]);
       }
       
              
       require __DIR__ . '/photoprinter.php';
       $pp =  new PhotoPrinter($layout,$images,$metas,$working_dir);
       $result_file = $order_id . '-' . $item_id . '.jpg';
       $result_file = $pp->generate($result_file);
       
       if (substr($layout_id,0,2) == 'pb'){
           $pp->layout_id = $layout_id;
           error_log('META:'.$meta);
           if ( !$meta || $meta == 'null') {
               error_log('NULL META:' . print_r($_REQUEST,1));
               $meta = @$_REQUEST['title'];
           }
           
           if ( !is_array($meta)){
               $meta = array('title' => $meta);
           }
           
           $pp->generateCover($cover,$meta);
       }
       
       if ( in_array(substr($sku,0,2) , array('pp','pg','ph')) ){           
            
            $backs = glob(__DIR__ .'/backgrounds/'. substr($sku,0,4) .'/*.{png,jpg,jpeg}' ,GLOB_BRACE);            
            foreach($images as $seq => $img){
                $images[$seq] = $backs[array_rand($backs)];
            }
            
            // $lmax = (substr($sku,2,2) == '12')? 3 : 2;
            
            // $swapped = array();
            // foreach($metas as $seq => $meta){                
                // $swapwith = swapwith($seq,$lmax);                
                // $swapped[$seq] = @$metas[$swapwith];                
            // }
                      
            //$layout_file = str_replace('.php','_back.php',$layout_file);            
            //$layout = include $layout_file;
            
            //$pp =  new PhotoPrinter($layout,$images,$swapped,$working_dir);             
            $result_file  = $pp->generateBack($images,$metas);           
       }
                   
       //error_log($product['attributes']['post_pr']);
       
       if ($product['attributes']['post_pr'] == 'Zip' ){
           $result_file = $order_id . '-' . $item_id . '.zip';           
           $result_file = $pp->generate_zip($result_file);           
//           error_log('done generate zip:' . $result_file);
       }
       
       if ($product['attributes']['post_pr'] == 'Pdf' ){
           $result_file = $order_id . '-' . $item_id . '.pdf';
           
           $result_file = $pp->generate_pdf($result_file);//$image = '';           
//           error_log('done generate pdf:' . $result_file );
       }       
//       error_log('done post_process' . $result_file);
       //force_download($result_file, $image);       
       $vars = array( 'item_id' => $item_id, 'order_id'=> $order_id,
                    'link' => str_replace(FCPATH , '/' , $result_file) );
       return $this->ee->load->view('download',$vars);
       //return $this->_view('download',$vars);
       
    }
    function check_ready(){
       $type    =  $this->ee->input->get('type');
       $order_id=  $this->ee->input->get('order_id');
       $new     =  $this->ee->input->get('new');
       $item_id =  $this->ee->input->get('item_id');       
       
    }
    
    function squarize($file,$size=0){
            list($width, $height, $type, $attr) = getimagesize($file);  
            if ($width == $height && !$size) return $file;
            
            $img = imagecreatefromstring( file_get_contents ($file) );
            $back = imagecolorallocate($img, 255, 255, 255);

            
            if (!$size)
                $size = max($width, $height) ;            
            $dest = imagecreatetruecolor($size,$size);
            
            imagecolortransparent($dest,$back);            
            imagecolorallocatealpha ($img, 255, 255, 255,127 );
            imagefill($dest,0,0,$back); 
            $vpad = ($width - $height)/2;
            if ($vpad > 0){
                imagecopyresampled($dest,$img,0,$vpad,0,0,$width,$height,$width,$height);
            }else{
                imagecopyresampled($dest,$img,abs($vpad),0,0,0,$width,$height,$width,$height);
            }
                        
            unlink($file);
            switch($type){
                case IMAGETYPE_JPEG  : {
                    imagejpeg ($dest,$file);
                    break;
                }
                case IMAGETYPE_PNG   : {
                    imagepng  ($dest,$file);
                    break;
                }                
                case IMAGETYPE_GIF : {
                    imagegif  ($dest,$file);
                    break;
                }
            default : {
                imagepng  ($dest,$file);
                break;
            }
            }
                        
            imagedestroy($img);
            imagedestroy($dest);
            return $file;
    }
    function fit($toFit,$caR){
        $box = array();                       
        $fW = 1;
        $taR = $toFit['width'] / $toFit['height']; 
        if ($toFit['height'] < $toFit['width'] && $caR < 1) {
            $fW = 0;
        }			
        if ($toFit['height'] >= $toFit['width'] && $caR >= 1) {
            $fW = 0;
        }			
        
        if ( $fW ) {
            $box['width']    = $toFit['width'];
            $box['x']     = 0;
            $box['height']   = $box['width'] / $caR;
            $box['y']	    = ($toFit['height'] - $box['height'])/2 ;//+ $toFit['top'];
        }else {            
            $box['height'] = $toFit['height'];
            $box['y']	   = 0;
            $box['width']  = $box['height'] * $caR;
            $box['x']   = ($toFit['width'] - $box['width'])/2 ;//+ $toFit['left'];
        }
        return $box;
    }
                
    function crop($file = false, $data = false,$save=null){            
        if (ee()->input->post('crop')) {
            $data = ee()->input->post('crop');
            $file = ee()->input->post('file');
            $item_id  = ee()->input->post('item_id');
            $pos = ee()->input->post('pos');
            return ee()->db->update('photoprints',
                        array('crop_data' => $data),
                        array('file' => $file, 'sequence'=>$pos,'item_id' => $item_id) );
        }
        
        if (! $file ) {
            $dir = 'uploads/' + session_id();
            if (ee()->input->get('dir')) {
                $dir = 'working/' . ee()->input->get('dir');
            }                                
            $file = FCPATH . $dir . '/' .ee()->input->get('file');                
        }
                    
        
        list($width, $height, $type, $attr) = getimagesize($file);  
        
        
        if (ee()->input->get('crop')){
            $data = ee()->input->get('crop');            
        }
        if ( is_numeric($data) || $data == '' ){                
            $ar = ee()->input->get('ar')? ee()->input->get('ar') : $data;            
            $data = $this->fit(array('width' => $width,'height'=>$height), $ar);                
        }
        if (is_string($data) && $data ){
            //error_log(__LINE__ . $file . PHP_EOL . $data);
            $data = (json_decode( base64_decode($data),JSON_OBJECT_AS_ARRAY) );            
            //error_log(__LINE__ . print_r($data,1). PHP_EOL . $data['width'].":".$data['height']);
            $ar = $data['width']/$data['height'];
        }
        
        $rotate = @$data['rotate']; unset($data['rotate']);
        $scaleX = @$data['scaleX'] ? $data['scaleX'] : 1 ; unset($data['scaleX']);
        $scaleY = @$data['scaleY'] ? $data['scaleY'] : 1 ; unset($data['scaleY']);
        
                    
        
        //error_log( $file . ":" . $width/$height. ":".  print_r($data,1));
        if ($ar == $width/$height){
            if ($save) {
                return copy($file,$save);    
            }else {                
                $file = str_replace(FCPATH, '/',$file );
                return header('Location: '. $file );
            }            
        }
        
        
        $img = imagecreatefromstring( file_get_contents ($file) );                      
        $back = imagecolorallocatealpha ($img, 255, 255, 255,127 );            

        if ($rotate) {
            $img = imagerotate($img,-$rotate,$back);
        }
        
        //$size = max($data['width'],$data['height']);
        $dest = imagecreatetruecolor($data['width'],$data['height']);
        imagecolortransparent($dest,$back);            
        //imagealphablending($dest, false);
        imagesavealpha($dest, true);
        imagefill($dest,0,0,$back);

        //error_log('src image size : ' .  imagesx($img) . 'x' . imagesy($img));
        //error_log('dest image size : ' .  imagesx($dest) . 'x' . imagesy($dest));

        if ($data['x'] < 0 || $data['y'] < 0) {
                        
            $dst_x = abs($data['x']);                
            $dst_y = abs($data['y']);
            
            $src_x = max(0,$data['x']);
            $src_y = max(0,$data['y']);
//                imagecopyresampled($dest,$img,$dst_x,$dst_y,0,0,$width,$height,$width,$height);

//            error_log($dst_x . ':' . $dst_y . ' ; ' . $src_x . ':' . $src_y);
//            error_log($width . ':' . $height . ' ; ' . $data['width'] . ':' . $data['height']);
            //error_log(
            imagecopyresampled($dest, $img,
                    $dst_x , $dst_y ,
                    $src_x , $src_y ,
                    $data['width'] - $dst_x*2, 
                    $data['height'] - $dst_y*2,
                    $width , $height                         
                    ) ;
//            );            
//            error_log('EXTEND   ' .(string)$save .':'. print_r($data,1));
        }else{
            //error_log('CROP   '. print_r($data,1));
            $dest = imagecrop($img,$data);
        }
          
                      
        if ($scaleX != 1 || $scaleY != 1) {
            $dest = imagescale ($dest,$scaleX * $width ,$scaleY * $height,IMG_BICUBIC_FIXED );                
        }
        
        // if ($rotate){
            // $dest = imagerotate($dest,-$rotate,$back);
        // }
        
        imagedestroy($img);
        if ($save) return imagepng($dest,$save);
        
//        header('Max-Age: 3600');
//        header('Expires: '  .  date('r', time() + 3600) );
        header('Content-Type: image/png');            
        return imagepng($dest);         
    }
    
    
    function layout_viewer($filename=''){
        if (!$filename) $filename = ee()->TMPL->fetch_param("file") ;
        if (!file_exists($filename)) $filename = __DIR__ . '/layouts/' . $filename;
        
        $layout = include($filename);
        $s  =  print_r($layout,1);
        //echo "<pre>$s</pre>";
        $l = '<svg width="'. $layout->width.'" height="'.$layout->height.'" style="backrground-color:white;border:1px dashed black;">';
        //$l .= '<rect width="'. $layout->width.'" height="'.$layout->height.'" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(0,0,0)">';
        if (@$layout->gutter){
            $l .= '<g id="gutters">';
            foreach ($layout->gutter as $idx => $g) {
                $l.='<line id="g'.$idx.'"  x1="' .$g['x1']. '"  y1="' .$g['y1']. '" x2="' .$g['x2']. '"  y2="' .$g['y2']. '" stroke-dasharray="5,5" stroke="silver"/>';
            }
            $l .= '</g>';
        }
        
        
        $l .= '<g id="boxs">';
        foreach ($layout->box as $idx => $box) {
            $posX = $box[0]['x']; 
            $posY = $box[0]['y'];
            $w  = $box[1]['x'] - $box[0]['x'];
            $h  = $box[2]['y'] - $box[0]['y'];
            if (@$box['crop']){
                $r = $w/2;
                $l.='<circle id="c'.$idx.'" cx="' . ($posX + $w/2 ) . '"  cy="' . ($posY+ $h/2) . '" r="'. $r .'" stroke="gray" fill="silver"/>';
            }else {
                $l.='<rect id="r'.$idx.'"  x="' .$posX. '"  y="' .$posY. '" width="'. $w .'" height="'. $h .'" style="fill:rgb(255,255,255);stroke-width:1;stroke:rgb(4,4,4)"/>';
            }
        }
        $l .= '</g>';
        //$l .= '</rect>';
        $l .= '</svg>';
        return $l;
    }
    
    function border(){
        $border = $this->ee->input->post('border') ;
        $_SESSION['border'] = $border;
        $_SESSION['layout']['border'] = $border;
        $_SESSION['layout']['sku']  = $this->get_sku($_SESSION['product_id']);
                        
        $next = ee()->input->post('next')? ee()->input->post('next'): '/photoprint/quantity';
        $this->ee->functions->redirect($next);        
    }
    function size(){
        $size = $this->ee->input->post('size') ;
        $_SESSION['size'] = $size;        
        $_SESSION['layout']['size'] = $size;
        $_SESSION['layout']['max_selected'] = 15;            
        
        
        
        $_SESSION['layout']['sku']  = $this->get_sku($_SESSION['product_id'],'size',$size);
        $_SESSION['sku'] =  $_SESSION['layout']['sku']  ;
        
        $next = ee()->input->post('next')? ee()->input->post('next'): '/instagram';
                
        $this->ee->functions->redirect($next);
    }
    function quantity(){
        $quantity = $this->ee->input->post('quantity') ;
        $_SESSION['quantity'] = $quantity;
        $_SESSION['layout']['quantity']  = $quantity;
        $_SESSION['layout']['max_selected'] = $quantity;
        $_SESSION['layout']['sku']  = $this->get_sku($_SESSION['product_id'],'quantity',$quantity);
        
        
        $next = ee()->input->post('next')? ee()->input->post('next'): '/instagram';
        
        $this->ee->functions->redirect($next);
    }
    function cover(){
        $cover = $this->ee->input->post('cover') ;
        $_SESSION['cover'] = $cover;
        $_SESSION['layout']['cover']  = $cover;        
        $_SESSION['layout']['sku']  = $this->get_sku($_SESSION['product_id'],'cover',$cover);
        $next = ee()->input->post('next')? ee()->input->post('next'): '/instagram';
        $this->ee->functions->redirect($next);
    }
    
    function canvas(){
        $canvas = $this->ee->input->post('canvas');
        $_SESSION['canvas'] = $canvas;
        $_SESSION['layout']['canvas']  = $canvas;        
        $_SESSION['layout']['max_selected'] = 1;
        $_SESSION['layout'][$this->ee->input->post('var')] = $this->ee->input->post('size');
        $layout_id = $this->ee->input->post('layout_id');
        
        $_SESSION['layout_id'] = $layout_id;        
        $_SESSION['layout']['layout_id']  = $layout_id;        
        $_SESSION['layout']['sku']  = $this->get_sku($_SESSION['product_id'],'size',$this->ee->input->post('size'));
        $next = '/instagram';
        if ( $this->ee->input->post('next') ) {
            $next = $this->ee->input->post('next');
        }        
        $this->ee->functions->redirect($next);
    }

    function _convert_svg($file){
        return object();
    }
    
    function _find_layout_file($layout_id,$default=''){
        $UPLOAD_DIR = FCPATH . '/media/file/' ;
        
        $filename = $UPLOAD_DIR . $layout_id .'.svg';
        if (file_exists($filename)) return $filename;
        $filename = $UPLOAD_DIR . $layout_id .'.php';
        if (file_exists($filename)) return $filename;

        $filename = $UPLOAD_DIR . substr($layout_id,0,4) .'00.svg';
        if (file_exists($filename)) return $filename;
        $filename = $UPLOAD_DIR . substr($layout_id,0,4) .'00.php';
        if (file_exists($filename)) return $filename;

        $filename = $UPLOAD_DIR . substr($layout_id,0,2) .'0000.svg';
        if (file_exists($filename)) return $filename;
        $filename = $UPLOAD_DIR . substr($layout_id,0,2) .'0000.php';
        if (file_exists($filename)) return $filename;
        
        $filename = __DIR__ . '/layouts/' . $layout_id .'.svg';
        if (file_exists($filename)) return $filename;

        $filename = __DIR__ . '/layouts/' . $layout_id .'.php';
        if (file_exists($filename)) return $filename;

        $filename = __DIR__ . '/layouts/' . substr($layout_id,0,4)  .'00.svg';
        if (file_exists($filename)) return $filename;
        
        $filename = __DIR__ . '/layouts/' . substr($layout_id,0,4)  .'00.php';
        if (file_exists($filename)) return $filename;

        $filename = __DIR__ . '/layouts/' . substr($layout_id,0,2)  .'0000.svg';
        if (file_exists($filename)) return $filename;
        $filename = __DIR__ . '/layouts/' . substr($layout_id,0,2)  .'0000.php';
        if (file_exists($filename)) return $filename;
        
        return $UPLOAD_DIR . $default;
    }
    function _discount_amount($total = 0){
		if(!isset($_SESSION["discount"])){
			return 0;
		}
		if($_SESSION["discount"]["code_type"] == 'percent'){
			return $total * ($_SESSION["discount"]["amount"] / 100);		
		}elseif($_SESSION["discount"]["code_type"] == 'fixed'){
			return $_SESSION["discount"]["amount"];		
		} 
		return 0;
	}
        
}
