<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package		Social_meta
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Justin Koivisto
 * @link		http://koivi.com/ee-social-meta
 */
class Social_meta_upd {
	var $version        = '1.0';
	var $module_name = "Social_meta";

    public $EE;
    function Social_meta_upd($switch = TRUE){ 
		$this->EE =& get_instance();
    } 

    function install(){				
		$site_id = $this->EE->config->item('site_id');
		if($site_id == 0){
			// if installed with a theme site_id will be 0, so set it to 1
			$site_id = 1;
		}
		
		$data = array(
			'module_name' 	 => $this->module_name,
			'module_version' => $this->version,
			'has_cp_backend' => 'n',
            'has_publish_fields' => 'y'            
		);

		$this->EE->db->insert('modules', $data);		

        $this->EE->load->dbforge();

        $social_meta_content_fields = array(
            'content_id' => array(
                'type' => 'int',
                'constraint' => '10',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'site_id' => array(
                'type' => 'int',
                'constraint' => '10',
                'null' => FALSE,
            ),
            'entry_id' => array(
                'type' => 'int',
                'constraint' => '10',
                'null' => FALSE,
            ),

            'fbtitle' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'fbtype' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'fbtrailer' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'fbauthor' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'fbappid' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'fbdescription' => array(
                'type' => 'text',
            ),            
            'fbimage' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            

            'twtitle' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'twtype' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
            'twdescription' => array(
                'type' => 'text',
            ),            
            'twimage' => array(
                'type' => 'varchar',
                'constraint' => '1024',
            ),            
        );

        $this->EE->dbforge->add_field($social_meta_content_fields);
        $this->EE->dbforge->add_key('content_id', TRUE);
        $this->EE->dbforge->create_table('social_meta_content');

        $social_meta_config_fields = array(
            'config_id' => array(
                'type' => 'int',
                'constraint' => '10',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'site_id' => array(
                'type' => 'int',
                'constraint' => '10',
                'unsigned' => TRUE,
            ),
            'template' => array(
                'type' => 'text',
            ),
        );

        $this->EE->dbforge->add_field($social_meta_config_fields);
        $this->EE->dbforge->add_key('config_id', TRUE);
        $this->EE->dbforge->create_table('social_meta_config');

        // insert default config
        $this->EE->db->insert('social_meta_config', array(
            'template' => "<meta property=\"og:site_name\" content=\"{site_name}\" />\n<meta property=\"og:title\" content=\"{fbtitle}\" />\n<meta property=\"og:type\" content=\"{fbtype}\" />\n<meta property=\"og:description\" content=\"{fbdescription}\" />\n<meta property=\"og:image\" content=\"{fbimage}\" />\n<meta property=\"og:url\" content=\"{canonical_url}\" />\n<meta name=\"twitter:title\" content=\"{twtitle}\" />\n<meta name=\"twitter:card\" content=\"{twtype}\" />\n<meta name=\"twitter:description\" content=\"{twdescription}\" />\n<meta name=\"twitter:image\" content=\"{twimage}\" />\n<meta name=\"twitter:url\" content=\"{canonical_url}\" />\n<meta property=\"fb:app_id\" content=\"{fbappid}\" />\n",
            'site_id' => $site_id,
        ));

        $this->EE->load->library('layout');
        $this->EE->layout->add_layout_tabs($this->tabs(), 'social_meta');

		return TRUE;
	}

	/**
		tab's layout fields
	**/
    function tabs()
    {
        $tabs['social_meta'] = array(
            'social_meta_fbtitle'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_fbtrailer'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_fbauthor'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_fbappid'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_fbtype'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_fbdescription'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_fbimage'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_twtitle'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_twtype'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_twdescription'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            'social_meta_twimage'=> array(
                'visible'	=> 'true',
                'collapse'	=> 'false',
                'htmlbuttons'	=> 'false',
                'width'		=> '100%'
                ),
            );

        return $tabs;
    }

	/**
	 * Uninstall the Social_meta module
	 */
	function uninstall() 
	{ 				
        $this->EE->load->dbforge();
        
		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => $this->module_name));
		
		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');
		
		$this->EE->db->where('module_name', $this->module_name);
		$this->EE->db->delete('modules');
		
		$this->EE->db->where('class', $this->module_name);
		$this->EE->db->delete('actions');
		
		$this->EE->db->where('class', $this->module_name.'_mcp');
		$this->EE->db->delete('actions');

        $this->EE->dbforge->drop_table('social_meta_content');
        $this->EE->dbforge->drop_table('social_meta_config');

        $this->EE->load->library('layout');
        $this->EE->layout->delete_layout_tabs($this->tabs(), 'social_meta');

		return TRUE;
	}
	
	/**
	 * Update the Social_meta module
	 * 
	 * @param $current current version number
	 * @return boolean indicating whether or not the module was updated 
	 */
    function update($current = '')
    {
        if ($current == $this->version)
        {
            return FALSE;
        }

        if($current < '1.0') {
            // do stuff
        }

        return TRUE;
    }

}

/* End of file upd.social_meta.php */
/* Location: ./system/expressionengine/third_party/social_meta/upd.social_meta.php */