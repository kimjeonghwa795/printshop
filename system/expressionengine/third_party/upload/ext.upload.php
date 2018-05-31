<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_ext {

	var $name = 'Upload';
	var $version = '1.0.3';
	var $settings_exist = 'n';
	var $docs_url = 'http://ellislab.com/expressionengine/user-guide/modules/wiki/index.html';
	var $required_by = array('module');

	/**
	 * Constructor
	 */
	function __construct()
	{
	}
        function member_login_hook(){            
            $dir = FCPATH . 'working/' . ee()->session->userdata('member_id') . '/';
            if ( file_exists($dir)){
                $sess_dir = FCPATH . 'working/'. session_id() .'/';            
                if ( file_exists($sess_dir)){
                    $files = scandir($sess_dir);
                    foreach($files as $fname) {
                        if($fname != '.' && $fname != '..') {
                            @rename($sess_dir.$fname, $dir.$fname);
                        }
                    }
                }                
            }else {
                mkdir( $dir );
            }
            
            $ee = ee();            
            $ee->db->where('owner_id',  session_id());
            return  $ee->db->update('photoprints',array('owner_id' => ee()->session->userdata('member_id')));             
        }
	// --------------------------------------------------------------------


	/**
	 * Activate Extension
	 */
	function activate_extension(){
            $data = array(
                    'class'     => 'Upload',
                    'method'    => 'member_login_hook',
                    'hook'      => 'member_member_login_start',
                    'settings'  => serialize($this->settings),
                    'priority'  => 10,
                    'version'   => $this->version,
                    'enabled'   => 'y'
                );

                ee()->db->insert('extensions', $data);
		return TRUE;
		//show_error('This extension is automatically installed with the upload module');
	}

	// --------------------------------------------------------------------

	/**
	 * Update Extension
	 */
	function update_extension($current = FALSE)
	{
		return TRUE;
		//show_error('This extension is automatically updated with the upload module');
	}

	// --------------------------------------------------------------------

	/**
	 * Disable Extension
	 */
	function disable_extension()
	{
		show_error('This extension is automatically deleted with the upload module');
	}

		// --------------------------------------------------------------------

	/**
	 * Disable Extension
	 */
	function uninstall_extension()
	{
		return TRUE;
		//show_error('This extension is automatically deleted with the upload module');
	}

}

