<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include (PATH_THIRD.'ig_picpuller_lite/config.php');
class Ig_picpuller_lite_ext {

	var $name = 'IG PicPuller';
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
            
            $member_inst = ee()->db->select('*')->from(PP_IG_PACKAGE . '_oauths')->where('member_id',ee()->session->userdata('member_id'))->get();
            if ($member_inst->num_rows()){
                $member_inst = $member_inst->result_array()[0];
                $_SESSION['instagram_token'] = $member_inst['oauth'];
            }
        }
	// --------------------------------------------------------------------


	/**
	 * Activate Extension
	 */
	function activate_extension(){
            $data = array(
                    'class'     => 'Ig_pic_puller_lite',
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

