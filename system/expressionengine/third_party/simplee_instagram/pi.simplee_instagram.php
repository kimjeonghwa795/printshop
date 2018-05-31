<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$plugin_info = array(
		'pi_name'               => 'SimplEE Instagram',
		'pi_version' 		=> '1.0.4',
		'pi_author' 		=> 'Brandon OHara',
		'pi_author_url' 	=> 'http://brandonohara.com/',
		'pi_description' 	=> 'Pull Instagram feeds by user and hashtag.',
                'pi_usage'        	=> Simplee_instagram::usage()
	);
	
	require_once(PATH_THIRD."simplee_instagram/config.php");

	class Simplee_instagram {
		public $get = array();
		public $client_id = null;
		
		public $plugin_name = "SimplEE Instagram";
    
		public function __construct(){                    
                    $site_id = ee()->config->item('site_id');                    
                    $query = ee()->db->query("SELECT settings FROM exp_modules WHERE module_name='Social_login' LIMIT 1");
                    $settings = unserialize($query->row('settings')); 
                    $this->client_id        = $settings[$site_id]['instagram']['app_id'];                    
                    $this->client_secret    = $settings[$site_id]['instagram']['app_secret'];
                                        
                    $this->tmpl = ee()->TMPL->tagdata;
                    
                    if ( ! $this->client_id){
                        $this->client_id = (ee()->TMPL->fetch_param('client_id') != "" ? ee()->TMPL->fetch_param('client_id') : INSTAGRAM_DEVELOPER_ID);		
                        if($this->client_id == "")
                        ee()->output->show_user_error('general', $this->plugin_name.": Must enter Instagram client id in system/third_party/simplee_instagram/config.php");
                        
                    }
                    
                    $this->_get_social_data();
		}
                
                function _get_social_data($session_id=null){
                    @session_start();                    
                    if (! $session_id) $session_id = session_id();
                    
                    ee()->db->select('data');
                    ee()->db->where('session_id', $session_id);
                    $query = ee()->db->get('social_login_session_data');
                    $data = array();
                    if ($query->num_rows()>0){
                            $row = current($query->result_array());
                            $data = unserialize(@$row['data']);                            
                            $data['session_id'] = $session_id;
                    }
                    
                    $this->username =  @$data['instagram']['username'];
                    $this->user_id  =  @$data['instagram']['alt_custom_field'];
                    $this->access_token =  @$data['instagram']['access_token'];                    
                }
                
                function token(){
                    return @$this->access_token;
                }
                
                function check_token(){
                    if (!@$this->access_token ){
                        return 'NO TOKEN';
                    }
                                        
                }
		
		function comments(){
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID to recieve comments");
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("media/".$id."/comments");
			
			$comments = $this->get_posts($url, !$reverse, "Instagram_Comment");
			
			if (count($comments) == 0)
		        return ee()->TMPL->no_results();
		        
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $comments);
		}
                

		function hash(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$hash = (ee()->TMPL->fetch_param("hash") != "" ? ee()->TMPL->fetch_param("hash") : NULL);
			if(!$hash)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Hash");
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("tags/".$hash."/media/recent");
			$posts = $this->get_posts($url, $reverse);
                        
			if (count($posts) == 0)
                            return ee()->TMPL->no_results();
						
                        $ret = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
                        if (AJAX_REQUEST) die($ret);
                        return $ret ;
		}
		
		function likes(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID");
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("media/".$id."/likes");
			$users = $this->get_posts($url, $reverse, "Instagram_User");
			
			if (count($users) == 0)
		        return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $users);
		}
		
		function location(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$location = (intval(ee()->TMPL->fetch_param("id")) > 0 ? intval(ee()->TMPL->fetch_param("id")) : NULL);
			if(!$location)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Location ID, not the name of the location.");
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("locations/".$location."/media/recent");
			$posts = $this->get_posts($url, $reverse);
			
			if (count($posts) == 0)
                            return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
		}
		
		function post(){
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID");
			
			$url = $this->instagram_url("media/".$id);
			$data = json_decode(file_get_contents($url));
			$post = new Instagram_Post($data->data);
			
			return ee()->TMPL->parse_variables_row($this->tmpl, $post->get_array());
		}
		
		function user(){                        
            if (!$this->access_token){
                return '{embed=assets/instagram_login}';
            }
                    
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$user = $this->get_user_id();			
			$this->get['count'] = $limit;
            $this->get['max_id'] = ee()->input->get('max_id');
			$url = $this->instagram_url("users/".$user."/media/recent/");
			$posts = $this->get_posts($url, $reverse);                        
			if (count($posts) == 0)
		        return ee()->TMPL->no_results();
			
			$ret = ee()->TMPL->parse_variables($this->tmpl, $posts);
            if (!$this->max_id) {
                $ret .= '<style>.more-btn{display:none !important;}</style>';
            }
            $ret .='<input type="hidden" name="token" value="'.$this->access_token.'"/>';
            $ret .= '<script>$(function (){$("input[name=max_id]").val("'.$this->max_id.'");'
                    . ' $("li.tmpl :checkbox").map(function(i,e){ $(e).attr("name",$(e).attr("name").replace(".","_"));  });'
                    . '});</script>';
            
            if (AJAX_REQUEST) die($ret);
            return $ret ;
                        
		}
		
		function user_info(){
			$id = $this->get_user_id();
			$url = $this->instagram_url("users/".$id);
			
			$data = json_decode(file_get_contents($url));
			$user = new Instagram_User($data->data);
		        
			return ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $user->get_array());
		}
		
		private function instagram_url($segment, $get = NULL){
			$get = isset($get) ? $get : $this->get;                        
			$get['access_token'] = $this->access_token;
//            error_log(print_r($get,1));
			$base = "https://api.instagram.com/v1/".$segment;
			return $base."?".http_build_query($get);
		}
		
		private function get_user_id(){
			$username = (ee()->TMPL->fetch_param("username") != "" ? ee()->TMPL->fetch_param("username") : $this->username);
			$user_id = (ee()->TMPL->fetch_param("user_id") != "" ? ee()->TMPL->fetch_param("user_id") : $this->user_id ) ;
			                       
			if($user_id && intval($user_id) > 0)
				return $user_id;
			else if($username){				
				$get = array();
				$get['q'] = $username;
				$get['count'] = 1;
				$url = $this->instagram_url("users/search", $get);
                                
				$data = json_decode(file_get_contents($url));
				if(count($data->data) == 0)
					//return ee()->output->show_user_error('general', $this->plugin_name.": Could not find a user with username: ".$username);
					
				foreach($data->data as $user){
					return $user->id;
				}
                        } else{
                            //return ee()->output->show_user_error('general', $this->plugin_name.": Must Specify User ID or Username.");
                        }
				
		}
		
		private function get_posts($url, $reverse = FALSE, $classname = "Instagram_Post"){
			$arr = array();
                        //error_log($url);
			$data = json_decode(@file_get_contents($url));
            if (! $data ) return $arr;
			$count = 0;
			foreach($data->data as $item){
                if ($item->type != 'image') continue;
				$item = new $classname($item);
				$item->count = ++$count;
                $item->uid   = uniqid();
                $item->file =  $item->id  .'.'.pathinfo(strtok(basename($item->image),'?'), PATHINFO_EXTENSION);
                $item->metadata = json_encode((object)array('location' => $item->location,'created_time'=>date('d M Y',$item->date),'name' => $item->caption, 'from' => $item->user->username )); 
				array_push($arr, $item->get_array());                                
                //$item->save( $item->id . '.meta');
			}                        
            //error_log('pagination : ' . print_r($data->pagination,1));
            //error_log(print_r($arr,1));
            $_SESSION['next_max_id'] = @$data->pagination->next_max_id;
            $this->max_id = @$data->pagination->next_max_id;
			if($reverse)
				$arr = array_reverse($arr);
			
			return $arr;
		}
                                
    
	    public static function usage(){
	        return "View Documentation: http://brandonohara.com/plugins/simplee-instagram/overview";
	    }
	}

/* End of file pi.simplee_instagram.php */
/* Location: ./system/expressionengine/third_party/simplee_instagram/pi.simplee_instagram.php */