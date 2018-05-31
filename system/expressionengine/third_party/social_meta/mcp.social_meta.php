<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package		Social_meta
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Justin Koivisto
 * @link		http://koivi.com/ee-social-meta
 */
class Social_meta_mcp{
	var $base;
	var $form_base;
	var $module_name = "social_meta";

	function __construct($switch=TRUE){
		$this->EE =& get_instance();

		// URLs to use for the module
		$this->base = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;
		$this->form_base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name;

		$this->EE->load->library('table');
		$this->EE->load->library('javascript');
		$this->EE->load->helper('form');
		$this->EE->lang->loadfile('social_meta');
	}

	function index(){
		$vars = array();
        $site_id = $this->EE->config->item('site_id');
        $config = $this->EE->db->get_where('social_meta_config', array('site_id' => $site_id));

        if($config->num_rows() == 0){
        	// no config for this site found, just grab what is in the database
            $config = $this->EE->db->get_where('social_meta_config');
        }
        
		$vars['template'] = $config->row('template');
		return $this->content_wrapper('index', 'social_meta_settings', $vars);
	}

	function save_settings(){
		$template = $this->EE->input->post('social_meta_template');
        $site_id = $this->EE->config->item('site_id');
        $config = $this->EE->db->get_where('social_meta_config', array('site_id' => $site_id));
        $data_arr = array(
            'template' => $template,
        );

        if($config->num_rows() == 0){
            $data_arr['site_id'] = $site_id;
            $this->EE->db->insert('social_meta_config', $data_arr);
        }else{
            $this->EE->db->where('site_id', $site_id);
            $this->EE->db->update('social_meta_config', $data_arr);
        }

		$this->EE->session->set_flashdata('message_success', lang('settings_saved'));
		$this->EE->functions->redirect($this->base);
	}

	function content_wrapper($content_view, $lang_key, $vars = array()){
		$vars['content_view'] = $content_view;
		$vars['_base'] = $this->base;
		$vars['_form_base'] = $this->form_base;

		// need at least EE 2.6
        $this->EE->view->cp_page_title = lang($lang_key);

		$this->EE->cp->set_breadcrumb($this->base, lang('social_meta_module_name'));
		return $this->EE->load->view('_wrapper', $vars, TRUE);
	}
}

/* End of file mcp.social_meta.php */
/* Location: ./system/expressionengine/third_party/social_meta/mcp.social_meta.php */