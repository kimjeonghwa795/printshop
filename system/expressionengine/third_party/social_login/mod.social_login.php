<?php
if ( ! defined('BASEPATH')){ exit('Invalid file request');}

require_once PATH_THIRD.'social_login/config.php';

class Social_login {

    var $return_data	= ''; 						// Bah!
    
    var $settings = array();
    
    var $social_login = array();

    /** ----------------------------------------
    /**  Constructor
    /** ----------------------------------------*/

    function __construct(){        
    	$this->EE =& get_instance(); 
        $this->EE->lang->loadfile('login');
        $this->EE->lang->loadfile('member');
        $this->EE->lang->loadfile('social_login');
        $query = $this->EE->db->query("SELECT settings FROM exp_modules WHERE module_name='Social_login' LIMIT 1");
        $this->settings = unserialize($query->row('settings'));
        
    }
    
    function form(){      
        if ($this->EE->session->userdata['member_id']!=0){
            //return;
        }
                             
        $site_id = $this->EE->session->userdata('site_id');
        $data['hidden_fields']['ACT'] = $this->EE->functions->fetch_action_id('Social_login', 'request_token');            
		$data['id']		= ($this->EE->TMPL->fetch_param('id')!='') ? $this->EE->TMPL->fetch_param('id') : 'social_login_form';
        $data['name']		= ($this->EE->TMPL->fetch_param('name')!='') ? $this->EE->TMPL->fetch_param('name') : 'social_login_form';
        $data['class']		= ($this->EE->TMPL->fetch_param('class')!='') ? $this->EE->TMPL->fetch_param('class') : 'social_login_form';

        if ($this->EE->TMPL->fetch_param('return')=='')
        {
            $return = $this->EE->functions->fetch_site_index();
        }
        else if ($this->EE->TMPL->fetch_param('return')=='SAME_PAGE')
        {
            $return = $this->EE->functions->fetch_current_uri();
        }
        else if (strpos($this->EE->TMPL->fetch_param('return'), "http://")!==FALSE || strpos($this->EE->TMPL->fetch_param('return'), "https://")!==FALSE)
        {
            $return = $this->EE->TMPL->fetch_param('return');
        }
        else
        {
            $return = $this->EE->functions->create_url($this->EE->TMPL->fetch_param('return'));
        }

        $data['hidden_fields']['RET'] = $return;
        
        if ($this->EE->TMPL->fetch_param('no_email_return')=='')
        {
            $data['hidden_fields']['no_email_return'] = $return;
        }
        else if ($this->EE->TMPL->fetch_param('no_email_return')=='SAME_PAGE')
        {
            $data['hidden_fields']['no_email_return'] = $this->EE->functions->fetch_current_uri();
        }
        else if (strpos($this->EE->TMPL->fetch_param('no_email_return'), "http://")!==FALSE || strpos($this->EE->TMPL->fetch_param('no_email_return'), "https://")!==FALSE)
        {
            $data['hidden_fields']['no_email_return'] = $this->EE->TMPL->fetch_param('no_email_return');
        }
        else
        {
            $data['hidden_fields']['no_email_return'] = $this->EE->functions->create_url($this->EE->TMPL->fetch_param('no_email_return'));
        }
        
        if ($this->EE->TMPL->fetch_param('secure_action')=='yes')
        {
            $data['hidden_fields']['secure_action'] = 'yes';
        } 
        
        $providers_list = ($this->EE->TMPL->fetch_param('providers')!='') ? explode('|', $this->EE->TMPL->fetch_param('providers')) : array();
        
        $tagdata = $this->EE->TMPL->tagdata;
        
        if (preg_match_all("/".LD."providers.*?(backspace=[\"|'](\d+?)[\"|'])?".RD."(.*?)".LD."\/providers".RD."/s", $tagdata, $matches))
		{
            $providers = array();
        
            foreach(scandir(PATH_THIRD.'social_login/libraries/') as $file) {
                if (is_file(PATH_THIRD.'social_login/libraries/'.$file)) 
                {
                    $provider = str_replace('_oauth.php', '', $file); 
                    if (empty($providers_list) || in_array($provider, $providers_list))
                    {
                        $providers[] = $provider;
                    }
                }
            }

            $out = '';
            $chunk = $matches[3][0];
            
            if ($this->EE->config->item('url_third_themes')!='')
            {
                $theme_folder_url = $this->EE->config->slash_item('url_third_themes').'social_login/';
            }
            else
            {
                $theme_folder_url = $this->EE->config->slash_item('theme_folder_url').'third_party/social_login/';
            }

            foreach ($providers as $provider)
            {
                if ($this->settings[$site_id]["$provider"]['app_id']!='' && $this->settings[$site_id]["$provider"]['app_secret']!='' && $this->settings[$site_id]["$provider"]['custom_field']!='')
                {
                    $parsed_chunk = $chunk;
                    $parsed_chunk = $this->EE->TMPL->swap_var_single('provider_name', $provider, $parsed_chunk);
                    $parsed_chunk = $this->EE->TMPL->swap_var_single('provider_title', lang($provider), $parsed_chunk);
                    $parsed_chunk = $this->EE->TMPL->swap_var_single('provider_icon', $theme_folder_url.$this->settings[$site_id]['icon_set'].'/'.$provider.'.png', $parsed_chunk);
                    $out .= $parsed_chunk;
                }
            }
            $tagdata = str_replace($matches[0][0], $out, $tagdata);
            
            if ($matches[2][0]!='')
			{
				$tagdata = substr( trim($tagdata), 0, -$matches[2][0]);
			}
		}       
        
        if ($this->EE->TMPL->fetch_param('popup')=='yes')
        {
            $tagdata .= "<script type=\"text/javascript\">
var myForm = document.getElementById('".$data['id']."');
myForm.onsubmit = function() {
    var w = window.open('about:blank','SocialLoginPopup','toolbar=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');
    this.target = 'SocialLoginPopup';
};
</script>
            ";    
            $data['hidden_fields']['popup'] = 'y';
        }                    

        return $this->EE->functions->form_declaration($data).$tagdata."\n"."</form>";
	}
    
    
    function request_token($provider=''){
        
        $session_id = session_id();	
        $is_popup = ($this->EE->input->get_post('popup')=='y')?true:false;
        
        $site_id = $this->EE->session->userdata('site_id');
        
        if ($provider==''){
            $provider = $this->EE->input->get_post('provider');
        }
        
        if ($provider==''){
            $this->_show_error('general', lang('no_service_provider'), $is_popup);
            return;
        }
        
        if (!file_exists(PATH_THIRD.'social_login/libraries/'.$provider.'_oauth.php')){
            $this->_show_error('general', lang('provider_file_missing'), $is_popup);
            return;
        }

        //if one of the settings is empty, we can't proceed
        if ($this->settings[$site_id]["$provider"]['app_id']=='' || $this->settings[$site_id]["$provider"]['app_secret']=='' || $this->settings[$site_id]["$provider"]['custom_field']==''){
            $this->_show_error('general', lang('please_provide_settings_for').' '.$providers["$provider"]['name'], $is_popup);
            return;
        }
        
        $this->social_login['provider'] = $provider;
        $this->social_login['auto_login'] = $this->EE->input->get_post('auto_login');
        $this->social_login['return'] = ($this->EE->input->get_post('RET')!='')?$this->EE->input->get_post('RET'):$this->EE->functions->fetch_site_index();
        $this->social_login['no_email_return'] = ($this->EE->input->get_post('no_email_return')!='')?$this->EE->input->get_post('no_email_return'):$this->social_login['return'];
		$this->social_login['anon'] = $this->EE->input->get_post('anon');
        $this->social_login['group_id'] = $this->EE->input->get_post('group_id');
        $this->social_login['is_popup'] = $is_popup;
        $this->social_login['secure_action'] = $this->EE->input->get_post('secure_action');
        
        $this->_save_session_data(  array($provider=>$this->social_login) , $session_id);        
        
        $act = $this->EE->db->query("SELECT action_id FROM exp_actions WHERE class='Social_login' AND method='access_token'");
        $access_token_url = trim($this->EE->config->item('site_url'), '/').'/?ACT='.$act->row('action_id');
        if (!in_array($provider, array('google', 'linkedin', 'yahoo'))){
            $access_token_url .= '&sid='.$session_id;
        }
        
        if ($this->EE->input->get_post('secure_action')=='yes') {
            if (strpos($access_token_url, '//')===0){
                $access_token_url = 'https:'.$access_token_url;
            } else{
                $access_token_url = str_replace('http://', 'https://', $access_token_url);
            }
        }
                
        if ($provider=='facebook'){
            require_once PATH_THIRD.'social_login/facebook-sdk/facebook.php';
            
            $fb_config = array();
            $fb_config['appId'] = $this->settings[$site_id]["$provider"]['app_id'];
            $fb_config['secret'] = $this->settings[$site_id]["$provider"]['app_secret'];
            
            $facebook = new Facebook($fb_config);
            
            $params = array(
              'scope' => 'public_profile,email,user_about_me,user_status,user_photos',
              'redirect_uri' => $access_token_url
            );
            
            $loginUrl = $facebook->getLoginUrl($params);
            //error_log($loginUrl);
            header("Location: $loginUrl");
            exit();
            
        }
        
        $params = array('key'=>$this->settings[$site_id]["$provider"]['app_id'], 'secret'=>$this->settings[$site_id]["$provider"]['app_secret']);

        $lib = $provider.'_oauth';
        $this->EE->load->library($lib, $params);
        
        
        $response = $this->EE->$lib->get_request_token($access_token_url, $session_id);
        
        $this->social_login['token_secret'] = $response['token_secret'];
        
        $this->_save_session_data(array($provider=>$this->social_login) , $session_id);

        return $this->EE->functions->redirect($response['redirect']);
    }
        
    function access_token(){
        
        if ($this->EE->input->get('sid')!=''){
            $session_id = $this->EE->input->get('sid');
        }else{
            $session_id = $this->EE->input->get('state');
        }
        
        if ($session_id=='') $session_id = $this->EE->input->get('state');
	
        $this->social_login = $this->_get_session_data($session_id);        
        $provider = key($this->social_login);
        $this->social_login = current($this->social_login);
       
        $is_popup = @$this->social_login['is_popup'];
        
        $upd_data = array();
        
        if (version_compare(APP_VER, '2.2.0', '<')){
            $temp_password = $upd_data['password'] = $this->EE->functions->hash($this->_random_string());
        }else{
            $temp_password = '';
        }
        
        
//        if ($this->EE->input->get('multi')){
//            //multisite login - go on...
//            return $this->_login_by_id('0', TRUE, $temp_password);
//        }
        
        $this->EE->load->helper('url');
        
        $site_id = $this->EE->config->item('site_id');
        //$provider = $this->social_login['provider'];        
        $lib = $provider.'_oauth';
        $params = array('key'=>$this->settings[$site_id]["$provider"]['app_id'], 'secret'=>$this->settings[$site_id]["$provider"]['app_secret']);
                
        $this->EE->load->library($lib, $params);
		
        if (in_array($provider, array('facebook', 'vkontakte', 'instagram', 'appdotnet', 'windows', 'google', 'linkedin', 'yahoo'))) {
            $act = $this->EE->db->query("SELECT action_id FROM exp_actions WHERE class='Social_login' AND method='access_token'");
            $access_token_url = trim($this->EE->config->item('site_url'), '/').'/?ACT='.$act->row('action_id');
            if (!in_array($provider, array('google', 'linkedin', 'yahoo'))){
                $access_token_url .= '&sid='.$session_id;
            }
            
            if (isset($this->social_login['secure_action']) && $this->social_login['secure_action']=='yes'){
                if (strpos($access_token_url, '//')===0)  {
                    $access_token_url = 'https:'.$access_token_url;
                }else{
                    $access_token_url = str_replace('http://', 'https://', $access_token_url);
                }
            }
            
            $response = $this->EE->$lib->get_access_token($access_token_url, $this->EE->input->get('code'));
        }else{
            $response = $this->EE->$lib->get_access_token(false, $this->social_login['token_secret']);
        }
		
        $return = $this->social_login['return'];            
        if ($response==NULL || $response['oauth_problem']!=''){
            //$this->EE->output->show_user_error('general', array($this->EE->lang->line('oauth_problem').$this->EE->lang->line($provider).'. '.$this->EE->lang->line('try_again')));            
            $this->_clear_session_data($session_id);
            return $this->EE->functions->redirect($return);                    
        }
        
                
        if ($provider == 'instagram'){
            $userdata = $response;            
		}else{
            $userdata = $this->EE->$lib->get_user_data($response);
            ////error_log('=====> user_data:' . $session_id . PHP_EOL . print_r($userdata,1) . '<==============');
        }
        ////error_log('=====> session_id:' . $session_id . PHP_EOL . print_r($this->social_login,1));
        //error_log('=====> userdata 1:' . $session_id . PHP_EOL . print_r($userdata,1));
        
        //$this->_save_session_data(  $this->social_login , $session_id);        
        if ($userdata['custom_field']==''){
            $this->_show_error('general', $this->EE->lang->line('oauth_problem').$this->EE->lang->line($provider).'. '.$this->EE->lang->line('try_again'), $is_popup);
            return;
        }
                
        
        $userdata['access_token'] =  $response['access_token'];        
        $_SESSION['social_login'] = array($provider =>$userdata);        
		$this->_save_session_data( $_SESSION['social_login'] );
        if ( $this->settings[$site_id]['social_auto_login'] == 'n' ||  @$this->social_login['anon'])  {
            $this->EE->functions->redirect($return);
        }
        
        
        
        //check whether member with this social ID exists
        $this->EE->db->select('exp_members.member_id, exp_members.email, exp_members.avatar_filename, exp_members.photo_filename')
                    ->from('exp_members')
                    ->join('exp_member_data', 'exp_members.member_id=exp_member_data.member_id', 'left')
                    ->where('m_field_id_'.$this->settings[$site_id]["$provider"]['custom_field'], $userdata['custom_field']);
        
        if (isset($userdata['alt_custom_field']) && $userdata['alt_custom_field']!='' && $userdata['alt_custom_field']!=$userdata['custom_field']){
        	$this->EE->db->or_where('m_field_id_'.$this->settings[$site_id]["$provider"]['custom_field'], $userdata['alt_custom_field']);
        }
        $this->EE->db->limit(1);
        $query = $this->EE->db->get();
        if ($query->num_rows()>0){
            if ($query->row('email')=='' && $userdata['email']!=''){
            	$upd_data['email'] = $userdata['email'];
            }
            
            if (!empty($upd_data)){
                $this->EE->db->where('member_id', $query->row('member_id'));
                $this->EE->db->update('members', $upd_data);
            }
            
            if ($this->EE->config->item('enable_avatars')=='y' && $query->row('avatar_filename')=='' && $userdata['avatar']!=''){
                $this->_update_avatar($query->row('member_id'), $userdata['avatar']);
            }
            if ($this->EE->config->item('enable_photos')=='y' && $query->row('photo_filename')=='' && $userdata['photo']!=''){
                $this->_update_photo($query->row('member_id'), $userdata['photo']);
            }
            
            // relogin if current member_id != logged in 
             //error_log(__LINE__ . ' : ' .$query->row('member_id') . ':' .$this->EE->session->userdata('member_id') );
            if ($query->row('member_id') != $this->EE->session->userdata('member_id') ){
                return $this->_login_by_id($query->row('member_id'), FALSE, $temp_password);
            }                        
        }
        
        
        //check whether member with this email address exists
        if (@$userdata['email']!=''){            
            $_SESSION['email'] = $userdata['email'];
            $this->EE->db->select('exp_members.member_id, exp_members.avatar_filename, exp_members.photo_filename, m_field_id_'.$this->settings[$site_id]["$provider"]['custom_field'].' AS custom_field')
                        ->from('exp_members')
                        ->join('exp_member_data', 'exp_members.member_id=exp_member_data.member_id', 'left')
                        ->where('email', $userdata['email'])
                        ->limit(1);
            $query = $this->EE->db->get();
            
            if ($query->num_rows()>0)            {                
                if (version_compare(APP_VER, '2.2.0', '<')){
                    $this->EE->db->where('member_id', $query->row('member_id'));
                    $this->EE->db->update('members', $upd_data);
                }
                
                if ($this->EE->config->item('enable_avatars')=='y' && $query->row('avatar_filename')=='' && $userdata['avatar']!=''){
                    $this->_update_avatar($query->row('member_id'), $userdata['avatar']);
                }
                
                if ($this->EE->config->item('enable_photos')=='y' && $query->row('photo_filename')=='' && $userdata['photo']!=''){
	                $this->_update_photo($query->row('member_id'), $userdata['photo']);
	        }
                
                if ($query->row('custom_field')==''){
                    $this->EE->db->where('member_id', $query->row('member_id'));
                    $this->EE->db->update('exp_member_data', array('m_field_id_'.$this->settings[$site_id]["$provider"]['custom_field'] => $userdata['custom_field']));
                }
                
                //error_log(__LINE__ . ' : ' .$query->row('member_id') . ':' .$this->EE->session->userdata('member_id') );
                if ($query->row('member_id') != $this->EE->session->userdata('member_id') ){
                    return $this->_login_by_id($query->row('member_id'), FALSE, $temp_password);
                }
            }
        }
        
        if ( $this->EE->session->userdata('member_id') ) {    
            $this->site_id = $site_id;
            $userdata['provider'] =  $provider;            
            return $this->_connect_social_login($userdata,$this->EE->session->userdata('member_id'));
        }
        
        if ( $this->EE->config->item('allow_member_registration') != 'y' ){
            return $this->_show_error('general', lang('mbr_registration_not_allowed'), $is_popup);            
        }
        
        //$data = array_merge($userdata,$data);
        ////error_log( __LINE__ . PHP_EOL .print_r($data,1) . PHP_EOL . print_data($userdata,1));
        $member_id = $this->_new_user_from_social_login($userdata,$temp_password,$provider);        
        ////error_log('new user id : ' . $member_id);
        return $this->_login_by_id($member_id, FALSE, $temp_password);
    }  
    
    function _update_avatar($member_id, $url)
    {
        if ($member_id==0 || $member_id=='' || $url=='')
        {
            return;
        }
        
        $avatar_path = $this->EE->config->item('avatar_path');
        if ( ! @is_dir($avatar_path))
        {
        	return;
        }
        
        $filename = 'uploads/avatar_'.$member_id.'.png';
        $filepath = $avatar_path.$filename;
        while (file_exists($filepath))
        {
            $filename = 'uploads/avatar_'.$member_id.'_'.rand(1, 100000).'.png';
            $filepath = $avatar_path.$filename;
        }

        $ch = curl_init();
        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off'))
        {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        }
        else
        {        
            $rch = curl_copy_handle($ch);
            curl_setopt($rch, CURLOPT_HEADER, true);
            curl_setopt($rch, CURLOPT_NOBODY, true);
            curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
            curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
            do {
                curl_setopt($rch, CURLOPT_URL, $url);
                $header = curl_exec($rch);
                if (curl_errno($rch)) 
                {
                    $code = false;
                }
                else 
                {
                    $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                    if ($code == 301 || $code == 302) 
                    {
                        preg_match('/Location:(.*?)\n/', $header, $matches);
                        $url = trim(array_pop($matches));
                    } 
                    else 
                    {
                        $code = false;
                    }
                }
            } while ($code != false);
        }
            
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $fp = fopen($filepath, FOPEN_WRITE_CREATE_DESTRUCTIVE);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_exec($ch);       
        curl_close($ch);
        fclose($fp);
        
        $size = getimagesize($filepath);               
        //rename if necessary
        switch ($size['mime'])
        {
            case 'image/jpeg':
                $filename = str_replace('.png', '.jpg', $filename);
                break;
            case 'image/gif':
                $filename = str_replace('.png', '.jpg', $filename);
                break;
            default:
                //do nothing;
                break;
        }
        $new_filepath = $avatar_path.$filename;
        //size ok?
        $max_w	= ($this->EE->config->item('avatar_max_width') == '' OR $this->EE->config->item('avatar_max_width') == 0) ? 100 : $this->EE->config->item('avatar_max_width');
		$max_h	= ($this->EE->config->item('avatar_max_height') == '' OR $this->EE->config->item('avatar_max_height') == 0) ? 100 : $this->EE->config->item('avatar_max_height');
        if ($size[0] > $max_w && $size[1] > $max_h)
        {
            $config['source_image'] = $filepath;
            $config['new_image'] = $new_filepath;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $max_w;
            $config['height'] = $max_h;
            $this->EE->load->library('image_lib', $config);

            $this->EE->image_lib->resize();
        }
        else 
        if ($new_filepath != $filepath)
        {
            copy($filepath, $new_filepath);
        }
        
        if (file_exists($new_filepath))
        {
            $size = getimagesize($new_filepath);            
            if ($size!==false)
            {
                $upd_data = array('avatar_filename'=>$filename, 'avatar_width'=>$size[0], 'avatar_height'=>$size[1]);
                $this->EE->db->where('member_id', $member_id);
                $this->EE->db->update('members', $upd_data);
            }                
        }

    }
    
    
    function _update_photo($member_id, $url)    {
        if ($member_id==0 || $member_id=='' || $url=='')
        {
            return;
        }
        
        $photo_path = $this->EE->config->item('photo_path');
        if ( ! @is_dir($photo_path))
        {
        	return;
        }
        
        $filename = 'photo_'.$member_id.'.jpg';
        $filepath = $photo_path.$filename;
        while (file_exists($filepath))
        {
            $filename = 'photo_'.$member_id.'_'.rand(1, 100000).'.jpg';
            $filepath = $photo_path.$filename;
        }

        $ch = curl_init();
        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off'))
        {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        }
        else
        {        
            $rch = curl_copy_handle($ch);
            curl_setopt($rch, CURLOPT_HEADER, true);
            curl_setopt($rch, CURLOPT_NOBODY, true);
            curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
            curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
            do {
                curl_setopt($rch, CURLOPT_URL, $url);
                $header = curl_exec($rch);
                if (curl_errno($rch)) 
                {
                    $code = false;
                }
                else 
                {
                    $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                    if ($code == 301 || $code == 302) 
                    {
                        preg_match('/Location:(.*?)\n/', $header, $matches);
                        $url = trim(array_pop($matches));
                    } 
                    else 
                    {
                        $code = false;
                    }
                }
            } while ($code != false);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $fp = fopen($filepath, FOPEN_WRITE_CREATE_DESTRUCTIVE);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $size = getimagesize($filepath);
        //rename if necessary
        switch ($size['mime'])
        {
            case 'image/png':
                $filename = str_replace('.jpg', '.png', $filename);
                break;
            case 'image/gif':
                $filename = str_replace('.jpg', '.gif', $filename);
                break;
            default:
                //do nothing;
                break;
        }
        $new_filepath = $photo_path.$filename;
        //size ok?
        $max_w	= ($this->EE->config->item('photo_max_width') == '' OR $this->EE->config->item('photo_max_width') == 0) ? 100 : $this->EE->config->item('photo_max_width');
		$max_h	= ($this->EE->config->item('photo_max_height') == '' OR $this->EE->config->item('photo_max_height') == 0) ? 100 : $this->EE->config->item('photo_max_height');
        if ($size[0] > $max_w && $size[1] > $max_h)
        {
			$config['source_image'] = $filepath;
            $config['new_image'] = $new_filepath;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $max_w;
            $config['height'] = $max_h;
            $this->EE->load->library('image_lib', $config);

            $this->EE->image_lib->resize();
        }
        else 
        if ($new_filepath != $filepath)
        {
            copy($filepath, $new_filepath);
        }

        if (file_exists($new_filepath))
        {
            $size = getimagesize($new_filepath);
            if ($size!==false)
            {
                $upd_data = array('photo_filename'=>$filename, 'photo_width'=>$size[0], 'photo_height'=>$size[1]);
                $this->EE->db->where('member_id', $member_id);
                $this->EE->db->update('members', $upd_data);
            }
        }

    }        
    
    function _new_user_from_social_login($userdata,$temp_password,$provider){        
                
        $site_id = $this->EE->config->item('site_id');
        $data = [];
        if (isset($this->settings[$site_id]['email_is_username']) && $this->settings[$site_id]['email_is_username']==true && $userdata['email']!=''){
		$data['username']   = $userdata['email'];
                $data['email']      = $userdata['email'];
	}
        
        if ($userdata['email']==''){
            $data['email']      =   $userdata['username'] .'@'. $provider;
        }
        
        //need to make sure username is unique
        $j = 1;
        do {
            $this->EE->db->select('username')
                        ->from('members')
                        ->where('username', $userdata['username'])
                        ->limit(1);
            $q = $this->EE->db->get();
            if ($q->num_rows()>0){
                $data['username'] = $userdata['username'].$j;
                $userdata['screen_name'] = $userdata['screen_name']." ".$j;
            }
            $j++;
        }while ($q->num_rows()>0);
        
        
        
        if ($userdata['email']=='' 
                && isset($this->settings[$site_id]['force_pending_if_no_email']) 
                && $this->settings[$site_id]['force_pending_if_no_email']==true){
            
            $data['group_id'] = 4; //Pending
	}else{
            $data['group_id'] = (isset($this->settings[$site_id]['member_group']) && $this->settings[$site_id]['member_group']!='') ? $this->settings[$site_id]['member_group'] : $this->EE->config->item('default_member_group');            
        }
   		
        $data['password']       = sha1($temp_password);
        $data['ip_address']     = $this->EE->input->ip_address();
        $data['unique_id']	= $this->EE->functions->random('encrypt');
        $data['join_date']	= $this->EE->localize->now;        
        $data['username']       = $data['username']  ? $data['username']  : ($userdata['username'] ? $userdata['username'] : $userdata['screen_name'] ) ;
        $data['screen_name']    = $userdata['screen_name'];
        
        $data['url']		 = prep_url($data['url']);
        $data['location']	 = $userdata['location'];

        $data['avatar_filename'] = @$userdata['avatar'] ? $userdata['avatar']  : 'social_login/'.$provider.'.png';
        $data['avatar_width']    = '80'; 
        $data['avatar_height']   = '80';

        $data['language']	= ($this->EE->config->item('deft_lang')) ? $this->EE->config->item('deft_lang') : 'english';
        $data['time_format'] = ($this->EE->config->item('time_format')) ? $this->EE->config->item('time_format') : 'us';
        $data['timezone']	= ($this->EE->config->item('default_site_timezone') && $this->EE->config->item('default_site_timezone') != '') ? $this->EE->config->item('default_site_timezone') : $this->EE->config->item('server_timezone');
        $data['bio']            = @$userdata['bio']  ? mb_convert_encoding(@$data['instagram']['bio'],'ASCII'): '';

        ////error_log('NEW USER : ' . print_r($data,1));
        $this->EE->db->query($this->EE->db->insert_string('exp_members', $data));
        $member_id = $this->EE->db->insert_id();

        $cust_fields['member_id'] = $member_id;
        $cust_fields['m_field_id_'.$this->settings[$site_id]["$provider"]['custom_field']] = $userdata['custom_field'];
        
        $this->EE->db->query($this->EE->db->insert_string('exp_member_data', $cust_fields));

        $this->EE->db->query($this->EE->db->insert_string('exp_member_homepage', array('member_id' => $member_id)));
        
        if ($this->EE->config->item('enable_avatars')=='y' && $userdata['avatar']!=''){
            $this->_update_avatar($member_id, $userdata['avatar']);
        }
        
        if ($this->EE->config->item('enable_photos')=='y' && $userdata['photo']!=''){
            $this->_update_photo($member_id, $userdata['photo']);
        }
        
        
        
        if ($this->EE->config->item('new_member_notification') == 'y' && 
                $this->EE->config->item('mbr_notification_emails') != ''){
                $name = ($data['screen_name'] != '') ? $data['screen_name'] : $data['username'];

                $swap = array(
                                                'name'					=> $name,
                                                'site_name'				=> stripslashes($this->EE->config->item('site_name')),
                                                'control_panel_url'		=> $this->EE->config->item('cp_url'),
                                                'username'				=> $data['username'],
                                                'email'					=> $data['email']
                                         );

                $template = $this->EE->functions->fetch_email_template('admin_notify_reg');
                $email_tit = $this->EE->functions->var_swap($template['title'], $swap);
                $email_msg = $this->EE->functions->var_swap($template['data'], $swap);

                $this->EE->load->helper('string');

                // Remove multiple commas
                $notify_address = reduce_multiples($this->EE->config->item('mbr_notification_emails'), ',', TRUE);

                // Send email
                $this->EE->load->helper('text');

                $this->EE->load->library('email');
                $this->EE->email->wordwrap = true;
                $this->EE->email->from($this->EE->config->item('webmaster_email'), $this->EE->config->item('webmaster_name'));
                $this->EE->email->to($notify_address);
                $this->EE->email->subject($email_tit);
                $this->EE->email->message(entities_to_ascii($email_msg));
                $this->EE->email->Send();
        }        
        $zoo = $this->EE->db->select('module_id')->from('modules')->where('module_name', 'Zoo_visitor')->get(); 
        if ($zoo->num_rows()>0)         {
        	$this->EE->load->add_package_path(PATH_THIRD.'zoo_visitor/');
			$this->EE->load->library('zoo_visitor_lib');
			$this->EE->zoo_visitor_lib->sync_member_data();
			$this->EE->load->remove_package_path(PATH_THIRD.'zoo_visitor/');
        }
 		// Send admin notifications
        
        ////error_log('MEMBERSTATS');
        $this->EE->stats->update_member_stats();
                
        // -------------------------------------------
        // 'member_member_register' hook.
	//  - Additional processing when a member is created through the User Side
	//  - $member_id added in 2.0.1
	//
	$edata = $this->EE->extensions->call('member_member_register', $data, $member_id);
	if ($this->EE->extensions->end_script === TRUE) return;
	//
	// -------------------------------------------
        
        return $member_id;
    }
        
    function _connect_social_login($data,$member_id){
            
            $provider = $data['provider'];
            
            $this->_save_session_data(array($provider=>$data));
            $cust_fields = array();
            $cust_fields['m_field_id_'.$this->settings[$this->site_id][$provider]['custom_field'] ] = $data['custom_field'];        
            
            $this->EE->db->where('member_id', $member_id);           
            $this->EE->db->update('member_data', $cust_fields);
            $return = $this->social_login['return'];
                        
            if (!$return) {
                $return = $this->social_login['no_email_return'];
            }
                        
            if( $this->social_login['is_popup'] == false) {
                return $this->EE->functions->redirect($return);
            }else {
                $out = "<script type=\"text/javascript\">if (window.opener){window.opener.location = '$return';window.close();}else{window.location = '$return';}</script>";
                exit($out);
            }
    }
    
    function _login_by_id($member_id, $multi = FALSE, $temp_password=''){
        $session_id = $this->social_login['session_id'];
        //error_log(__LINE__.print_r($this->social_login,1));
		$is_popup = $this->social_login['is_popup'];
        $this->_clear_session_data($session_id);            
        if ($multi == FALSE && ($member_id=='' || $member_id==0)){
            
            return false;
        }
        
        $edata = $this->EE->extensions->call('member_member_login_start');
        if ($this->EE->extensions->end_script === TRUE) return;
	
		$this->session_id = $this->EE->session->create_new_session($member_id,false);				
        $return = $this->social_login['return'];
        
        //error_log(__LINE__ . print_r($_SESSION['social_login'],1));
        $this->_save_session_data( $_SESSION['social_login'] );
                
        if ($is_popup==false) {
            return $this->EE->functions->redirect($return);
        }else {
            $out = "<script type=\"text/javascript\">if (window.opener){window.opener.location = '$return';window.close();}else{window.location = '$return';}</script>";
            echo $out;
        }
   
    }
    
    function add_userdata()
    {
        if ($this->EE->session->userdata('member_id')==0)
        {
            return $this->EE->TMPL->no_results();
        }
        
        $this->EE->db->select('password, email')
                    ->where('member_id', $this->EE->session->userdata('member_id'));
        $q = $this->EE->db->get('members');
        if ($q->row('email')!='' && $q->row('password')!='')
        {
            return $this->EE->TMPL->no_results();
        }
        
        $tmpl = $this->EE->TMPL->tagdata;
        
        if (preg_match("/".LD."email_block".RD."(.*?)".LD.'\/'."email_block".RD."/s", $tmpl, $match))
		{
            if ($q->row('email')=='')
            {
                $tmpl = str_replace ($match['0'], $match['1'], $tmpl);	
            }
            else
            {
                $tmpl = str_replace ($match['0'], "", $tmpl);	
            }			
		}
        
        if (preg_match("/".LD."password_block".RD."(.*?)".LD.'\/'."password_block".RD."/s", $tmpl, $match))
		{
            if ($q->row('password')=='')
            {
                $tmpl = str_replace ($match['0'], $match['1'], $tmpl);	
            }
            else
            {
                $tmpl = str_replace ($match['0'], "", $tmpl);	
            }			
		}
        
        $data['hidden_fields']['ACT'] = $this->EE->functions->fetch_action_id('Social_login', 'save_userdata');            
		$data['id']		= ($this->EE->TMPL->fetch_param('id')!='') ? $this->EE->TMPL->fetch_param('id') : 'social_login_userdata_form';
        $data['name']		= ($this->EE->TMPL->fetch_param('name')!='') ? $this->EE->TMPL->fetch_param('name') : 'social_login_userdata_form';
        $data['class']		= ($this->EE->TMPL->fetch_param('class')!='') ? $this->EE->TMPL->fetch_param('class') : 'social_login_userdata_form';

        if ($this->EE->TMPL->fetch_param('return')=='')
        {
            $return = $this->EE->functions->fetch_site_index();
        }
        else if ($this->EE->TMPL->fetch_param('return')=='SAME_PAGE')
        {
            $return = $this->EE->functions->fetch_current_uri();
        }
        else if (strpos($this->EE->TMPL->fetch_param('return'), "http://")!==FALSE || strpos($this->EE->TMPL->fetch_param('return'), "https://")!==FALSE)
        {
            $return = $this->EE->TMPL->fetch_param('return');
        }
        else
        {
            $return = $this->EE->functions->create_url($this->EE->TMPL->fetch_param('return'));
        }

        $data['hidden_fields']['RET'] = $return;


        $out  = $this->EE->functions->form_declaration($data).$tmpl."</form>";
        
        return $out;
        
    }
    
    function save_userdata()
    {
        $this->EE->lang->loadfile('myaccount');
        $this->EE->lang->loadfile('member');
        
        $xtra_msg = '';
        
        if ($this->EE->session->userdata('member_id')==0)
        {
            $this->EE->output->show_user_error('general', $this->EE->lang->line('unauthorized_access'));
            return;
        }
        
        $this->EE->db->select('password, email')
                    ->where('member_id', $this->EE->session->userdata('member_id'));
        $q = $this->EE->db->get('members');
        if (($q->row('email')!='' && $q->row('password')!='') || ($q->row('email')!='' && isset($_POST['email']) && $_POST['email']!='') || ($q->row('password')!='' && isset($_POST['password']) && $_POST['password']!=''))
        {
            $this->EE->output->show_user_error('general', $this->EE->lang->line('unauthorized_access'));
            return;
        }
        
        if ($this->EE->input->post('email')==false && $this->EE->input->post('password')==false)
        {
            $this->EE->output->show_user_error('general', $this->EE->lang->line('no_data_for_update'));
            return;  
        }
        
        $data = array();
        //	Validate submitted data
		if ( ! class_exists('EE_Validate'))
		{
			require APPPATH.'libraries/Validate.php';
		}

		$this->EE->VAL = new EE_Validate(
								array(
										'member_id'			=> $this->EE->session->userdata('member_id'),
										'val_type'			=> 'new', // new or update
										'fetch_lang'		=> FALSE,
										'require_cpw'		=> FALSE,
										'enable_log'		=> TRUE,
										'email'				=> $this->EE->input->post('email'),
                                        'password'			=> $this->EE->input->post('password'),
							            'password_confirm'	=> $this->EE->input->post('password_confirm')
									 )
							);
        if (isset($_POST['email']) && $_POST['email']!='')
        {
            $this->EE->VAL->validate_email();
            $data['email'] = $this->EE->input->post('email');
        }
        if (isset($_POST['password']) && $_POST['password']!='')
        {
            $this->EE->VAL->validate_password();
        }

		if (count($this->EE->VAL->errors) > 0)
		{
			$this->EE->output->show_user_error('general', $this->EE->VAL->show_errors());
		}
		
		if (isset($_POST['password']) && $_POST['password']!='')
        {
			$this->EE->load->library('auth');
			$this->EE->auth->update_password($this->EE->session->userdata('member_id'),
											 $this->EE->input->post('password'));
	 	}
        
        if (!empty($data))
        {
	        // We generate an authorization code if the member needs to self-activate
	        // Send user notifications
			if (isset($data['email']) && $this->EE->config->item('req_mbr_activation') == 'email')
			{
				$data['authcode'] = $this->EE->functions->random('alnum', 10);
				$action_id  = $this->EE->functions->fetch_action_id('Member', 'activate_member');
	
				$swap = array(
					'name'				=> $this->EE->session->userdata('screen_name'),
					'activation_url'	=> $this->EE->functions->fetch_site_index(0, 0).QUERY_MARKER.'ACT='.$action_id.'&id='.$data['authcode'],
					'site_name'			=> stripslashes($this->EE->config->item('site_name')),
					'site_url'			=> $this->EE->config->item('site_url'),
					'username'			=> $this->EE->session->userdata('username'),
					'email'				=> $data['email']
				 );
	
				$template = $this->EE->functions->fetch_email_template('mbr_activation_instructions');
				$email_tit = $this->EE->functions->var_swap($template['title'], $swap);
				$email_msg = $this->EE->functions->var_swap($template['data'], $swap);
	
				// Send email
				$this->EE->load->helper('text');
	
				$this->EE->load->library('email');
				$this->EE->email->wordwrap = true;
				$this->EE->email->from($this->EE->config->item('webmaster_email'), $this->EE->config->item('webmaster_name'));
				$this->EE->email->to($data['email']);
				$this->EE->email->subject($email_tit);
				$this->EE->email->message(entities_to_ascii($email_msg));
				$this->EE->email->Send();
	
				$xtra_msg = BR.lang('mbr_membership_instructions_cont');
			}
			
			$this->EE->db->where('member_id', $this->EE->session->userdata('member_id'));
	        $this->EE->db->update('members', $data);
        }
        
        $zoo = $this->EE->db->select('module_id')->from('modules')->where('module_name', 'Zoo_visitor')->get(); 
        if ($zoo->num_rows()>0)
        {
        	$this->EE->load->add_package_path(PATH_THIRD.'zoo_visitor/');
			$this->EE->load->library('zoo_visitor_lib');
			$this->EE->zoo_visitor_lib->sync_member_data();
			$this->EE->load->remove_package_path(PATH_THIRD.'zoo_visitor/');
        }
        
        // User is quite widespread, so we'll add user hook here
        /* -------------------------------------------
		/* 'user_edit_end' hook.
		/*  - Do something when a user edits their profile
		/*  - Added $cfields for User 2.1
		*/
			$edata = $this->EE->extensions->call('user_edit_end', $this->EE->session->userdata('member_id'), $data, array());
			if ($this->EE->extensions->end_script === TRUE) return;
		/*
		/* -------------------------------------------*/
        
        $data = array(	'title' 	=> $this->EE->lang->line('profile_updated'),
        				'heading'	=> $this->EE->lang->line('profile_updated'),
        				'content'	=> $this->EE->lang->line('mbr_profile_has_been_updated').$xtra_msg,
        				'redirect'	=> $_POST['RET'],
        				'link'		=> array($_POST['RET'], $this->EE->config->item('site_name')),
                        'rate'		=> 5
        			 );
			
		$this->EE->output->show_message($data);
        
    }    
    
    
    function _random_string($length = 16, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'){
        $chars_length = (strlen($chars) - 1);        
        $str = str_shuffle($chars);
        return substr($str,rand(0,$chars_length - $length),$length);
    }        
    
    
    function _show_error($type='general', $message, $is_popup = false){
        if ($is_popup==true){
            $data = array('title' 	=> ($type=='general')?$this->EE->lang->line('general_error'):$this->EE->lang->line('submission_error'),
                          'heading'	=> ($type=='general')?$this->EE->lang->line('general_error'):$this->EE->lang->line('submission_error'),
                          'content'	=> $message
					 );
					
            $this->EE->output->show_message($data);
        }else{
            $this->EE->output->show_user_error($type, $message);
        }
    }    
    
    
    function _clear_session_data($session_id){
    	if ($session_id=='') $session_id = session_id(); //fallback
        
        //error_log($_SERVER['REQUEST_URI']);
        //error_log(print_r(debug_backtrace() ,1) );
        $this->EE->db->where('session_id', $session_id);
        $this->EE->db->or_where('set_date < ', $this->EE->localize->now - 6*60*60); //and remove records older than 6 hours
    	$this->EE->db->delete('social_login_session_data');
    }
    
    function _save_session_data($data, $session_id){
        if ($session_id=='') $session_id = session_id(); //fallback

        if (isset($data['session_id'])) unset($data['session_id']);

        if (isset($data['instagram']['bio']))
            $data['instagram']['bio'] = mb_convert_encoding(@$data['instagram']['bio'],'ASCII');
        
        // prev session_data for another provider;
        $provider = @key($data);        
        $prev_data = $this->_get_session_data($session_id);                
        //error_log(__LINE__ . ':' .$session_id . PHP_EOL .count($prev_data).':'.print_r($prev_data,1));
        
        if (count($prev_data) ){
            $data = array_merge($prev_data,$data);
//            //error_log(__LINE__ . print_r($data,1));
            $this->EE->db->update('social_login_session_data',
                    array('set_date'	=>	$this->EE->localize->now,
                          'provider'    =>      $provider,
                          'data'	=>	serialize($data)
                        ),
                    array('session_id'=>$session_id)
                    );
            
        }else{
            $this->EE->db->insert('social_login_session_data',
                    array(  'session_id'=> $session_id,
                            'set_date'	=>	$this->EE->localize->now,
                            'provider'  =>      $provider,
                            'data'	=>	serialize($data)
                    ));
        }
    }
    
    function _get_session_data($session_id,$provider=''){
    	if ($session_id=='') $session_id = session_id(); //fallback
        $this->EE->db->select('data,provider');
        $this->EE->db->where('session_id', $session_id);
        if ($provider){
            $this->EE->db->where('provider', $provider);
        }
        
        $this->EE->db->order_by('set_date', 'desc')->limit(1);
        $query = $this->EE->db->get('social_login_session_data');
        if ($query->num_rows()>0){
            $data = array();
            $provider = '';
            foreach ($query->result_array() as $row){
                    $provider = $row['provider'];
                    $data = unserialize($row['data']);
//                    //error_log(__LINE__ . print_r($data,1));
                    $data = $data[$provider];
            }
            $data['session_id'] = $session_id;
            return array($provider => $data);
        }
        
        return array();
    }



}
/* END */
?>
