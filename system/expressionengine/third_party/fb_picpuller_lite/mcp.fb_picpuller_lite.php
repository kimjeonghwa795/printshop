<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// include config file
include (PATH_THIRD.'fb_picpuller_lite/config.php');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * fb_picpuller Module Control Panel File
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		John Morton
 * @link		http://picpuller.com
 */

class Fb_picpuller_lite_mcp {

	public $return_data;

	private $_base_url;

	// $_currentSite will identify whatever is the current site in the control panel for use in cases where MSM is being used.
	private $_currentSite;

	private $DEBUG = PP_FB_DEBUG;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();

		$this->_currentSite = $this->EE->config->config['site_id'];

		$this->_currentAppId = $this->getCurrentAppId();

		$this->_the_server = $_SERVER['HTTP_HOST'];

		$this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.PP_FB_PACKAGE;

		$this->EE->load->library('session');

		if ( $this->isSuperAdmin() ) {

		$this->EE->cp->set_right_nav(array(
			'fb_set_up'	=> $this->_base_url,
			// Not needed for PP Lite
			'fb_info' => $this->_base_url.AMP.'method=fb_info',
			// 'fb_users' => $this->_base_url.AMP.'method=fb_users',
			// 'fb_all_app_info' => $this->_base_url.AMP.'method=fb_all_app_info',
			// 'fb_advanced_menu' => $this->_base_url.AMP.'method=fb_advanced_menu'
			// Add more right nav items here in needed
		));
		} else {

			// ==============================================================
			// = A non-SuperAdmin doesn't get to see the rest of the module =
			// = so only the link to the home page of the module is here.   =
			// ==============================================================

			$this->EE->cp->set_right_nav(array(
				'fb_set_up'	=> $this->_base_url
				// Add more right nav items here in needed
			));
		}

		// set the name of the CP title
		if (function_exists('ee')) {
			$this->EE->view->cp_page_title = lang(PP_FB_PACKAGE.'_module_name');
		} else {
			$this->EE->cp->set_variable('cp_page_title', lang(PP_FB_PACKAGE.'_module_name'));
		}
	}

	// ----------------------------------------------------------------

	/**
	 * Index Function
	 *
	 * @return 	void
	 */
	public function index()
	{

		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		$vars['site_label'] = $this->getSiteLabel();

		$vars['adv_menu_url'] = $this->_base_url.'&method=fb_advanced_menu';
		$vars['fb_advanced_menu'] = lang('fb_advanced_menu');
		$vars['fb_adv_user_auth'] = lang('fb_adv_user_auth');
		$vars['adv_user_url'] = $this->_base_url.'&method=adv_user_admin';

		$baseURLpattern = '/(?:https?:\/\/)?(?:www\.)?([a-zA-Z0-9\.\-]*\/)/';;

		preg_match($baseURLpattern, $this->EE->config->config['base_url'], $current_base_url);
		$current_base_url = $current_base_url[1];

		preg_match($baseURLpattern, $this->EE->config->config['cp_url'], $current_cp_url);
		$current_cp_url = $current_cp_url[1];

		$vars['ableToAuthorizeFromThisURL'] = ($current_cp_url === $current_base_url);
		$vars['frontend_auth_url'] = $this->getFrontEndAuth();

		if ($this->appAuthorized()) {
			$vars['delete_method'] = $string = $this->_base_url.'&method=removeAuthorization';

			return $this->EE->load->view('authorized', $vars, TRUE);
		}

		$this->EE->load->library('javascript');
		$this->EE->load->library('table');
		$this->EE->load->helper('form');

		// Help the user figure out the oAuth redirect URL

		$vars['full_auth_url'] = $this->getRedirectURL();

		$vars['redirect_url'] = $this->getRedirectURL(true);

		$action_id = $this->EE->functions->fetch_site_index(0, 0).QUERY_MARKER.'ACT='.$this->EE->cp->fetch_action_id(PP_FB_PACKAGE, 'authorization');

		$vars['action_id'] = $action_id;

		/*
		FUTURE:
		Use JS to help user construct EE code for each tag pair.

		$this->EE->javascript->output(array(
				'// add my own jQuery here.'
				)
		);
		$this->EE->javascript->compile();
		*/

		$vars['form_hidden'] = NULL;
		$vars['options'] = array(
						'edit'  => lang('edit_selected'),
						'delete'    => lang('delete_selected')
						);

		if ( $this->appExistsInDb() )
		{
			// app exists in DB so the Action URL is the Redirect URL for authroizing an app

			$vars['preexisting_app'] = TRUE;
			$vars['action_url'] = $this->getRedirectURL();
			$vars['clientID'] = $this->getClientID();

		}
		else
		{
			// no app exists in DB so the Action URL is to save setting to the DB

			$vars['preexisting_app'] = FALSE;
			$vars['action_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.PP_FB_PACKAGE.AMP.'method=save_settings';
		}

		if ( $this->isSuperAdmin() ) {
			return $this->EE->load->view('index', $vars, TRUE);
		}
		else
		{
			return $this->EE->load->view('index_nonsuperadmin', $vars, TRUE);
		}
	}

	/**
	 * Display info within the control panel about the **current** Instagram app in Pic Puller
	 * @return a view "fb_about"
	 */
	public function fb_info()
	{
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		$vars['site_label'] = $this->getSiteLabel();
		$vars['client_id'] = $this->getClientID();
		$vars['client_secret'] = $this->getSecret();
		$vars['frontend_auth_url'] = $this->getFrontEndAuth();
		$vars[PP_FB_PACKAGE.'_prefix'] = $this->get_fb_picpuller_prefix();
		// The URLs to edit the app
		$vars['delete_method'] = $this->_base_url.'&method=preview_delete_app';
		$vars['edit_secret'] = $this->_base_url.'&method=edit_secret';
		$vars['edit_prefix'] = $this->_base_url.'&method=edit_prefix';
		$vars['edit_frontend_url'] = $this->_base_url.'&method=edit_frontend_url';
		return $this->EE->load->view('fb_about', $vars, TRUE);
	}

	/**
	 * Display info within the control panel about **all** Instagram apps in Pic Puller
	 * @return a view "fb_about_all_apps"
	 */

	public function fb_all_app_info()
	{
		$this->EE->db->select('site_id,app_id,fb_client_id,fb_client_secret,site_label,fb_picpuller_lite_prefix');
		$this->EE->db->from(PP_FB_PACKAGE.'_credentials');
		$this->EE->db->join('sites', PP_FB_PACKAGE.'_credentials.fb_site_id = sites.site_id');
		$query = $this->EE->db->get();

		// echo "<pre>";
		// print_r( $query->result() );
		// echo "</pre>";

		$site_ids = array();
		$app_ids = array();
		$site_labels = array();
		$client_ids = array();
		$client_secrets = array();
		$fb_picpuller_lite_prefixs = array();

		foreach ($query->result() as $row)
		{
			array_push($site_ids, $row->site_id);
			array_push($app_ids, $row->app_id);
			array_push($site_labels, $row->site_label);
			array_push($client_ids, $row->fb_client_id);
			array_push($client_secrets, $row->fb_client_secret);
			array_push($fb_picpuller_lite_prefixs, $row->fb_picpuller_lite_prefix);
		}

		$vars['site_ids'] = $site_ids;
		$vars['app_ids'] = $app_ids;
		$vars['site_labels'] = $site_labels;
		$vars['client_ids']	= $client_ids;
		$vars['client_secrets']	= $client_secrets;
		$vars[PP_FB_PACKAGE.'_prefixs'] = $fb_picpuller_lite_prefixs;
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');

		$vars['app_info_link'] = $this->_base_url.'&method=fb_info';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['current_site_id'] = $this->_currentSite;

		return $this->EE->load->view('fb_about_all_apps', $vars, TRUE);
	}

	/**
	 * Display the ADVANCED menu
	 * @return   a view "fb_advanced"
	 */

	public function fb_advanced_menu()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['adv_user_url'] = $this->_base_url.'&method=adv_user_admin';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';

		// menu names from lang file
		$vars['fb_advanced_menu'] = lang('fb_advanced_menu');
		$vars['fb_adv_user_auth'] = lang('fb_adv_user_auth');


		return $this->EE->load->view('fb_advanced', $vars, TRUE);
	}


	/**
	 * Display users within the control panel of users who have authorized Pic Puller to talk to their Instagram account
	 * @return a view "fb_users"
	 */
	public function fb_users()
	{
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		$vars['site_label'] = $this->getSiteLabel();
		$member_ids= array();
		$screen_names= array();
		$oauths= array();

		// don't run the db query is there is no app define b/c there will be no users for an undefined app
		if ($this-> appExistsInDb() ) {
			$vars['appexists'] =  TRUE;
			$this->EE->db->select(PP_FB_PACKAGE.'_oauths.member_id, screen_name, oauth');
			$this->EE->db->where('app_id', $this->_currentAppId );
			$this->EE->db->from(PP_FB_PACKAGE.'_oauths');

			$this->EE->db->join('members', PP_FB_PACKAGE.'_oauths.member_id = members.member_id');
			$query = $this->EE->db->get();


			foreach ($query->result() as $row)
			{
				array_push($member_ids, $row->member_id);
				array_push($screen_names, $row->screen_name);
				array_push($oauths, $row->oauth);
			}

		} else {
			$vars['appexists'] =  FALSE;
		}

		$vars['member_ids'] = $member_ids;
		$vars['screen_names'] = $screen_names;
		$vars['oauths']	= $oauths;

		return $this->EE->load->view('fb_users', $vars, TRUE);
	}

	/**
	 * Display a view that will let user update the secret (aka password) of their Instram App
	 * @return a view "fb_secret_update"
	 */
	public function edit_secret()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['client_id'] = $this->getClientID();
		$vars['client_secret'] = $this->getSecret();
		$vars['form_hidden'] = NULL;
		$vars['update_secret_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=fb_picpuller'.AMP.'method=edit_secret_step2';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';

		return $this->EE->load->view('fb_secret_update', $vars, TRUE);
	}

	/**
	 * Update the secret (aka password) in the database
	 * @return a view "save_settings"
	 */
	public function edit_secret_step2()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		if (function_exists('ee')) {
			$this->EE->view->cp_page_title = lang(PP_FB_PACKAGE.'_module_name');
		} else {
			$this->EE->cp->set_variable('cp_page_title', lang(PP_FB_PACKAGE.'_module_name'));
		}
		$fb_client_id = $this->getClientID();
		$fb_client_secret = $this->EE->input->post('fb_client_secret', TRUE);
		$data = array(
			'fb_client_secret' => $fb_client_secret
		);

		$this->EE->db->where('fb_client_id', $fb_client_id);
		$this->EE->db->update(PP_FB_PACKAGE.'_credentials', $data);

		$vars['fb_client_secret'] = $fb_client_secret;
		$vars['client_id'] = $fb_client_id;
		$vars['client_secret'] = $fb_client_secret;
		$vars['frontend_auth_url'] = $this->getFrontEndAuth();
		$vars[PP_FB_PACKAGE.'_prefix'] =$this->get_fb_picpuller_prefix();
		$vars['homeurl'] = $this->_base_url;
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';
		return $this->EE->load->view('update_settings_confirmation', $vars, TRUE);
	}

	/**
	 * Display a view that will let user update the secret (aka password) of their Instram App
	 * @return a view "fb_secret_update"
	 */
	public function edit_prefix()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['client_id'] = $this->getClientID();
		$vars['client_secret'] = $this->getSecret();
		$vars[PP_FB_PACKAGE.'_prefix'] = $this->get_fb_picpuller_prefix();
		$vars['form_hidden'] = NULL;
		$vars['update_secret_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=fb_picpuller'.AMP.'method=edit_prefix_step2';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';

		return $this->EE->load->view('fb_prefix_update', $vars, TRUE);
	}

	/**
	 * Update the secret (aka password) in the database
	 * @return a view "save_settings"
	 */
	public function edit_prefix_step2()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		if (function_exists('ee')) {
			$this->EE->view->cp_page_title = lang(PP_FB_PACKAGE.'_module_name');
		} else {
			$this->EE->cp->set_variable('cp_page_title', lang(PP_FB_PACKAGE.'_module_name'));
		}
		$fb_client_id = $this->getClientID();
		$fb_picpuller_prefix = $this->EE->input->post(PP_FB_PACKAGE.'_prefix', TRUE);
		$data = array(
			PP_FB_PACKAGE.'_prefix' => $fb_picpuller_prefix
		);

		$this->EE->db->where('fb_client_id', $fb_client_id);
		$this->EE->db->update(PP_FB_PACKAGE.'_credentials', $data);

		$vars['client_id'] = $fb_client_id;
		$vars['client_secret'] = $this->getSecret();
		$vars['frontend_auth_url'] = $this->getFrontEndAuth();
		$vars[PP_FB_PACKAGE.'_prefix'] =$fb_picpuller_prefix;
		$vars['homeurl'] = $this->_base_url;
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';
		return $this->EE->load->view('update_settings_confirmation', $vars, TRUE);
	}

	/**
	 * Display a view that will let user update the secret (aka password) of their Instram App
	 * @return a view "fb_secret_update"
	 */
	public function edit_frontend_url()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['client_id'] = $this->getClientID();
		$vars['client_secret'] = $this->getSecret();
		$vars['frontend_auth_url'] = $this->getFrontEndAuth();
		$vars['form_hidden'] = NULL;
		$vars['update_frontend_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=fb_picpuller'.AMP.'method=edit_frontend_url_step2';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';

		return $this->EE->load->view('fb_frontedurl_update', $vars, TRUE);
	}

	//fb_frontedurl_update

	/**
	 * Update the secret (aka password) in the database
	 * @return a view "save_settings"
	 */
	public function edit_frontend_url_step2()
	{
		$vars['site_label'] = $this->getSiteLabel();
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		$this->EE->view->cp_page_title = lang(PP_FB_PACKAGE.'_module_name');
		$fb_client_id = $this->getClientID();

		$frontend_auth_url = $this->EE->input->post('frontend_auth_url', TRUE);
		$data = array(
			'frontend_auth_url' => $frontend_auth_url
		);

		$this->EE->db->where('fb_client_id', $fb_client_id);
		$this->EE->db->update(PP_FB_PACKAGE.'_credentials', $data);

		$vars['client_id'] = $fb_client_id;
		$vars['client_secret'] = $this->getSecret();
		$vars['frontend_auth_url'] = $this->getFrontEndAuth();
		$vars[PP_FB_PACKAGE.'_prefix'] =$this->get_fb_picpuller_prefix();
		$vars['homeurl'] = $this->_base_url;
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';
		return $this->EE->load->view('update_settings_confirmation', $vars, TRUE);
	}

	/**
	 * Save a user's Instagram Client ID and Client Secret into the EE database
	 * @return a view "save_settings"
	 */
	public function save_settings()
	{
		// in this function save the client ID and the client secret for the user created application

		// NOTES:
		//
		// table: fb_picpuller_credentials
		//
		// fields:
		//  fb_client_id
		//  fb_client_secret
		//  fb_picpuller_prefix

		$default_prefix = 'fb_';

		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');
		$vars['app_info_link'] = $this->_base_url.'&method=fb_info';
		$vars['edit_tab_name'] =  $this->EE->lang->line('fb_info');
		
		if (function_exists('ee')) {
			$this->EE->view->cp_page_title = lang(PP_FB_PACKAGE.'_module_name');
		} else {
			$this->EE->cp->set_variable('cp_page_title', lang(PP_FB_PACKAGE.'_module_name'));
		}

		$fb_client_id = $this->EE->input->post('fb_client_id', TRUE);
		$fb_client_secret = $this->EE->input->post('fb_client_secret', TRUE);

		// Update new settings
		// NO - cant empty table now $this->EE->db->empty_table(PP_FB_PACKAGE.'_credentials');
		$this->EE->db->set('fb_client_id', $fb_client_id);
		$this->EE->db->set('fb_client_secret', $fb_client_secret);
		$this->EE->db->set(PP_FB_PACKAGE.'_prefix', $default_prefix);
		$this->EE->db->set('fb_site_id', $this->_currentSite);
		$this->EE->db->set('auth_url', $this->getRedirectURL() );
		$this->EE->db->insert(PP_FB_PACKAGE.'_credentials');

		$vars['client_id'] = $fb_client_id;
		$vars['client_secret'] = $fb_client_secret;

		$vars['homeurl'] = $this->_base_url;
		return $this->EE->load->view('save_settings', $vars, TRUE);
	}

	/**
	 * First step, a warning, when a user attempts to delete their Instagram App
	 * @return a view "fb_about_delete_confirmation"
	 */
	public function preview_delete_app()
	{
		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');

		$vars['client_id'] = $this->getClientID();

		$vars['delete_method'] = $this->_base_url.'&method=delete_app';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';

		$vars['site_label'] = $this->getSiteLabel();

		return $this->EE->load->view('fb_about_delete_confirmation', $vars, TRUE);
	}

	/**
	 * Second step when a user attempts to delete their Instagram App. This DOES the actual deletion
	 * @return a view - the index , aka, the home set up page for Pic Puller
	 */
	public function delete_app()
	{
		/// only SuperAdmins can delete the app
		if ( $this->isSuperAdmin() ) {
			$appID = $this->getCurrentAppId();

			$this->EE->db->delete(PP_FB_PACKAGE.'_credentials', array('app_id' => $appID));
			$this->EE->db->delete(PP_FB_PACKAGE.'_oauths', array('app_id' => $appID));

			// return to the top level of Pic Puller
			return $this->index();
		}
	}

	/**
	 * Remove a single user's authorization from the EE database for the Instagram App
	 * @return a view "authorized_removed"
	 */
	public function removeAuthorization()
	{
		$appID = $this->getCurrentAppId();

		$vars['moduleTitle'] = lang(PP_FB_PACKAGE.'_module_name');
		$vars['moduleShortTitle'] = lang(PP_FB_PACKAGE.'_short_module_name');

		$this->EE->db->select('*');
		$this->EE->db->limit('1');
		$this->EE->db->where('member_id', $this->getLoggedInUserId() );
		$this->EE->db->where('app_id', $appID );
		$this->EE->db->delete(PP_FB_PACKAGE.'_oauths');
		return $this->EE->load->view('authorized_removed', $vars, TRUE);
	}

	/**
	 * ADVANCED: User Admin
	 */

	public function adv_user_admin()
	{
		$vars['app_id'] = $this->_currentAppId;
		$vars['site_label'] = $this->getSiteLabel();
		$vars['fb_adv_user_auth'] = lang('fb_adv_user_auth');
		$vars['fb_advanced_menu'] = lang('fb_advanced_menu');
		$authURL = $this->EE->functions->fetch_site_index(0, 0).QUERY_MARKER.'ACT='.$this->EE->cp->fetch_action_id('fb_picpuller', 'authorization');
		$vars['alt_url'] = 'https://instagram.com/oauth/authorize/?client_id='.$this->getClientID().'&redirect_uri='.$authURL.'&response_type=token';

		$vars['update_user_info_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=fb_picpuller'.AMP.'method=save_user_info_adv';
		$vars['fb_info_name'] =  $this->EE->lang->line('fb_info');
		$vars['cancel_url'] = $this->_base_url.'&method=fb_info';
		$vars['form_hidden'] = NULL;
		$vars['setup_link'] = $this->_base_url;

		//  getting current user info if present

		$this->EE->db->select('instagram_id,oauth');
		$this->EE->db->from(PP_FB_PACKAGE.'_oauths');
		$this->EE->db->where(PP_FB_PACKAGE.'_oauths.app_id', $this->_currentAppId );
		$this->EE->db->where('member_id', $this->getLoggedInUserId());
		$this->EE->db->limit(1);
		$query = $this->EE->db->get();

		 // 4echo "<pre>";
		 // 4print_r( $query->result() );
		 // 4echo "</pre>";

		foreach ($query->result() as $row)
		{
			$vars['fb_user_id'] = $row->instagram_id;
			$vars['fb_user_oauth'] = $row->oauth;
		}

		if (!isset($vars['fb_user_id'])){
			$vars['fb_user_id'] ='';
		}

		if (!isset($vars['fb_user_oauth'])){
			$vars['fb_user_oauth'] ='';
		}

		return $this->EE->load->view('fb_advanced_user_admin', $vars, TRUE);
	}

	public function save_user_info_adv() {


		$fb_user_id = $this->EE->input->post('fb_user_id', TRUE);
		$fb_user_oauth = $this->EE->input->post('fb_user_oauth', TRUE);

		$this->remove_auth_logged_in_user();
		//echo "fb_user_id: ".$fb_user_id . ' and fb_user_oauth: '. $fb_user_oauth;

		$this->EE->db->set('oauth', $fb_user_oauth);
		$this->EE->db->set('instagram_id', $fb_user_id);
		$this->EE->db->set('member_id', $this->getLoggedInUserId());
		$this->EE->db->set('app_id', $this->_currentAppId);
		$this->EE->db->insert(PP_FB_PACKAGE.'_oauths');


		// return to the top level of Pic Puller
		return $this->index();
	}

	/**
	 * Remove Authorization of Logged In User
	 *
	 * Remove the logged in users oAuth credentials from the database
	 *
	 * @access	private
	 * @return	NULL
	 */

	private function remove_auth_logged_in_user()
	{
		// TO DO : remove the select * - not needed, but want to test first, so I've left it in for this version.

		$this->EE->db->select('*');
		$this->EE->db->limit('1');
		$this->EE->db->where('member_id', $this->getLoggedInUserId() );
		$this->EE->db->where('app_id', $this->_currentAppId);
		$this->EE->db->delete(PP_FB_PACKAGE.'_oauths');
	}

	// HELPER FUNCTIONS BELOW

	private function getClientID()
	{
		$this->EE->db->select('fb_client_id');
		$this->EE->db->where('fb_site_id', $this->_currentSite);
		$this->EE->db->limit(1);
		$query = $this->EE->db->get(PP_FB_PACKAGE.'_credentials');

		foreach ($query->result() as $row)
		{
			$fb_client_id = $row->fb_client_id;
		}
		if (isset($fb_client_id)){
			return $fb_client_id;
		} else {
			return;
		}
	}

	/**
	 * Get fb_picpuller_prefix
	 *
	 * Get the prefix from the Pic Puller Credentials table for the existing Pic Puller application.
	 * This prefix will be used for all tags for this application.
	 *
	 * @access	private
	 * @return	mixed - returns a string, the prefix, if available in DB, or an empty string if unavailable
	 */

	private function get_fb_picpuller_prefix()
	{
		$this->EE->db->select(PP_FB_PACKAGE.'_prefix');
		$this->EE->db->where('fb_site_id', $this->_currentSite);
		$this->EE->db->limit(1);
		$query = $this->EE->db->get(PP_FB_PACKAGE.'_credentials');

		foreach ($query->result() as $row)
		{
			$fb_picpuller_prefix = $row->fb_picpuller_lite_prefix;
		}
		if (isset($fb_picpuller_prefix)){
			return $fb_picpuller_prefix;
		} else {
			return '';
		}
	}

	private function getSecret()
	{
		$this->EE->db->select('fb_client_secret');
		$this->EE->db->where('fb_site_id', $this->_currentSite);
		$this->EE->db->limit(1);
		$query = $this->EE->db->get(PP_FB_PACKAGE.'_credentials');

		foreach ($query->result() as $row)
		{
			$fb_client_secret = $row->fb_client_secret;
		}
		if (isset($fb_client_secret)){
			return $fb_client_secret;
		} else {
			return;
		}
	}

	private function getFrontEndAuth()
	{
		$this->EE->db->select('frontend_auth_url');
		$this->EE->db->where('fb_site_id', $this->_currentSite);
		$this->EE->db->limit(1);
		$query = $this->EE->db->get(PP_FB_PACKAGE.'_credentials');

		foreach ($query->result() as $row)
		{
			$frontend_auth_url = $row->frontend_auth_url;
		}
		if (isset($frontend_auth_url)){
			return $frontend_auth_url;
		} else {
			return;
		}
	}

	private function getRedirectURL($urlEncoded = false)
	{
		return $this->EE->functions->fetch_site_index(0, 0).QUERY_MARKER.'ACT='.$this->EE->cp->fetch_action_id(PP_FB_PACKAGE, 'authorization');


	}

	private function getCurrentAppId()
	{

		$this->EE->db->select('app_id');
		$this->EE->db->where('fb_site_id', $this->_currentSite);
		$this->EE->db->limit(1);
		$this->EE->db->from(PP_FB_PACKAGE.'_credentials');

		$query = $this->EE->db->get();

		foreach ($query->result() as $row)
		{
			$current_app_id = $row->app_id;
		}

		if (isset($current_app_id)){
			return $current_app_id;
		} else {
			return false;
		}
	}

	private function getSiteLabel()
	{

		$this->EE->db->select('site_label, site_id');
		$this->EE->db->where('site_id', $this->_currentSite);
		$this->EE->db->limit(1);
		$this->EE->db->from('sites');

		$query = $this->EE->db->get();

		foreach ($query->result() as $row)
		{
			$site_label = $row->site_label;
		}

		if (isset($site_label)){
			return $site_label;
		} else {
			return false;
		}
	}

	private function appAuthorized()
	{
		/// NEED TO CHECK that we're talking about the current CP site
		// $this->EE->config->config['site_id']

		$this->EE->db->select('oauth');
		$this->EE->db->where('member_id', $this->getLoggedInUserId() );
		$this->EE->db->join(PP_FB_PACKAGE.'_credentials', PP_FB_PACKAGE.'_credentials.app_id = '.PP_FB_PACKAGE.'_oauths.app_id');
		$this->EE->db->where(PP_FB_PACKAGE.'_credentials.fb_site_id', $this->_currentSite);
		$this->EE->db->limit('1');
		$this->EE->db->from(PP_FB_PACKAGE.'_oauths');
		$query = $this->EE->db->get();

		if ($query->num_rows() == 1)
		{
			return true;
		} else {
			return false;
		}
	}

	private function appExistsInDb()
	{

		// is there an application already defined in the database?
		$this->EE->db->select('*');
		$this->EE->db->where('fb_site_id', $this->_currentSite );
		$this->EE->db->limit('1');
		$this->EE->db->from(PP_FB_PACKAGE.'_credentials');
		$query = $this->EE->db->get();

		if ($query->num_rows() == 0)
		{
			return false;
		} else {
			return true;
		}
	}

	private function getLoggedInUserId()
	{
		$this->EE->load->library('session');
		return $this->EE->session->userdata('member_id');
	}

	private function isSuperAdmin()
	{
		if ($this->EE->session->userdata['group_id'] === '1' )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}

}
/* End of file mcp.fb_picpuller.php */
/* Location: /system/expressionengine/third_party/fb_picpuller/mcp.fb_picpuller.php */