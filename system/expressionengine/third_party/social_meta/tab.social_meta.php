<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package		Social_meta
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Justin Koivisto
 * @link		http://koivi.com/ee-social-meta
 */
class Social_meta_tab {

    public function __construct(){
        $this->EE =& get_instance();
        $this->EE->lang->loadfile('social_meta');
    }

    public function publish_tabs($channel_id, $entry_id = ''){
        $settings = array();

		$fbtitle = $fbtype = $fbdescription = $fbimage = $fbauthor = $fbappid = $fbtrailer = $twtitle = $twtype = $twdescription = $twimage = '';

        $title = $keywords = $description = '';
        if($entry_id){
            $table_name = 'social_meta_content';
            $where = array(
                 'entry_id' => $entry_id,
                 'site_id' => $this->EE->config->item('site_id')
             );

            // -------------------------------------------
            // Allows one to modify the Social Meta pulled up in the tab (ie. for translation addons)
            //
            // Params sent in:
            // - $where - an array of where (activerecord) to check for .. already contains 'entry_id' and 'site_id'
            // - $table_name - the name of the table to pull data from (without db prefix, defaults to 'social_meta_content')
            //
            // Return value:
            // Please return nothing at all or an array which contains 'where' and/or 'table_name' to replace the existing
            // where array and table name to pull data from. This will be used to ->get(where, table_name) the data so
            // you can basically pull whatever from any table.
            //
            // -------------------------------------------
            if ($this->EE->extensions->active_hook('social_meta_tab_content') === TRUE){
                $hook_result = $this->return_data = $this->EE->extensions->call('social_meta_tab_content', $where, $table_name);
                if($hook_result && isset($hook_result['where'])) {
                    $where = $hook_result['where'];
                }
                if($hook_result && isset($hook_result['table_name'])) {
                    $table_name = $hook_result['table_name'];
                }
                if ($this->EE->extensions->end_script === TRUE) return;
            }
            $q = $this->EE->db->get_where($table_name, $where);
            if($q->num_rows){
				$fbtitle       	= $q->row('fbtitle');
				$fbtype        	= $q->row('fbtype');
				$fbtrailer 		= $q->row('fbtrailer');
				$fbauthor 		= $q->row('fbauthor');
				$fbappid 		= $q->row('fbappid');
				$fbdescription  = $q->row('fbdescription');
				$fbimage     	= $q->row('fbimage');
				$twtitle       	= $q->row('twtitle');
				$twtype        	= $q->row('twtype');
				$twdescription 	= $q->row('twdescription');
				$twimage        = $q->row('twimage');
            }
        }

        $settings[] = array(
           'field_id' => 'fbtype',
           'field_data' => $fbtype,
           'field_label' => lang('fbtype'),
           'field_instructions' => lang('fbtype_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'select',
           'field_list_items' => array(
				'website'	=> 'Website',
				'article'	=> 'Article',
				'profile'	=> 'Profile',
			),
		);
        $settings[] = array(
           'field_id' => 'fbtitle',
           'field_data' => $fbtitle,
           'field_label' => lang('fbtitle'),
           'field_instructions' => lang('fbtitle_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'text',
       	);
        $settings[] = array(
           'field_id' => 'fbappid',
           'field_data' => $fbappid,
           'field_label' => lang('fbappid'),
           'field_instructions' => lang('fbappid_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'text',
       	);
/*
        $settings[] = array(
           'field_id' => 'fbauthor',
           'field_data' => $fbauthor,
           'field_label' => lang('fbauthor'),
           'field_instructions' => lang('fbauthor_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'text',
       	);
*/
        $settings[] = array(
           'field_id' => 'fbdescription',
           'field_data' => $fbdescription,
           'field_label' => lang('fbdescription'),
           'field_instructions' => lang('fbdescription_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'textarea',
           'field_ta_rows' => 2,
       	);
        $settings[] = array(
           'field_id' => 'fbimage',
           'field_data' => $fbimage,
           'field_label' => lang('fbimage'),
           'field_instructions' => lang('fbimage_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'file',
       	);
        $settings[] = array(
           'field_id' => 'fbtrailer',
           'field_data' => $fbtrailer,
           'field_label' => lang('fbtrailer'),
           'field_instructions' => lang('fbtrailer_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'text',
      	);
        $settings[] = array(
           'field_id' => 'twtype',
           'field_data' => $twtype,
           'field_label' => lang('twtype'),
           'field_instructions' => lang('twtype_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'select',
           'field_list_items' => array(
           		'summary'	=> 'Summary',
           		'photo'		=> 'Photo',
           		'video'		=> 'Video',
           		'product'	=> 'Product',
//           		'app'		=> 'App',
//           		'gallery'	=> 'Gallery',
//           		'large version' => 'Large Version',
           	),
       	);
        $settings[] = array(
           'field_id' => 'twtitle',
           'field_data' => $twtitle,
           'field_label' => lang('twtitle'),
           'field_instructions' => lang('twtitle_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'text',
       	);
        $settings[] = array(
           'field_id' => 'twdescription',
           'field_data' => $twdescription,
           'field_label' => lang('twdescription'),
           'field_instructions' => lang('twdescription_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'textarea',
           'field_ta_rows' => 2,
       	);
        $settings[] = array(
           'field_id' => 'twimage',
           'field_data' => $twimage,
           'field_label' => lang('twimage'),
           'field_instructions' => lang('twimage_instructions'),
           'field_maxl' => '1024',
           'field_required' => 'n',
           'field_list_items' => '',
           'field_fmt' => '',
           'field_show_fmt' => 'n',
           'field_fmt_options' => array(),
           'field_pre_populate' => 'n',
           'field_text_direction' => 'ltr',
           'field_type' => 'file',
		);

        return $settings;
    }

    function validate_publish($params){
        return TRUE;
    }

    function publish_data_db($params){
        $social_meta_data = $params['mod_data'];
        $site_id = $params['meta']['site_id'];
        $entry_id = $params['entry_id'];

        $content = array(
            'site_id' 		=> $site_id,
            'entry_id' 		=> $entry_id,
            'fbtitle' 		=> $social_meta_data['fbtitle'],
            'fbtype' 		=> $social_meta_data['fbtype'],
            'fbdescription' => $social_meta_data['fbdescription'],
            'fbimage' 		=> $social_meta_data['fbimage'],
            'fbtrailer' 	=> $social_meta_data['fbtrailer'],
            'fbauthor' 		=> $social_meta_data['fbauthor'],
            'fbappid' 		=> $social_meta_data['fbappid'],
            'twtitle' 		=> $social_meta_data['twtitle'],
            'twtype'		=> $social_meta_data['twtype'],
            'twdescription' => $social_meta_data['twdescription'],
            'twimage' 		=> $social_meta_data['twimage'],
        );

        $table_name = 'social_meta_content';
        $where = array(
             'entry_id' => $entry_id,
             'site_id' => $site_id
        );

        $default_where = $where;
        $default_content = $content;
        $default_table_name = $table_name;

        // -------------------------------------------
        // Allows one to modify the Social Meta saved in the tab (ie. for translation addons)
        //
        // Params sent in:
        // - $where - an array of where (activerecord) on UPDATE .. already contains 'entry_id' and 'site_id'
        // - $table_name - the name of the table to pull data from (without db prefix, defaults to 'social_meta_content')
        // - $content - the current content saved (an array of site_id, entry_id, title, keywords, description)
        //
        // Return value:
        // Please return nothing at all or an array which contains 'where' and/or 'table_name' and/or 'content' to
        // replace any of these.
        //
        // But remember the content must contain 'site_id', 'entry_id', 'title', 'keywords', 'description'
        //
        // -------------------------------------------
        if ($this->EE->extensions->active_hook('social_meta_tab_content_save') === TRUE) {

            $hook_result = $this->return_data = $this->EE->extensions->call('social_meta_tab_content_save', $where, $table_name, $content);
            if($hook_result && isset($hook_result['where'])) {
                $where = $hook_result['where'];
            }
            if($hook_result && isset($hook_result['table_name'])) {
                $table_name = $hook_result['table_name'];
            }
            if($hook_result && isset($hook_result['content'])) {
                $content = $hook_result['content'];
            }
            if ($this->EE->extensions->end_script === TRUE) return;
        }

        $q = $this->EE->db->get_where($table_name, $where);

        if($q->num_rows()){
            $this->EE->db->where($where);
            $this->EE->db->update($table_name, $content);
        }else{
            $this->EE->db->insert($table_name, $content);
        }

        /**
         * If the data was stored to another table (ie if a third party addon took control over this),
         * we still just store the content in case that third_party addon is uninstalled later.
         */
        if($table_name != $default_table_name) {
            $q = $this->EE->db->get_where($default_table_name, $default_where);

            if($q->num_rows()){
                $this->EE->db->where($default_where);
                $this->EE->db->update($default_table_name, $default_content);
            }else{
                $this->EE->db->insert($default_table_name, $default_content);
            }
        }
    }

    function publish_data_delete_db($params){
        foreach($params['entry_ids'] as $i => $entry_id){
            $this->EE->db->where('entry_id', $entry_id);
            $this->EE->db->delete('social_meta_content');
        }
    }
}
