<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Crud_upd {

	var $version = '1.0.1';
        var $EE ;
        function __construct() {
            $this->EE =& get_instance();
            $this->mod_class = 'Crud';
        }
        
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
        
        function install(){
                $this->EE->load->dbforge();                
		$data = array(
			'module_name' => 'Crud' ,
			'module_version' => $this->version,
			'has_cp_backend' => 'n',
			'has_publish_fields' => 'n'
		);

		$this->EE->db->insert('modules', $data);
                $this->_register_action('create');
                $this->_register_action('update');
                $this->_register_action('retrieve');
                $this->_register_action('delete');
                $this->_register_action('get');
                $this->_register_action('list');   
                $this->_register_action('name_get');   
                return true;
        }
        
        function uninstall(){
            $this->EE->db->where('module_name', $this->mod_class );
            $this->EE->db->delete('modules');
            $this->EE->db->where('class', $this->mod_class);
	    $this->EE->db->delete('actions');
            return true;
        }
        
        function update($c){
            error_log($c);
            return true;
        }
        
        
}