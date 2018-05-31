<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package		Social_meta
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Justin Koivisto
 * @link		http://koivi.com/ee-social-meta
 */
class Social_meta {
	var $return_data;
    
	public function __construct(){
        $this->EE =& get_instance();
        $entry_id = $this->get_param('entry_id');
        $site_id = $this->get_param('site_id', $this->EE->config->item('site_id'));
        $canonical_url = $this->get_param('canonical',$this->EE->functions->fetch_current_uri());
		$tagdata = '';
		$vars = '';
        $got_values = FALSE;

        if($entry_id){
            $table_name = 'social_meta_content';
            $where = array(
            	't.site_id'	=> $site_id,
            	't.entry_id'	=> $entry_id
            );
            $select_str = 't.fbtitle, t.fbtype, t.fbdescription, t.fbimage, t.fbappid, t.fbauthor, t.fbtrailer, t.twtitle, t.twtype, t.twdescription, t.twimage, social_meta_config.template';
            $this->EE->db->select($select_str);
            $this->EE->db->from($table_name. ' t');
            $this->EE->db->where($where);
            $this->EE->db->join('social_meta_config', 'social_meta_config.site_id = t.site_id');
            $q = $this->EE->db->get();

            if($q->num_rows() > 0){
                $social_meta_entry = $q->row();
                $tagdata = $this->get_tagdata($social_meta_entry->template);
                $vars = array(
                	'fbtitle'		=>	htmlspecialchars($social_meta_entry->fbtitle, ENT_QUOTES),
                	'fbtype'		=>	htmlspecialchars($social_meta_entry->fbtype, ENT_QUOTES),
                	'fbdescription'         =>	htmlspecialchars($social_meta_entry->fbdescription, ENT_QUOTES),
                	'fbimage'		=>	$this->get_url_from_filedir_id($social_meta_entry->fbimage),
                	'fbappid'		=>	htmlspecialchars($social_meta_entry->fbappid, ENT_QUOTES),
                	'fbauthor'		=>	htmlspecialchars($social_meta_entry->fbauthor, ENT_QUOTES),
                	'fbtrailer'		=>	htmlspecialchars($social_meta_entry->fbtrailer, ENT_QUOTES),
                	'twtitle'		=>	htmlspecialchars($social_meta_entry->twtitle, ENT_QUOTES),
                	'twtype'		=>	htmlspecialchars($social_meta_entry->twtype, ENT_QUOTES),
                	'twdescription'         =>	htmlspecialchars($social_meta_entry->twdescription, ENT_QUOTES),
                	'twimage'		=>	$this->get_url_from_filedir_id($social_meta_entry->twimage),
// FUTURE: make use of trailing slash an option for the module
                	'canonical_url'	=>	$this->EE->functions->fetch_current_uri().'/',
                );
                $got_values = TRUE;
            }
        }

        // segment variables are not parsed yet, so we do it ourselves if they are in use in the code template
        if(preg_match_all('/\{segment_(\d)\}/i', $tagdata, $matches)){
            $word_separator_replace = ($this->EE->config->item('word_separator') == 'underscore' ? '_' : '-');
            $tags = $matches[0];
            $segment_numbers = $matches[1];
            for($i=0;$i<count($tags);$i++){
                $tag = $tags[$i];
                $segment_value = $friendly_segments ? ucfirst(str_replace($word_separator_replace, ' ', $this->EE->uri->segment($segment_numbers[$i]))) : $this->EE->uri->segment($segment_numbers[$i]);
                $tagdata = str_replace($tag, $segment_value, $tagdata);
            }
        }

        $this->return_data = $this->EE->TMPL->parse_variables_row($tagdata, $vars);
        
        // also check the return data for items that were empty and should not be in the output
        $pattern='`(<meta.+\/?\>)`isU';
        if(preg_match_all($pattern,$this->return_data,$m)){
        	foreach($m[0] as $tag){
        		if(preg_match('`content=(\'|\"){2}`i', $tag)){
        			$this->return_data = str_replace($tag, '', $this->return_data);
        		}
        	}
        }

        return $this->return_data;
    }
    
    private function get_tagdata($default_template){
        $tagdata = $this->EE->TMPL->tagdata;
        if( empty($tagdata)){
            $tagdata = $default_template;
        }
        return $tagdata;
    }

    private function get_url_from_filedir_id($str){
        if (preg_match('/^{filedir_(\d+)}/', $str, $matches)){
            $filedir_id = $matches[1];
            $this->EE->load->model('file_upload_preferences_model');
            $upload_dest_info = $this->EE->file_upload_preferences_model->get_file_upload_preferences(FALSE, $filedir_id);
            $str = str_replace('{filedir_'.$filedir_id.'}', $upload_dest_info['url'], $str);
        }
        if(preg_match('`^\/[^\/]`',$str)){
        	// some people use URIs in the file location settings intstead,
        	// look for a single slash starting the string
        	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
        		$protocol='https://';
        	}else{
        		$protocol='http://';
        	}
        	$str = $protocol.$_SERVER['HTTP_HOST'].$str;
        }
        return $str;
    }

	private function get_request_uri() 
	{
		if(!isset($_SERVER['REQUEST_URI'])) {
			$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
			if($_SERVER['QUERY_STRING']) {
				$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
			}
		}
		return $_SERVER['REQUEST_URI'];
	}

	private function get_param($key, $default_value = ''){
		$val = $this->EE->TMPL->fetch_param($key);

        // since EE will remove space at the beginning of a parameter people are using &nbsp; or &#32;
        // we replace these with a standard space here
        $val = str_replace(array('&nbsp;','&#32;'), array(' ',' '), $val);

		if($val == ''){
			return $default_value;
		}
		return $val;
	}

	private function error_log($msg){		
		$this->EE->TMPL->log_item("social_meta ERROR: ".$msg);		
	}		
}

/* End of file mod.social_meta.php */ 
/* Location: ./system/expressionengine/third_party/social_meta/mod.social_meta.php */
