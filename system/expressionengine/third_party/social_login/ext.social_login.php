<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social_login_ext {

	var $name = 'Social Login Extension';
	var $version = '1.0.3';
	var $settings_exist = 'n';
	var $docs_url = 'http://ellislab.com/expressionengine/user-guide/modules/wiki/index.html';
	var $required_by = array('module');

	/**
	 * Constructor
	 */
	function __construct(){
            @session_start();
	}
        function member_login_hook(){    
            //error_log('member_login : '. session_id()) ;
        }
        function member_logout_hook(){    
            //error_log('member_logout : '. session_id()) ;            
            ee()->db->delete('social_login_session_data',array('session_id' => session_id()));
            return true;
        }

	/**
	 * Activate Extension
	 */
	function activate_extension(){
            $data = array();
            $data[] = array(
                    'class'     => 'Social_login',
                    'method'    => 'member_login_hook',
                    'hook'      => 'member_member_login_start',
                    'settings'  => serialize($this->settings),
                    'priority'  => 10,
                    'version'   => $this->version,
                    'enabled'   => 'y'
                );

            $data[] = array(
                    'class'     => 'Social_login',
                    'method'    => 'member_logout_hook',
                    'hook'      => 'member_member_logout',
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

