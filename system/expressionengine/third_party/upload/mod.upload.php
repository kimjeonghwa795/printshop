<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function rrmdir($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)) rrmdir($file); else unlink($file); 
  } rmdir($dir); 
}

define('FILE_KEEP_HOURS', 6);
require_once(PATH_THIRD."simplee_facebook/models/EE_Object.php");
require_once(PATH_THIRD."simplee_facebook/models/Facebook_Photo.php");
require_once(PATH_THIRD."simplee_instagram/models/Instagram_User.php");
require_once(PATH_THIRD."simplee_instagram/models/Instagram_Post.php");
define('WORK_PATH',FCPATH . 'working/') ;
define('WORK_URL','/working/') ;
define('UPLOAD_PATH',FCPATH .'uploads/' );
define('UPLOAD_URL','/uploads/' );
class Upload {
        var $version = '1.1';
	var $return_data	= '';
	var $p_limit = '';
        var $user_dir;

	
	function Upload(){
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();                
                @session_start();
                $this->working_dir = WORK_PATH;
                $this->upload_dir = UPLOAD_PATH;
                $this->user_dir = $this->get_user_dir();    
                $this->user_url =  $this->get_user_url();
	}
        
        function _get_upload_data($source){
                $session_id = session_id();
                
                if ($source == 'upload') {
                    $this->access_token =  ee()->input->get_post('token') ?  ee()->input->get_post('token') : session_id();
                    $this->username = ee()->session->userdata['username'];
                    $this->user_id = ee()->session->userdata['member_id'];
                    return;
                }

                ee()->db->select('data');
                ee()->db->where('session_id', $session_id);
                $query = ee()->db->get('social_login_session_data');
                $data = array();
                if ($query->num_rows()>0){
                        $row = current($query->result_array());
                        $data = unserialize(@$row['data']);                            
                        $data['session_id'] = $session_id;
                }                
                if (!isset($data[$source])) return '/?ACT=96&provider='+$source+'&RET=' .  ee()->config->item('site_url') . 'upload#' .$source  ;                
                $this->username =  $data[$source]['username'];
                $this->user_id  =  $data[$source]['alt_custom_field'];
                $this->access_token =  $data[$source]['access_token'];
        }
                
        function get_user_dir(){            
            $dir = UPLOAD_PATH . session_id() .'/';            
            @mkdir($dir);                        
            return $dir ;
        }
                        
        
        function get_user_url(){            
            return UPLOAD_URL . session_id() . '/';
        }
        
        
        
        function logUploadFiles($data){
            
        }
	
	function entries()
	{
		if (($entry_id = $this->EE->TMPL->fetch_param('entry_id')) === FALSE) return;
		$limit	= ( ! isset($params['limit']) OR ! is_numeric($params['limit'])) ? 100 : $params['limit'];

		$this->EE->db->select('*');
		$this->EE->db->where('entry_id', $entry_id); 
		$this->EE->db->from('upload_files');
		$this->EE->db->join('upload_posts', 'upload_files.file_id = upload_posts.file_id', 'right');

		$query = $this->EE->db->get();


		if ($query->num_rows() == 0)
		{
			return $this->EE->TMPL->no_results();
		}

		//  Instantiate Typography class
		$this->EE->load->library('typography');
		$this->EE->typography->initialize(array(
				'parse_images'		=> TRUE,
				'allow_headings'	=> FALSE)
				);
		
		$edit_date			= array();

		// We do this here to avoid processing cycles in the foreach loop

		$date_vars = array('edit_date');
		
		$base_url = $this->EE->functions->fetch_site_index(0, 0).QUERY_MARKER.'ACT='.$this->EE->functions->fetch_action_id('Upload', 'force_upload');

		foreach ($query->result_array() as $id => $row)
		{
			$variables[] = array(
				'file_title' => $row['file_title'],
				'file_link' => '{filedir_'.$row['dir_id'].'}',
				'file_upload' => $base_url.AMP.'id='.$row['file_id']
				);					
			
		}

		$output = $this->EE->TMPL->parse_variables($this->EE->TMPL->tagdata, $variables); 
		
		return $output;
	}
	
	function files(){
            return $this->list_files();
	}
	
	function force_upload()
	{
		$file_id = $this->EE->input->get('id');
		$this->EE->lang->loadfile('upload');

		
		if ($file_id === FALSE)
		{
			return $this->EE->output->show_user_error('general', $this->EE->lang->line('invalid_upload'));
		}
		
		$group_id = $this->EE->session->userdata['group_id'];
		
		$this->EE->load->helper('upload');
		
		$this->EE->db->select('file_name, file_title, member_access, server_path, url');
		$this->EE->db->from('upload_files');
		$this->EE->db->join('upload_prefs', 'upload_prefs.id = upload_files.dir_id');
		$this->EE->db->where('file_id', $file_id); 

		$query = $this->EE->db->get();
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			
			$allowed = explode('|', $row->member_access);
			
			if ( ! in_array('all', $allowed) && ! in_array($group_id, $allowed))
			{
				return $this->EE->output->show_user_error('general', $this->EE->lang->line('no_permission'));
			}
			
			$file_name = $row->file_name;
			$file_path = $row->server_path.$file_name;
	
			$data = file_get_contents($file_path); // Read the file's contents

			force_upload($file_name, $data); 
		} 

	}
        
        function uploads(){            
            switch ($_SERVER['REQUEST_METHOD'] ){
                case 'POST' :                    
                    $this->save();
                    break;
                case 'DELETE'  :
                    $this->delete();
                    break;
                case 'PUT'  :
                    $this->save();
                    break;
                default :    
                    return $this->list_files();                    
            }
            
        }
        function get(){}
        
        function list_files(){            
            $source = ee()->input->get('source')  ? ee()->input->get('source') : 'upload';            
            $images = array();    
            $metas = array();
            $this->_get_upload_data($source);
            switch ($source){
                case 'instagram' : {
                    $req = ee()->input->get('id') ? "tags/$id/media/recent/" : 'users/self/media/recent/';
                    $url = $this->instagram_url($req);
                    $images = $this->instagram_posts($url);
                    break;
                }
                case 'facebook' : {
                    $id = ee()->input->get('id') ? ee()->input->get('id') : 'me';
                    $url = $this->facebook_url("$id?fields=photos{name,place,images,created_time}");                           
                    $images = $this->facebook_posts($url);                            
                    break;
                }                        
                case 'upload' : {
                    $path = $this->get_user_dir();
                    $user_url =  $this->get_user_url();
                    $files = glob($path. '*.{jpg,png,jpeg,gif}',GLOB_BRACE);                                        
                    foreach($files as $im){                        
                        $id = pathinfo($im,PATHINFO_FILENAME);
                        $images[$id] = $user_url . str_replace($path,'',$im);                        
                    }                    
                }
            }                                        
                                
            return $this->list_format($images,$metas);
        }
                
        function list_format($images,$metas=array()){
            $files = array();
            $page = $this->EE->input->get('page') ? $this->EE->input->get('page') : 1;
            $i_per_page = $this->EE->input->get('maxFiles')  ? $this->EE->input->get('maxFiles') : 18 ;
            $path = $this->get_user_dir();
            
            //$images = array_splice($images,(($page-1) * $i_per_page) , $i_per_page, true);    
            $p = 0;
            foreach ($images as $i => $file){
                if ($p  < (($page-1) * $i_per_page)) continue;
                if ($p > $i_per_page * $page) break;
                $fn = basename($file);
                $files[] = array(
                    'id'   => $i,
                    'fn' => $fn,
                    'url'  => $file,
//                    'meta' => @file_get_contents($path . $i . '.meta') ,
                    'meta' => unserialize(@file_get_contents($path . $i . '.meta')) ,
                );
                $p++;
            }            
                        
            
            $this->EE->output->send_ajax_response(array( 'count' => count($images),'page' => $page, 'files'=>$files , 'token' => @$this->access_token ) );
            
        }
        
        function delete(){
            $path = $this->EE->input->get('owner_id') ? $this->EE->input->get('owner_id') : session_id();
            $path = $this->upload_dir . $path . '/' . $this->EE->input->get('file');
            unlink($path);
            //$this->EE->output->send_ajax_response(true);
            $this->EE->functions->redirect('/upload'); 
        }
        
        function save(){
                        
            $files = array();
            foreach($_FILES as $file){
                if ($file['error'][0]) continue;
                $uniq_id = uniqid();
                $working_file = $this->user_dir . $uniq_id;
                move_uploaded_file($file['tmp_name'][0], $working_file);
                //$this->squarize($working_file);
                $files[$uniq_id] = $working_file;                
            }
            
            $canvas = @$_POST['filecanvas'];
            $file = @$_POST['filename'];            
            $id = @$_POST['id'] ?  $_POST['id'] : uniqid();
            $fn = $id . substr($file, strrpos($file,'.') ) ;
            
            $working_file = $this->user_dir .$fn ;            
            file_put_contents($working_file, base64_decode($canvas));                
            //$working_file = $this->squarize($working_file);
            
            $files[$id] = $this->user_url . str_replace($this->user_dir,'',$working_file);
            
            if ( isset($_POST['canvas']) && count(@$_POST['canvas']) ){                                     
                foreach ($_POST['canvas'] as $cvs){
                    if (substr($cvs,0) == '/') continue;
                    $uniq_id = uniqid();
                    $working_file = $this->user_dir . $uniq_id . '.png';
                    file_put_contents($working_file, base64_decode($cvs));
                    //$working_file = $this->squarize($working_file);
                    $files[$uniq_id] = $working_file;
                }
            }            
            $ret = $this->list_format($files); 
//            error_log(print_r($ret,1));
            return $ret;
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
            
            $path_parts  = pathinfo($file) ;
            unlink($file);
            
            //$file = $path_parts['dirname'] . '/' .  round(microtime(true) * 1000)  . '.'. $path_parts['extension'];
            
            //$file = $file . '_' ;
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
            }
                        
            imagedestroy($img);
            imagedestroy($dest);
            return $file;
        }
        
        function resize($files,$size){
           
           if (!$files){
               $files = array(FC . $_POST['file']);
           }
           
           if (isset($_POST['crop'])){
               $size = $_POST['crop'];
           }else{
               $size['x'] = 0;
               $size['y'] = 0;
           }
           
           foreach($files as $file_path) {                      
                $im = new Imagick($file_path);
                if ($size['width'] < 100){
                    $im->resizeimage($size['width'], $size['height'], imagick::FILTER_HERMITE ,0.8 , 1);
                }else{
                    $im->cropimage($size['width'], $size['height'], $size['x'], $size['y']);
                }
                
                 
                if ($size['width'] == 80) {
                     $file_path = dirname($file_path) .'/thumb/' . basename($file_path);               
                 }           
                 $im->writeImage($file_path);
                 $im->destroy();
           }
        }
                
        function get_file(){            
            require('UploadHandler.php');            
            $handler = new UploadHandler();
            echo $handler->get_response();
        }
        
        function select(){           
            $input =  $this->EE->input;
            
            
        }
        
        function fetch(){            
            $urls = ee()->input->post('url');
            $ids = ee()->input->post('ids');
            $source = ee()->input->post('source');
            $path = $this->get_user_dir();
            $next = ee()->input->post('next_url');                        
            $count = $count = ee()->input->post('count'); 
            if (empty($urls))ee()->functions->redirect($next);
            
            $files = array();            
            $metas = array();            
            $user_url =  $this->get_user_url();
            
            
            foreach ($urls as $id => $url){                                
                $ext = pathinfo (parse_url($url,PHP_URL_PATH),PATHINFO_EXTENSION );
                $file = $path . $id . '.' . $ext ;                 
//                error_log(__FILE__ . __LINE__ . PHP_EOL . $file);

                file_put_contents($file, fopen($url,'r'));                
                $files[$id]= $user_url . str_replace($path,'',$file);            
                 if ($source == 'instagram'){
                    $meta = $this->get_instagram_meta($id,$file);
                }
                if ($source == 'facebook'){
                    //$file = $this->squarize($file);
                    $meta = $this->get_facebook_meta($id,$file);
                    
                }                
                $metas[$id] = $meta;
            }                        
                                                
            if (AJAX_REQUEST){
                return $this->list_format($files,$metas);
            }
            ee()->functions->redirect($next);

        }

        function get_instagram_meta($media_id,$file){
            $token = ee()->input->post('token');
            $url = 'https://api.instagram.com/v1/media/'.$media_id.'?access_token=' .$token ;
            $meta_json = file_get_contents($url);
            $meta = json_decode($meta_json);
            $meta = @$meta->data;
            $mt['created_time'] = date ('d F Y', (int)@$meta->created_time);
            $mt['id'] = @$meta->id;
//            $mt['name'] = mb_convert_encoding(@$meta->caption->text,'UTF-8');
//            $mt['from'] = mb_convert_encoding(@$meta->user->full_name,'UTF-8');
//            $mt['location'] = mb_convert_encoding(@$meta->location->name,'UTF-8');                        
            $mt['name'] = @$meta->caption->text;
            $mt['from'] = @$meta->user->full_name;
            $mt['location'] = @$meta->location->name;
            $file  = substr($file,0,strrpos($file,'.'))  . '.meta';            
            file_put_contents($file , serialize($mt));
//            file_put_contents($file , json_encode($mt));
            return $mt;
        }

        function get_facebook_meta($media_id,$file){ 
            $token = ee()->input->post('token');
            $url = 'https://graph.facebook.com/v2.5/'.$media_id.'?fields=from,created_time,name,place&access_token=' .$token ;

            $meta_json = file_get_contents($url);   
            $meta = json_decode($meta_json);

            $mt['created_time'] = date ('d F Y', strtotime(@$meta->created_time));
            $mt['id'] = @$meta->id;
//            $mt['name'] = mb_convert_encoding(@$meta->name,'UTF-8');
//            $mt['from'] = mb_convert_encoding(@$meta->from->name,'UTF-8');
//            $mt['location'] = mb_convert_encoding(@$meta->location->name,'UTF-8');
            $mt['name'] = @$meta->name;
            $mt['from'] = @$meta->from->name;
            $mt['location'] = @$meta->location->name;
            $file  = substr($file,0,strrpos($file,'.'))  . '.meta';
//            file_put_contents($file , json_encode($mt));
            file_put_contents($file , serialize($mt));
            return $mt;            
        }
                
        function instagram_upload(){
            echo __FILE__;
            echo __FUNCTION__;
        }
        
        function twitter_upload(){
            echo __FILE__;
            echo __FUNCTION__;
        }
        
        function housekeeping(){
            $c = 0;
                        
            $dirs = @array_map('basename',glob($this->upload_dir . '*', GLOB_ONLYDIR));                       
            $query = ee()->db->select('owner_id')->distinct('owner_id')->from('photoprints')->group_by('owner_id');            
            $item_owners = @array_map(function($r){return $r['owner_id'];},$query->get()->result_array());            
            foreach(array_diff($dirs,$item_owners)  as $i => $dirname) {
                $dir = $this->upload_dir . $dirname;                
                $stat = @fileatime ($dir) ;                
                if ($stat + 60*60* FILE_KEEP_HOURS < time()){
                    //error_log('removing dir: ' .$i .'/' . $dirname .  $dir);
                    @rrmdir($dir);
                    $c ++ ;
                }                    
            }                 
            echo $c;                        
        }
        
        function clear($owner_id){
            if (!$owner_id) $owner_id = session_id ();
            $dir = $this->upload_dir  .  $owner_id;
            @rrmdir($dir);
        }
        
        private function instagram_url($segment, $get = NULL){
                $get = isset($get) ? $get : array();
                if(!isset($get['next_max_id'])) $get['max_id'] = @$_SESSION['next_max_id'];
                $get['access_token'] = $this->access_token;
                $base = "https://api.instagram.com/v1/".$segment;
                return $base."?".http_build_query($get);
        }
        private function facebook_url($segment, $get = NULL){
                $get = isset($get) ? $get : array();
                if (!isset($get['next_id'])) $get['after']  =  @$_SESSION['next_id'];
                //if (isset($_GET['next_id'])) $get['after'] = $_GET['next_id'];
                $get['access_token'] = $this->access_token;
                $base = "https://graph.facebook.com/v2.5/".$segment;
                return $base."&".http_build_query($get);
        }
        
        private function facebook_posts($url){
                $arr = array();                        
                $data = json_decode(@file_get_contents($url));

                if (! $data ) return $arr;
                $count = 0;
                foreach($data->photos->data as $item){                                                    
                    $arr[$item->id] = $item->images[0]->source;                        
                }
                $_SESSION['next_id'] =  @$data->photos->paging->cursors->after;
                $_SESSION['prev_id'] =  @$data->photos->paging->cursors->before;                
                $this->next_page = @$data->paging->cursors->after;

                return $arr;
        }        
        private function instagram_posts($url){
                $arr = array();
                //error_log($url);
                $data = json_decode(@file_get_contents($url));
                if (! $data ) return $arr;                
                $count = 0;
                foreach($data->data as $item){                        
                        if ($item->type != 'image') continue;
                        $arr[$item->id] = $item->images->standard_resolution->url;                        
                }                        
                //error_log('pagination : ' . print_r($data->pagination,1));
                $_SESSION['next_max_id'] = @$data->pagination->next_max_id;
                $this->next_page = @$data->pagination->next_max_id;

                return $arr;
        }
                
}

