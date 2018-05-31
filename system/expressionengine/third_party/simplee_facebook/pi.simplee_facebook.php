<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$plugin_info = array(
		'pi_name' 		=> 'SimplEE Facebook',
		'pi_version' 		=> '1.0.4',
		'pi_author' 		=> 'Brandon OHara',
		'pi_author_url' 	=> 'http://brandonohara.com/',
		'pi_description' 	=> 'Pull Facebook feeds by user and hashtag.',
	    'pi_usage'        	=> Simplee_facebook::usage()
	);
	
	require_once(PATH_THIRD."simplee_facebook/config.php");

	class Simplee_facebook{
		public $get = array();
		public $client_id = null;
		
		public $plugin_name = "SimplEE Facebook";
    
		public function __construct(){                    
//                    $site_id = ee()->config->item('site_id');                    
//                    $query = ee()->db->query("SELECT settings FROM exp_modules WHERE module_name='Social_login' LIMIT 1");
//                    $settings = unserialize($query->row('settings')); 
//                    $this->client_id        = $settings[$site_id]['facebook']['app_id'];                    
//                    $this->client_secret    = $settings[$site_id]['facebook']['app_secret'];
                                        
                    @session_start(array('cookie_path' => '/'));
                    if (strpos(@$_SERVER['HTTP_REFERER'],'/facebook/')===false) unset($_SESSION['next_id']);
                    $this->_get_social_data();
                    
//                    if ( ! $this->client_id){
//                        $this->client_id = (ee()->TMPL->fetch_param('client_id') != "" ? ee()->TMPL->fetch_param('client_id') : FACEBOOK_DEVELOPER_ID);		
//                        if($this->client_id == "")
//        			ee()->output->show_user_error('general', $this->plugin_name.": Must enter Instagram client id in system/third_party/simplee_facebook/onfig.php");                        
//                    }
		}
                
                function _get_social_data($session_id=null){
                    if (! $session_id) $session_id = session_id();
                    
                    ee()->db->select('data');
                    ee()->db->where('session_id', $session_id);
                    $query = ee()->db->get('social_login_session_data');
                    $data = array();
                    if ($query->num_rows()>0){
                            $row = current($query->result_array());                           
                            $data = unserialize($row['data']);
                            $data['session_id'] = $session_id;
                    }                                        
                    $this->username =  @$data['facebook']['username'];
                    $this->user_id  =  @$data['facebook']['custom_field'];
                    $this->access_token =  @$data['facebook']['access_token'];
                }
                
                function token(){
                    return $this->access_token;
                }
		
		function comments(){
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID to recieve comments");
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			
			$this->get['count'] = $limit;
			$url = $this->facebook_url("media/".$id."/comments");
			
			$comments = $this->get_posts($url, !$reverse, "Instagram_Comment");
			
			if (count($comments) == 0)
		        return ee()->TMPL->no_results();
		        
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $comments);
		}

                function user(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$user_id = $this->get_user_id();
			$url = $this->facebook_url("$user_id/photos",array('fields'=>'id,name,source','limit'=>$limit));
			$posts = $this->get_posts($url, $reverse,'','Facebook_User');
			if (count($posts) == 0)
                            return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
		}
    

		function album(){
                        if (!$this->access_token){                            
                            return '{embed=assets/facebook_login}';
                        }                        
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 18);
			$this->get['limit'] = $limit;
#                        $this->get['fields'] = 'name,source';
			$url = $this->facebook_url("me/albums?fields=created_time,count,link,name,description,cover_photo{images}");
                        if (ee()->input->get('next_id')) {
                            $url = $url . '&after=' . ee()->input->get('next_id')  . '&limit=' . ($limit+1);
                        }
                        
			$posts = $this->get_posts($url, $reverse,'Facebook_Album');                        
                        
			if (count($posts) == 0)
		        return ee()->TMPL->no_results();
                        unset($_SESSION['next_id']);
                        
                        
			$ret = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
                        if (!$this->next_id) {
                            $ret .= '<style>.more-btn{display:none !important;}</style>';
                        }
                        $ret .= '<script>$(function (){$("input[name=next_id]").val("'.$this->next_id.'");'
                                . ' $("li.tmpl :checkbox").map(function(i,e){ $(e).attr("name",$(e).attr("name").replace(".","_"));  });' 
                                . '});</script>';                        
                        if (AJAX_REQUEST) die($ret);
                        return $ret ;
		}
		

                function photos(){
                        if (!$this->access_token){                            
                            return '{embed=assets/facebook_login}';
                        }
                        
			$album_name = (ee()->TMPL->fetch_param("name") != "" ? ee()->TMPL->fetch_param("name") : NULL);
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
                        $id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
                        
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Album ID");
			
                        
			$url = $this->facebook_url("$id/photos/?fields=name,place,images,created_time");
                        if (ee()->input->get('next_id')) {
                            $url = $url . '&after=' . ee()->input->get('next_id')  . '&limit=' . ($limit+1);
                        }else {
                            $url = $url .  '&limit=' . ($limit);
                        }
                        $posts = $this->get_posts($url, $reverse);
			
			if (count($posts) == 0)
		        return ee()->TMPL->no_results();
			
			$ret = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);  
                        if (!$this->next_id) {
                            $ret .= '<style>.more-btn{display:none !important;}</style>';
                        }
                        $ret .='<input type="hidden" name="token" value="'.$this->access_token.'"/>';
                        $ret .= '<script>$(function (){$("input[name=next_id]").val("'.$this->next_id.'");'
                                . ' $("li.tmpl :checkbox").map(function(i,e){ $(e).attr("name",$(e).attr("name").replace(".","_"));  });'
                                . '});</script>';
                        if (AJAX_REQUEST) die($ret);
                        return $ret ;
		}
		
		function post(){
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID");
			
			$url = $this->facebook_url("media/".$id);

			$data = json_decode(file_get_contents($url));
			$post = new Instagram_Post($data->data);
			
			return ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $post->get_array());
		}
		
		function user_info($id = null){
		        $user = $this->get_user_info($id);
			return ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $user->get_array());
		}
		
		private function facebook_url($segment, $get = NULL){
			$get = isset($get) ? $get : $this->get;
                        //if (isset($_SESSION['next_id'])) $get['after']  =  $_SESSION['next_id'];
                        //if (isset($_GET['next_id'])) $get['after'] = $_GET['next_id'];
			$get['access_token'] = $this->access_token;
            //error_log(print_r($get,1));
			$base = "https://graph.facebook.com/v2.5/".$segment;
			return $base."&".http_build_query($get);
		}
                
                
                private function get_user_info($id){
			if (!$id) $id = $this->get_user_id();
			$url = $this->facebook_url($id,array('fields','albums'));
			
			$data = json_decode(file_get_contents($url));
			$user = new Facebook_User($data->data);
                        return $user;
                }
		
		private function get_user_id(){
			$username = (ee()->TMPL->fetch_param("username") != "" ? ee()->TMPL->fetch_param("username") : $this->username);
			$user_id = (ee()->TMPL->fetch_param("user_id") != "" ? ee()->TMPL->fetch_param("user_id") : $this->user_id ) ;
			                       
			if($user_id && intval($user_id) > 0){
                return $user_id;
            }else if($username){				
				$get = array();
				$get['q'] = $username;
				$get['count'] = 1;
				$get['type'] = 'user';
				$url = $this->facebook_url("search", $get);
                                
				$data = json_decode(file_get_contents($url));
				if(count($data->data) == 0)
					return ee()->output->show_user_error('general', $this->plugin_name.": Could not find a user with username: ".$username);
					
				foreach($data->data as $user){
                                        $this->username = $user->name;
                                        $this->user_id = $user->id;
					return $user->id;
				}
			} else{
                return ee()->output->show_user_error('general', $this->plugin_name.": Must Specify User ID or Username.");
            }
				
		}
		
		private function get_posts($url, $reverse = FALSE, $classname = "Facebook_Photo"){
			$arr = array();                       
			$data = json_decode(@file_get_contents($url));
            //error_log('POST: ' . $url . "\n". print_r($data,1));

            if (! $data ) return $arr;
			$count = 0;
			foreach($data->data as $item){        
				$item = new $classname($item);
                $item->file =  $item->id  .'.'.pathinfo(strtok(basename($item->image),'?'), PATHINFO_EXTENSION);   
                $item->metadata = json_encode((object)array('location' => 'facebook',
                                                            'created_time'=>$item->created_time,
                                                            'name' => $item->description, 
                                                            'from' => $this->username )); 
				array_push($arr, $item->get_array());
			}                        
            
            $this->next_id = @$data->paging->next ?  @$data->paging->cursors->after : '';                        
			if($reverse) $arr = array_reverse($arr);			
			return $arr;
		}
                                
    
	    public static function usage(){
	        return "View Documentation: http://brandonohara.com/plugins/simplee-instagram/overview";
	    }
	}

/* End of file pi.simplee_instagram.php */
/* Location: ./system/expressionengine/third_party/simplee_instagram/pi.simplee_instagram.php */