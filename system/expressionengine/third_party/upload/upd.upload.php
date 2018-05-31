<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_upd {

	var $version = '1.0.1';
        var $EE ;
        function __construct() {
            $this->EE =& get_instance();
            $this->mod_class = 'Upload';
        }
                
	function tabs()
	{
		$tabs['upload'] = array(
                    'upload_field_ids'	=> array(
                                    'visible'		=> 'true',
                                    'collapse'		=> 'false',
                                    'htmlbuttons'	=> 'true',
                                    'width'             => '100%'
                                )
                            );	
				
		return $tabs;	
	}
        



	// --------------------------------------------------------------------
        
        
        
        protected function _register_action($method){    
            $this->EE->db->where('class', $this->mod_class);
            $this->EE->db->where('method', $method);
            if ($this->EE->db->count_all_results('actions') == 0) {
                $this->EE->db->insert('actions', array(
                    'class' => $this->mod_class,
                    'method' => $method
                ));
            }
        }
        function _create_tables(){
            $fields = array(
                            'file_id'=> array(  'type' 	=> 'int',
                                                'constraint'=> '10',
                                                'unsigned'	=> TRUE,
                                                'auto_increment' => TRUE),
                            'dir_id'=> array(   'type'	=> 'int',
                                                'constraint'=> '4'),
                            'file_name'	=> array('type' => 'varchar', 'constraint' => '250'),
                            'file_title'	=> array('type' => 'varchar', 'constraint' => '250', 'null' => TRUE, 'default' => NULL),
                            'member_access'	=> array('type' => 'varchar', 'constraint' => '250', 'default' => 'all'),
                            'file_source'	=> array('type' => 'varchar', 'constraint' => '250'),
                            'file_group'	=> array('type' => 'varchar', 'constraint' => '250'),
                            'owner_id'	=> array('type' => 'int', 'constraint' => '10'),
                            'order_id'	=> array('type' => 'int', 'constraint' => '10'),
                            );

            $this->EE->dbforge->add_field($fields);
            $this->EE->dbforge->add_key('file_id', TRUE);

            $this->EE->dbforge->create_table('upload_files');
		
            unset($fields);

            $fields = array(
                            'file_id'=> array(  'type' => 'int',
                                                'constraint'=> '10',
                                                'unsigned'	=> TRUE),
                           'entry_id'=> array(  'type' 	=> 'int',
                                                'constraint'	 => '10',
                                                'unsigned'		 => TRUE)
                                            );

            $this->EE->dbforge->add_field($fields);
            $this->EE->dbforge->add_key('file_id', TRUE);
            $this->EE->dbforge->add_key('entry_id', TRUE);

            $this->EE->dbforge->create_table('upload_posts');		

        }

        /**
	 * Module Installer
	 *
	 * @access	public
	 * @return	bool
	 */	
	function install()
	{
		$this->EE->load->dbforge();
                
		$data = array(
			'module_name' => 'Upload' ,
			'module_version' => $this->version,
			'has_cp_backend' => 'y',
			'has_publish_fields' => 'n'
		);

		$this->EE->db->insert('modules', $data);
//                $this->_create_tables();
                
                $this->_register_action('uploads');
                $this->_register_action('fetch');
                $this->_register_action('resize');
                $this->_register_action('delete');
                $this->_register_action('get');
                $this->_register_action('list');
                $this->_register_action('housekeeping');
                	
                
                
		$this->EE->load->library('layout');
		$this->EE->layout->add_layout_tabs($this->tabs(), 'upload');
                
                
		return TRUE;

	}
	
	
	// --------------------------------------------------------------------

	/**
	 * Module Uninstaller
	 *
	 * @access	public
	 * @return	bool
	 */
	function uninstall()
	{
		$this->EE->load->dbforge();

		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => 'Upload'));

		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');

		$this->EE->db->where('module_name', $this->mod_class );
		$this->EE->db->delete('modules');

		$this->EE->db->where('class', $this->mod_class);
		$this->EE->db->delete('actions');

		$this->EE->dbforge->drop_table('upload_files');

		$this->EE->load->library('layout');
		$this->EE->layout->delete_layout_tabs($this->tabs(), 'upload');

                $this->EE->dbforge->drop_table('upload_posts');		

		return TRUE;
	}


	
	function update($current='')
	{
		return TRUE;
	}
	
}
/* END Class */

/* End of file upd.upload.php */
/* Location: ./system/expressionengine/third_party/modules/upload/upd.upload.php */