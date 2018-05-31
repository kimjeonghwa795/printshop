<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		David Dexter  								*/
/* 	@copyright	Copyright (c) 2010-2014						*/
/* 	@license	http://brilliantretail.com/license.html		*/
/* 	@link		http://brilliantretail.com 					*/
/* 	@since		Version 1.0.0 Beta							*/
/*															*/
/************************************************************/
/* NOTICE													*/
/*															*/
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF 	*/
/* ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED	*/
/* TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 		*/
/* PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT 		*/
/* SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY */
/* CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION	*/
/* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR 	*/
/* IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 		*/
/* DEALINGS IN THE SOFTWARE. 								*/	
/************************************************************/

include_once(PATH_THIRD.'brilliant_retail/config.php');

class Brilliant_retail_upd {

	public $version	= BR_VERSION;
        private $mod_class = 'Brilliant_retail';
	
	function Brilliant_retail_upd()
	{
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
	}

        
        private function _execute_sql($file){
                $queries = file($file,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $query = '';
                $iqnore = false;
		foreach ($queries as $line){
                    $line = trim($line);
                    if ( substr($line,0,2) == "##" || substr($line,0,2) == "--" ) continue;
                    
                    if (substr($line,0,2)=='/*') {
                        $ignore = true;
                        continue;
                    }
                    
                    if (substr($line,-2,2)=='*/' && $ignore) {
                        $ignore = false;
                        continue;
                    }
                    
                    $query .= ' ' . $line;                    
                    if (substr($line,-1,1) == ';'){
                        $sql = $query;
                        error_log($sql);
                        $this->EE->db->query($query) ;
                        $query = '';
                    }
                                        
		}
        }

        private function _register_action($method,$suffix = '')
        {
            $this->EE->db->where('class', $this->mod_class . $suffix);
            $this->EE->db->where('method', $method);
            if ($this->EE->db->count_all_results('actions') == 0) {
                $this->EE->db->insert('actions', array(
                    'class' => $this->mod_class . $suffix,
                    'method' => $method
                ));
            }
        }
        
        
        private function _install_member_fields(){            
            $fields = array(
                array('br_fname','First Name','1'),
                array('br_lname','Last Name','2'),
                array('br_phone','Phone Number','3'),
                array('br_billing_lname','Billing Last Name','100'), 
                array('br_billing_fname','Billing First Name','101'), 
                array('br_billing_company','Billing Company','102'), 
                array('br_billing_address1','Billing Address 1','103'), 
                array('br_billing_address2','Billing Address 2','104'), 
                array('br_billing_city','Billing City','105'), 
                array('br_billing_state','Billing State','106'), 
                array('br_billing_zip','Billing Zip','107'), 
                array('br_billing_phone','Billing Phone','108'), 
                array('br_billing_country','Billing Country','109'),
                array('br_shipping_fname','Shipping First Name','200'), 
                array('br_shipping_lname','Shipping Last Name','201'), 
                array('br_shipping_company','Shipping Company','202'), 
                array('br_shipping_address1','Shipping Address 1','203'), 
                array('br_shipping_address2','Shipping Address 2','204'), 
                array('br_shipping_city','Shipping City','205'), 
                array('br_shipping_state','Shipping Address State','206'), 
                array('br_shipping_zip','Shipping Address Zip','207'), 
                array('br_shipping_phone','Shipping Phone','208'), 
                array('br_shipping_country','Shipping Country','209')
            );	
    
            // Get all of the memeber fields
                $existing = array();
                $query  = $this->EE->db->from('member_fields');
                $qry    = $query->get();
                foreach($qry->result_array() as $rst)  
                {
                    $existing[$rst["m_field_name"]] = $rst["m_field_name"];
                }
                
            // Create the new ones      
            foreach ($fields as $f)
            {
                // It already exists
                if(isset($existing[$f[0]]))
                {
                    continue;
                }
                
                $query = "INSERT INTO exp_member_fields 
                            (m_field_name,m_field_label,m_field_description,m_field_type,m_field_list_items,m_field_ta_rows,m_field_maxl,m_field_width,m_field_search,m_field_required,m_field_public,m_field_reg,m_field_fmt,m_field_order) 
                          VALUES 
                            ('{$f[0]}', '{$f[1]}', '', 'text', '', '10', '100', '100%', 'n', 'n', 'n', 'y', 'none', '{$f[2]}');";
                            
            	$this->EE->db->query($query);
            	$id = $this->EE->db->insert_id();
            	$this->EE->dbforge->add_column('member_data', array('m_field_id_'.$id => array('type' => 'VARCHAR', 'constraint' => '100' 	)));
            }
        }

        // --------------------------------------------------------------------

	/**
	 * Module Installer
	 *
	 * @access	public
	 * @return	bool
	 */	
	function install()	{
            // Required for updating member fields
            $this->EE->load->dbforge();

            $this->_execute_sql(__DIR__ . DIRECTORY_SEPARATOR . 'install.sql');
            
            $this->_register_action('cart_add');
            $this->_register_action('cart_remove');
            $this->_register_action('cart_clear');
            $this->_register_action('cart_update');
            $this->_register_action('checkout');
            $this->_register_action('checkout_shipping');
            $this->_register_action('checkout_total');
            $this->_register_action('promo_check_code');
            $this->_register_action('customer_register');
            $this->_register_action('customer_profile_update');
            $this->_register_action('customer_pw_update');
            $this->_register_action('customer_download_file');
            $this->_register_action('gateway_ipn');
            $this->_register_action('process_ipn');
            $this->_register_action('pull_feed');
            $this->_register_action('retrieve_password');
            $this->_register_action('wishlist_process');
            $this->_register_action('customer_download_note');
            $this->_register_action('reset_password');
            
            
            $this->_register_action('product_img_update','_mcp');
            $this->_register_action('product_add_atributes','_mcp');
            $this->_register_action('product_search','_mcp');
            $this->_register_action('product_download_update','_mcp');
            $this->_register_action('product_configurable_create_options','_mcp');
            $this->_register_action('download_upload','_mcp');
            $this->_register_action('s3_get_files','_mcp');
            
            $this->EE->db->query("INSERT INTO exp_global_variables (site_id, variable_name, variable_data) VALUES ('1', 'theme', '/themes/site_themes/brilliant_retail');");
            
            
            $channel = array(
                'channel_name' => 'br',
                'channel_title' => 'Brilliant Retail',
                'channel_url' => '/br/',
                'channel_lang' => 'en',                
            );
            
            $this->EE->db->insert('channels',$channel);
            $channel_id =  $this->EE->db->insert_id();
            
            $store = array(
                'site_id'   => 1,
                'channel_id' => $channel_id,
                'logo'      => '/images/logo.png',
                'media_url' => '/media',
                'media_dir' => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'media',
                'currency_id' => 2,                                
            );
            $this->EE->db->insert('br_store',$store);    

            $category =  array( 'title' => 'Products','url_title' => '/products',);            
            $this->EE->db->insert('br_category',$category);
            $category =  array( 'title' => 'Accessories','url_title' => '/accessories',);            
            $this->EE->db->insert('br_category',$category);
            
            
            $tax  = array('title' => 'Sales Tax' ,'rate' => '10');            
            $this->EE->db->insert('br_tax',$tax);
            
            $this->_install_member_fields();
            $this->EE->db->query("INSERT INTO exp_modules (module_name, module_version, has_cp_backend) VALUES ('Brilliant_retail', '".BR_VERSION."', 'y');");

            
            $this->EE->db->query("INSERT INTO exp_extensions  (class,method,hook,settings,priority,version,enabled) 
                VALUES('Brilliant_retail_ext', 'br_edit_entries_additional_where', 'edit_entries_additional_where', '', '10', '".BR_VERSION."', 'y');");
            $this->EE->db->query("INSERT INTO exp_extensions  (class,method,hook,settings,priority,version,enabled) 
                VALUES('Brilliant_retail_ext', 'br_cp_menu_array', 'cp_menu_array', '', '10', '".BR_VERSION."', 'y');");
            $this->EE->db->query("INSERT INTO exp_extensions  (class,method,hook,settings,priority,version,enabled) 
                VALUES('Brilliant_retail_ext', 'br_template_post_parse', 'template_post_parse', '', '99', '".BR_VERSION."', 'y');");
            
            
            
            return TRUE;        
        }
        
        
        
        
        
// --------------------------------------------------------------------
/** * Module Uninstaller * * @access	public * @return	bool */	
        function uninstall() {// Remove the channel
            $this->EE->load->library('api'); 
            $this->EE->api->instantiate('channel_structure');
            
            $qry = $this->EE->db->FROM("br_store");
            $stores = $qry->get();
            foreach($stores->result_array() as $s)
            {
                // Delete the fields / field group
                if($channel = $this->EE->api_channel_structure->get_channel_info($s["channel_id"])){
                    $group = $channel->row();
                    $this->EE->db->delete('field_groups', array('group_id' => $group->field_group));
                    $this->EE->db->delete('channel_fields', array('group_id' => $group->field_group));
                }
                $this->EE->api_channel_structure->delete_channel($s["channel_id"]);
            }
        
                // Remove the snippets and global_vars 
                $this->EE->db->like('snippet_name','br_')->delete('snippets');		  
                $this->EE->db->where('variable_name','theme')->delete('global_variables');
                // Clean up the database
                $module_id = $this->EE->db->query("SELECT module_id FROM exp_modules WHERE module_name = 'Brilliant_retail'")->row()->module_id; 
                
                $this->EE->db->query("DELETE FROM exp_module_member_groups WHERE module_id = $module_id");
                $this->EE->db->query("DELETE FROM exp_modules WHERE module_name = 'Brilliant_retail'");
                $this->EE->db->query("DELETE FROM exp_actions WHERE class = 'Brilliant_retail'");
                $this->EE->db->query("DELETE FROM exp_actions WHERE class = 'Brilliant_retail_mcp'");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_admin_access");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_attribute");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_attribute_option");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_attribute_set");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_attribute_set_attribute");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_cart");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_category");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_config");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_config_data");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_currencies");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_email");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_feeds");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_log");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_address");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_download");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_item");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_note");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_options");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_payment");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_order_ship");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_password_reset");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_addon");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_attributes");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_attributes_option");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_bundle");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_category");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_configurable");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_configurable_attribute");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_download");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_donation");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_entry");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_feeds");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_images");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_price;");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_options");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_product_related");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_promo");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_search");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_state");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_store");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_tax");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_wishlist");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_wishlist_hash");
                $this->EE->db->query("DROP TABLE IF EXISTS exp_br_zone");
                                

		$this->reset_cache();

		return TRUE;
	}

	
	// --------------------------------------------------------------------

	/**
	 * Module Updater
	 *
	 * @access	public
	 * @return	bool
	 */	
	function update($current = '')
	{
		$this->EE->load->dbforge();
		
		// Get the current version
			$version = str_replace(".","",BR_VERSION)*1;
		
		// The first update file should be point above current
		
			$curr = (str_replace(".","",$current)*1);
		
		// Do we need to do any updates?
			if($curr < $version){
				
				$start = $curr + 1;
				
				// Loop through possible udate files
					for($i = $start; $i <= $version; $i++){
						$fl = PATH_THIRD.'brilliant_retail'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'update'.DIRECTORY_SEPARATOR.$i.'.php';
						if(file_exists($fl)){
							// Set a container for the sql statments
								$sql = array();
							
							// Include the file
								include($fl);
							
							// Run DB updates
								foreach ($sql as $query){
									$this->EE->db->query($query);
								}
						}
					}

				// Clear the cache settings file so that the system 
				// is forced to rebuild it
					$this->reset_cache();

				// Rebuild the config file
					$this->EE->load->model('core_model');
					$this->EE->core_model->get_config();
			}
		return TRUE;
	}
	
	function reset_cache(){
	    $dir    = APPPATH.'cache/brilliant_retail';
        $it     = new RecursiveDirectoryIterator($dir);
        $files  = new RecursiveIteratorIterator($it,RecursiveIteratorIterator::CHILD_FIRST);

        foreach($files as $file) {
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
	}
	
	function read_dir_files($directory){
		$arr = array();
		if(file_exists($directory)){
			$dir = opendir($directory);
			while(false != ($file = readdir($dir))){
				if(($file != ".") && ($file != "..") && $file != 'search'){
					$arr[] = $file;
				}
			}
		}
		return $arr;
	}
}