<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		David Dexter  								*/
/* 	@copyright	Copyright (c) 2010-2014						*/
/* 	@license	http://brilliantretail.com/license.html		*/
/* 	@link		http://brilliantretail.com 					*/
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

include_once(PATH_THIRD.'brilliant_retail/core/class/core.brilliant_retail.php');

/**
 * Brilliant_retail_mcp class for control panel methods
 * 
 * @extends Brilliant_retail_core
 */
class Brilliant_retail_mcp extends Brilliant_retail_core {

	/************************/
	/* Variables 			*/
	/************************/

		public $version			= BR_VERSION;
		public $vars 			= array();
		public $site_id 		= '';
		
		public $base_url 		= ''; 
		public $media_dir 		= '';
		public $media_url 		= '';
		
		public $module 			= '';
		public $method 			= '';
		public $group_access 	= '';
		public $submenu 		= '';

		public $ajax_url 		= '';

		private $_file_manager 	= array();
		private $_channel_data 	= '';
	
		// Ajax methods ignore list for 
		// member group permissions list
		
			private $method_ignore = array(	'order_update_status','order_add_note','order_remove_note',
											'product_batch','product_update','product_add_atributes',
											'product_configurable_create_options','product_search',
											'product_index_search','promo_update','config_attribute_update',
											'config_attributeset_update','config_category_update',
											'config_email_update','config_gateway_update','config_permission_update',
											'config_shipping_update','config_site_update','config_tax_update',
											"order_ajax","customer_ajax","product_ajax","index_products","order_detail",
											"order_detail_add_payment","order_detail_add_payment_process",
											"order_batch", 
											"customer_orders","product_edit", "product_new","promo_new","promo_edit",
											"report_detail","config_feeds_edit","config_attribute_create","config_attribute_edit",
											"config_attributeset_create","config_attributeset_edit","config_attributeset_delete",
											"config_category_edit","config_email_edit","config_gateway_install",
											"config_gateway_edit","config_gateway_remove","config_permission_edit",
											"config_shipping_install","config_shipping_edit","config_shipping_remove",
											"config_tax_new","config_tax_edit","tools_clear_cache","s3_get_files");
											
	/**
	 * __construct function
	 * 
	 * @access public
	 * @param mixed $switch (default: TRUE)
	 * @param mixed $extended (default: FALSE)
	 * @return void
	 */
    	function __construct($switch = TRUE,$extended = FALSE){
    		parent::__construct();
    		
    		// BrilliantRetail Version Number
    			$this->vars['version'] = BR_VERSION;
    			
    		$this->vars["media_dir"] 	= $this->_config["media_dir"];
    		$this->vars["media_url"] 	= $this->_config["media_url"];
    		$this->vars["site_url"] 	= $this->EE->config->item('site_url');
    		$this->vars["site_id"] 		= $this->site_id;
    		
    		// Set the ajax url
    			$this->_ajax_url();
    			$this->vars["ajax_url"] = $this->ajax_url;
    		
    		// Load the access model for the control panel
    			$this->EE->load->model('access_model');
    
    		// Lets check to makes sure each site/store has 
    		// a channel setup!
    			$this->_check_store_channel();
    					
    		// Let's check to make sure each product has a 
    		// paird channel entry
    			$this->_check_product_entry_pair();
    		
    		// Match sure our IPN / Callbacks are csfr exempt
    			if(version_compare(APP_VER, '2.7.0', '>=')){		
    				$this->EE->core_model->exempt_csfr();
    			}
    			
    		// Now we load up stuff. Only do it once! 
    		// Thats what the session->cache check is for
    			if(!isset($this->EE->session->cache['mcp_brilliantretail_construct'])){
    				
    				// Security for our filemanager integration
    		
    				$_SESSION["filemanager"] = TRUE;
    			
    				$this->EE->session->cache['mcp_brilliantretail_construct'] = TRUE;	
    			
    				if($switch == TRUE){
    					$this->module = $this->EE->input->get("module",TRUE);
    					$this->method = ($this->EE->input->get("method",TRUE)) ? ($this->EE->input->get("method",TRUE)) : "index" ;
    		
    					$this->base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module;
    					$this->vars["base_url"] = $this->base_url;
    	
    					// Do an admin access check 
    						$access = $this->_check_admin_access($this->method);
    	
    						if($this->EE->extensions->active_hook('br_check_admin_access_after') === TRUE){
    							$access = $this->EE->extensions->call('br_check_admin_access_after', $access); 
    						}
    	
    					// System ALERT / MESSAGE
    						$this->vars['message'] = ''; 
    						$this->vars['alert'] = '';
    						
    						$message = br_get('message');
    							if($message){
    								$this->vars['message'] = br_get('message');	
    								br_unset('message');
    							}
    						$alert = br_get('alert');
    							if($alert){
    								$this->vars['alert'] = br_get('alert');	
    								br_unset('alert');
    							}
    	
    					// Make sure all emails are initiated
    						$this->_init_emails();
    
    					// Product Types
    						$this->vars['product_type'] = $this->_config['product_type'];	
    
    					// BR Styles
    						$this->EE->cp->add_to_head('<link rel="stylesheet" type="text/css" href="'.$this->_theme('/css/style.css?v='.str_replace('.','',BR_VERSION)).'" />');
    					
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/br.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.dataTables.min.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.dataTables.clear.js').'"></script>');
    						// Added to match EE default styling
    						$this->EE->cp->add_to_foot('<script type="text/javascript">$.fn.dataTableExt.oStdClasses.sSortAsc="headerSortUp";$.fn.dataTableExt.oStdClasses.sSortDesc = "headerSortDown";</script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.validate.pack.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.metadata.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.asmselect.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/swfupload/swfupload.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.form.js').'"></script>');
    						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$this->_theme('/script/jquery.blockui.js').'"></script>');
    							
    					// Set our admin theme 	
    						$this->vars['theme'] = $this->_theme();	
    							
    						$this->vars["site_name"] 	= $this->EE->config->item('site_name');
    						$this->vars["br_header"] 	= $this->_view('_assets/_header', $this->vars);
    						$this->vars["br_logo"] 		= $this->_view('_assets/_logo', $this->vars);
    						$this->vars["br_footer"] 	= $this->_view('_assets/_footer', $this->vars);
    
    						// Set the acton url for uploading images in the product detail tab
    						// Have to set the upload path based on the control panel 
    						// url so we don't have crossdomain issus
    					 		$this->vars['image_upload'] = $this->_theme('upload/image.php');
    					 		$this->vars['download_upload'] = $this->_theme('upload/file.php');
    							$_SESSION["media_dir"] = $this->vars["media_dir"];
    							$_SESSION["media_url"] = $this->vars["media_url"];
    				}else{
    					$this->EE->lang->loadfile('brilliant_retail');
    				}	
    			}
    		}
	
	/**
	 * index function returns dashboard
	 * 
	 * @access public
	 * @return method Dashboard
	 */
	function index(){
            return $this->dashboard();
	}

	/**
	 * dashboard function.
     * Displays a  
	 * 
	 * @access public
	 * @return void
	 */
	function dashboard(){
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_dashboard');

			// Get the sales report
				$dir = PATH_THIRD.'brilliant_retail/core/report/report.sales.php';
				include_once($dir);
		
				$report = new Report_sales();
				
				// We want to run the sales report 5 times 
					$db_reports = array('today','week','month','quarter','year');
					foreach($db_reports as $rep){
						$report->date_range = $rep;
						$data = $report->get_report();
						$total = $data["footer"][6];
						
						$this->vars["reports"][] = array(	
														'title' => lang('br_sales_for').' '.lang('br_'.$rep),
														'total' => $total,
														'link' => '#',  
														'graph' => $data["graph"] 
														); 
					}
		
			// List up to 6 orders on the bottom
				$orders = $this->EE->order_model->get_order_collection('','',6,'',0,0,'desc');
				$i = 0;
				foreach($orders["results"] as $s){
					$orders["results"][$i]["total"] = $this->_currency_round($orders["results"][$i]["total"]);
					$i++;
				}
				$this->vars['order_collection'] = $orders["results"];
				return $this->_view('dashboard/dashboard', $this->vars);
	}

	/************************/
	/* Order Tab		 	*/
	/************************/

    /**
     * order function.
     * 
     * Displays an overview of the current orders
     *
     * @access public
     * @return void
     */
	function order(){
			// Breadcrumb & Page Title 
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_order');

			// Right Button (Create Order)
				$this->EE->cp->set_right_nav(array(
					#'br_new_order' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_new'
				));
			
			// Get the status options from the config variable
				$this->vars["status"] = $this->_config["status"];			
				
			// Batch Action
				$this->vars['action']	= $this->base_url.AMP.'method=order_batch';

			// AJAX url to get order_collection from data tables
				$this->vars["ajax_url"] = $this->base_url.AMP.'method=order_ajax';
			
			// Get the statuses
				$this->vars["status"] = $this->_config["status"];			
			
			// Set the selected status_id based on an existing cookie
				$cookie = $this->EE->input->cookie('br_order_overview');
				if($cookie == ''){
					$this->vars["status_id"] = "all";
				}else{
					$arr = unserialize(base64_decode($cookie));
					$this->vars["status_id"] = $arr["status_id"];
				}

            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_batch';

			return $this->_view('order/order', $this->vars);	
		}
		
	/**
	 * order_ajax function.
	 * 
	 * Callback to get the orders in the overview
     * 
	 * @access public
	 * @return void
	 */
	function order_ajax(){
			$status_id = ($_GET["status_id"] != "") ? $_GET["status_id"]  : '';
			
			$cookie = array(
								'status_id' => $status_id
							);
			$this->EE->input->set_cookie('br_order_overview',base64_encode(serialize($cookie)),time()+(8640*30));
			
			// Get the order collection
                        if($status_id == 'all'){$status_id = '';}
                        $orders = $this->EE->order_model->get_order_collection('','',$_GET["iDisplayLength"],$_GET["sSearch"],$_GET["iDisplayStart"],$_GET["iSortCol_0"],$_GET["sSortDir_0"],$status_id);
			
			// Individual order container
				$order = array();
			
			// Build the row array 
				foreach ($orders["results"] as $row){
					
					// Customer can be a member but we want to 
					// handle the instance where the member has 
					// been deleted better so the model returns 
					// the billing_fname/lname as well in cases
					// where the customer response is Null
						$customer = ($row["customer"] != null) ? '<a href="'.BASE.'&C=myaccount&id='.$row["member_id"].'">'.$row["customer"].'</a>' : $row["billing_customer"];
											
						$status = $this->_config["status"][$row["status_id"]];
                                                $order_link = BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_detail&order_id='.$row["order_id"];
						$order[] = array('	<a href="'.$order_link . '">'.$row["order_id"] .'</a>', 
											$this->EE->localize->format_date('%n/%d/%y %g:%i%a', $row["created"]), 
											$customer, 
											$row["total"],
											$row["payment"],
											$row["balance"],
											'<span class="order_status_'.$row["status_id"].'">'.$status.'</span>',
                                                                                        '<a onclick="alert(\'Cannot decide which item to download, please download from detail\');" href="'.$order_link.'">Download link</a>',
											'<input type="checkbox" name="batch['.$row["order_id"].']" />'
									);
				}
			
			// Response array to json encode
				$output = array(
					"sEcho" => $_GET["sEcho"],
					"iTotalRecords" => $orders["total"],
					"iTotalDisplayRecords" => $orders["displayTotal"],
					"aaData" => $order  
				);
			
			// Return the json data with a success header and exit
				@header("HTTP/1.1 200 OK");
				echo json_encode($output);
				exit();
		}
		
	/**
	 * order_detail function.
	 * 
	 * Display the order detail page
	 * 
	 * @access public
	 * @return void
	 */
	function order_detail(){
			// Breadcrumbs & Page Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->EE->cp->set_breadcrumb($this->base_url.'&method=order', lang('nav_br_order'));
				$this->vars['cp_page_title'] = lang('nav_br_order_detail');
			
			// Parameters
				$order_id = $this->EE->input->get("order_id");
				$print = $this->EE->input->get("print");

			// Order Information
				$this->vars["status"] 	= $this->_config["status"];			
				$this->vars["order"] 	= $this->EE->order_model->get_order($order_id,TRUE);

			// Pass the order id
				$this->vars["hidden"] = array('order_id' => $order_id);

			// Localize Created Date
				$this->vars["order"]["created"] = $this->EE->localize->format_date('%m/%d/%Y %h:%i:%s %a',$this->vars["order"]["created"]);

			// Localize Order Notes				
				
				foreach($this->vars["order"]["notes"] as $key => $val)
				{
					$this->vars["order"]["notes"][$key]["created"] = $this->EE->localize->format_date('%m/%d/%Y %h:%i:%s %a',$val["created"]);
				}
				
			// Create the order total
				$total = $this->_currency_round($this->vars['order']["total"]+$this->vars['order']["tax"]+$this->vars['order']["shipping"]);
				$this->vars['order']['order_total'] = $total; 
				
			// Figure out the payments
				$payment = 0;
				foreach($this->vars['order']['payment'] as $p){
					$payment += $p['amount'];
				}
				$this->vars['order']['order_total_paid'] 	= $this->_currency_round($payment);
				$this->vars['order']['order_total_due']		= $this->_currency_round($this->vars['order']['order_total']-$this->vars['order']['order_total_paid']);
			
			// Now that we have an order lets build some buttons
				if($this->vars['order']["order_total_due"] > 0){
					$this->vars['order']["right"][][lang('br_add_payment')] = array(	
																						'link' 		=> BASE.'&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_detail_add_payment&order_id='.$this->vars['order']["order_id"],
																						'target' 	=> ''
																					); 
				}
				
				$this->vars['order']["right"][][lang('br_print_packing_slip')] = array(	
																						'link' 		=> BASE.'&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_detail&order_id='.$this->vars['order']["order_id"].'&print=pack',
																						'target' 	=> '_blank'
																					);
				
				$this->vars['order']["right"][][lang('br_print_invoice')] = array(	
																						'link' 		=> BASE.'&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_detail&order_id='.$this->vars['order']["order_id"].'&print=true',
																						'target' 	=> '_blank'
																					);
			
			// Get the group names
				$qry = $this->EE->member_model->get_member_groups();
				$groups = array();
				foreach($qry->result_array() as $row){
					$groups[$row["group_id"]] = $row["group_title"];
				}

				$this->vars["groups"] = $groups;

            // Create the form actions 
                $this->vars["status_action"] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=brilliant_retail'.AMP.'method=order_update_status'.AMP.'order_id='.$order_id;
                $this->vars["note_action"]   = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=brilliant_retail'.AMP.'method=order_add_note';



			// If we are just showing a print view then we need to display 
			// the print view with a success header and exit
				if($print != ''){

                                    // Initiate a vars 
                                    $vars[0] = $this->vars['order'];
                                    $vars[0]["site_name"]	= $this->EE->config->item('site_name');
                                    $vars[0]["media_url"]	= $this->vars["media_url"];
                                    $vars[0]["email"]		= $vars[0]["member"]["email"];

                                    $has_notes = FALSE;
                                    foreach($vars[0]["notes"] as $key => $val){
                                            if($val["isprivate"] == 0){
                                                    $has_notes = TRUE;
                                                    break;
                                            }	
                                    }
                                    $vars[0]["has_notes"] = $has_notes;

                                    foreach($this->_config["store"][$this->site_id] as $key => $val)
                                    {
                                            $vars[0]["company"][0]["store_".$key] = $val;
                                    }

                                    // Logo must be absolute path
                                            $vars[0]["company"][0]["store_logo"] = $this->vars["media_url"].$vars[0]["company"][0]["store_logo"];

                                    $vars[0]['currency_marker'] = $this->vars["currency_marker"];

                                    // Add in the language keys we want

                                            foreach($this->EE->lang->language as $key => $val)
                                            {
                                                    $lang['lang:'.$key] = $val;
                                            }

                                    $vars[0] = array_merge($vars[0],$lang);

                                    foreach($vars[0]["payment"] as $key => $val)
                                    {
                                            $details = unserialize($val["details"]);
                                            unset($vars[0]["payment"][$key]["details"]);

                                            foreach($details as $k => $v)
                                            {
                                                    $vars[0]["payment"][$key]["details"][] = array('label'	=> lang(strtolower(str_replace(" ","_",$k))),
                                                                                                    'value'	=> $v	);
                                            }
                                    }
                                    foreach($vars[0]['items'] as $k => $item){                                        
                                        $vars[0]['items'][$k]['options']  = unserialize($item['options']);
                                    }


                                    // Get the invoice template 

                                    if($print == 'true'){
                                            // Invoice
                                                    $short_name = $this->EE->config->item("site_short_name");
                                                    $fl = PATH_THIRD.'_local/brilliant_retail/template/'.$short_name.'/invoice.html';
                                                    if(!file_exists($fl)){
                                                            $fl = PATH_THIRD.'brilliant_retail/core/template/invoice.html';
                                                    }
                                    }else{
                                            // Packing Slip
                                                    $short_name = $this->EE->config->item("site_short_name");
                                                    $fl = PATH_THIRD.'_local/brilliant_retail/template/'.$short_name.'/packing_slip.html';
                                                    if(!file_exists($fl)){
                                                            $fl = PATH_THIRD.'brilliant_retail/core/template/packing_slip.html';
                                                    }
                                    }					

					// Read the file into a variable
                                        $template = read_file($fl);
					
					// Parse the variables and then the output (for conditionals) 
					$output = $this->EE->TMPL->parse_variables($template, $vars);
					$this->EE->TMPL->parse($output);
	
                                        // Remove any runtime annotation. 
                                        $output = $this->EE->TMPL->parse_globals($output);

					// Add the print js
						header('Content-Type: text/html; charset=utf-8');
						$output = '<html><head><script type="text/javascript">this.print(true);</script></head><body>
									'.$output.'
									</body>
									</html>';
					
						echo $output;
						exit;
				}else{
					return $this->_view('order/detail', $this->vars);	
				}
		}

	/**
	 * order_detail_add_payment function.
	 * 
	 * @access public
	 * @return void
	 */
	function order_detail_add_payment(){
			// Parameters
				$order_id = $this->EE->input->get("order_id");

				$hidden = array('order_id' => $order_id);

			// Page title
				$this->vars['cp_page_title'] = lang('nav_br_order_detail_add_payment');
		
			// Add breadcrumb back to order detail
				$this->EE->cp->set_breadcrumb($this->base_url.'&method=order_detail&order_id='.$order_id, lang('nav_br_order_detail').' '.$order_id.'');
			
			// Order Information
				$this->vars["status"] = $this->_config["status"];			
				$this->vars['order'] = $this->EE->order_model->get_order($order_id);

			// Pass the order id
				$this->vars["hidden"] = array(
												'order_id' => $order_id
											);

			// Get the countries
				$this->vars["countries"] = $this->EE->product_model->get_countries();
				$this->vars["map"] 	= json_encode($this->EE->product_model->get_states($this->vars["countries"]));
					
			// Create the order total
				$total = $this->_currency_round($this->vars['order']["total"]+$this->vars['order']["tax"]+$this->vars['order']["shipping"]);
				$this->vars['order']['order_total'] = $total; 
				
			// Figure out the payments
				$payment = 0;
				foreach($this->vars['order']['payment'] as $p){
					$payment += $p['amount'];
				}
				$this->vars['order']['order_total_paid'] 	= $this->_currency_round($payment);
				$this->vars['order']['order_total_due']		= $this->_currency_round($total-$payment);
			
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=order_detail_add_payment_process';
			
			// Lets get our options
				$this->vars['order']["payment_options"] = $this->_payment_options(TRUE,$this->vars['order']["tax"],$this->vars['order']["shipping"],TRUE);
			
			return $this->_view('order/detail_add_payment', $this->vars);	
		}
		
	/**
	 * order_detail_add_payment_process function.
	 * 
	 * @access public
	 * @return void
	 */
	function order_detail_add_payment_process(){
            foreach($_POST as $key => $val){
                    $data[$key] = $this->EE->input->post($key);
            }

			// Order ID
				$order_id = $data["order_id"];
			
			// Lets make sure they posted an ammount
				if($data["order_amount"] <= 0){
					$_SESSION["alert"] = lang('br_order_payment_errror').': '.lang('br_payment_amount_error');
					$this->EE->functions->redirect($this->base_url.'&method=order_detail_add_payment&order_id='.$order_id);
				}

			// Lets get some info from the stored order
				$order = $this->EE->order_model->get_order($order_id);
			
				// Lets get all the order address stuff we need.

				$data["cart_tax"]		= $order["tax"];
				
				// Make sure the end user didn't try to pass an amount greater than
				// the total due. If so reset it to the order due.
					$data["order_total"] = ($data["order_amount"] > $data["order_total_due"]) ? $data["order_total_due"] : $data["order_amount"];
				
				// Lets get the shipping fields from the order:
					foreach($order["address"][0] as $key => $val){
						if(strpos($key,'shipping_') !== FALSE){
							$data['br_'.$key] = $val; #namespaced forms with br_ prefix
						}
					}
				// Process the payment
					$data["payment"] = $this->_process_payment($data,TRUE);
				
				// Lets deal with an error message from the gateway
					if(isset($data["payment"]["error"])){
						$_SESSION["alert"]= lang('br_order_payment_errror').': '.$data["payment"]["error"];
						$this->EE->functions->redirect($this->base_url.'&method=order_detail_add_payment&order_id='.$order_id);
					}

				$payment[0] = array(
										'order_id' => $order_id, 
										'transaction_id' => $data["payment"]["transaction_id"],
										'payment_type' => $data["payment"]["payment_type"],
										'details' => $data["payment"]["details"],
										'amount' => $this->_currency_round($data["payment"]["amount"]),
										'approval' => $data["payment"]["approval"],
										'created' => $this->EE->localize->now 
									);
			
				// Setup some email variables
					$vars[0] = $data;
					$vars[0]['email'] = $order["member"]['email'];
				
				$this->_send_email('admin-order-payment', $vars);

				$this->EE->order_model->create_order_payment($payment[0]);
			
				// Add a system note
					$message = str_replace('%x',$this->vars["currency_marker"].$this->_currency_round($data["payment"]["amount"]),str_replace('%y',$this->EE->session->userdata["username"],lang('br_order_payment_note_message')));
					$note = array(
								'order_note' 	=> $message,
								'created'		=> $this->EE->localize->now,
								'member_id'		=> 0,
								'order_id' 		=> $order_id, 
								'isprivate'		=> 2
							);
					$this->EE->order_model->create_order_note($note);
			
			$_SESSION["message"] = lang('br_order_payment_added');
			$this->EE->functions->redirect($this->base_url.'&method=order_detail&order_id='.$order_id);
		}		

	/**
	 * order_batch function.
	 * 
	 * @access public
	 * @return void
	 */
	function order_batch(){
			
			$data = array();
			if(version_compare(APP_VER, '2.7.0', '>=')){
				$this->EE->security->restore_xid();
			}
			
			$data["status_id"] = $this->EE->input->post('status_id');
			
			$batch = isset($_POST["batch"]) ? $_POST["batch"] : array() ;
			
			if(strpos($data["status_id"],'download_') > -1){
			
				$view = '';
				
				$this->vars["site_name"] = $this->EE->config->item('site_name');
				$this->vars["company"] = $this->_config["store"][$this->site_id];
				$this->vars["print_css"] = $this->_theme('css/print.css');
			
				$count = 0;
				
				
				// Get the invoice template 
					if($data["status_id"] == 'download_print'){
						// Invoice
							$short_name = $this->EE->config->item("site_short_name");
							$fl = PATH_THIRD.'_local/brilliant_retail/template/'.$short_name.'/invoice.html';
							if(!file_exists($fl)){
								$fl = PATH_THIRD.'brilliant_retail/core/template/invoice.html';
							}
					}else{
						// Packing Slip
							$short_name = $this->EE->config->item("site_short_name");
							$fl = PATH_THIRD.'_local/brilliant_retail/template/'.$short_name.'/packing_slip.html';
							if(!file_exists($fl)){
								$fl = PATH_THIRD.'brilliant_retail/core/template/packing_slip.html';
							}
					}					

				// Read the file into a variable
					$template = read_file($fl);

				foreach($batch as $key => $val){
					$this->vars['order'] = $this->EE->order_model->get_order($key,TRUE);
					
					// Create the order total
						$total = $this->_currency_round($this->vars['order']["total"]+$this->vars['order']["tax"]+$this->vars['order']["shipping"]);
						$this->vars['order']['order_total'] = $total; 

        			// Localize Created Date
        				$this->vars["order"]["created"] = $this->EE->localize->format_date('%m/%d/%Y %h:%i:%s %a',$this->vars["order"]["created"]);
        
        			// Localize Order Notes				
        				
        				foreach($this->vars["order"]["notes"] as $key => $val)
        				{
        					$this->vars["order"]["notes"][$key]["created"] = $this->EE->localize->format_date('%m/%d/%Y %h:%i:%s %a',$val["created"]);
        				}
        				
					// Figure out the payments
						$payment = 0;
						foreach($this->vars['order']['payment'] as $p){
							$payment += $p['amount'];
						}
						$this->vars['order']['order_total_paid'] 	= $this->_currency_round($payment);
						$this->vars['order']['order_total_due']		= $this->_currency_round($this->vars['order']['order_total']-$this->vars['order']['order_total_paid']);

					$vars[0] = array();
					
					$vars[0] = $this->vars['order'];
					$vars[0]["site_name"]	 	= $this->EE->config->item('site_name');
					$vars[0]["media_url"]		= $this->vars["media_url"];
					$vars[0]["email"]			= $vars[0]["member"]["email"];
					$vars[0]["created"] = $this->EE->localize->format_date('%m/%d/%Y %h:%i:%s %a',$vars[0]["created"]);
					
					$has_notes = FALSE;
					foreach($vars[0]["notes"] as $note){
						if($note["isprivate"] == 0){
							$has_notes = TRUE;
							break;
						}	
					}
					$vars[0]["has_notes"] = $has_notes;
					
					foreach($this->_config["store"][$this->site_id] as $key => $val)
					{
						$vars[0]["company"][0]["store_".$key] = $val;
					}
					
					// Logo must be absolute path
						$vars[0]["company"][0]["store_logo"] = $this->vars["media_url"].$vars[0]["company"][0]["store_logo"];

					$vars[0]['currency_marker'] = $this->vars["currency_marker"];
					
					// Add in the language keys we want
						
						foreach($this->EE->lang->language as $key => $val)
						{
							$lang['lang:'.$key] = $val;
						}

						$vars[0] = array_merge($vars[0],$lang);
					
						foreach($vars[0]["payment"] as $key => $val)
						{
							$details = unserialize($val["details"]);
							unset($vars[0]["payment"][$key]["details"]);
							
							foreach($details as $k => $v)
							{
								$vars[0]["payment"][$key]["details"][] = array(
																				'label'	=> lang(strtolower(str_replace(" ","_",$k))),
																				'value'	=> $v
																				);
							}
						}
					
					// Parse the variables and then the output (for conditionals) 
						
						if($count==1){
							// on the second iteration we are going to remove all 
							// of the style tags since we already have them in the 
							// document. 
								$a = explode("</style>",$template);
								$template = $a[1];
						}
						
						$output = $this->EE->TMPL->parse_variables($template, $vars);
						$this->EE->TMPL->parse($output);
					
		                // Remove any runtime annotation. 
                            $output = $this->EE->TMPL->parse_globals($output);
	
						$view .= $output;
					
					// Break each page except the last
						if($count!=count($_POST["batch"])-1){
							$view .= '<div style="page-break-before: always;"></div>';
						}	
					$count++;
				}
				$js = '<script type="text/javascript">this.print(true);</script>';
				header('Content-Type: text/html; charset=utf-8');
				echo '<html><head>'.$js.'</head><body>'.$view.'</body></html>';
				exit;
			}
			// Are we going to notify
				if(isset($_POST["notify"])){
					$data["notify"] = 'on';
				}
			
				foreach($batch as $key => $val){
					$data["order_id"] = $key;
					
					// Update the order status
						$this->order_update_status($data,FALSE);
				}
				
				$this->EE->functions->redirect($_SERVER["HTTP_REFERER"]);
		}
		
	/**
	 * order_update_status function.
	 * 
	 * @access public
	 * @param string $data (default: '')
	 * @param mixed $redirect (default: TRUE)
	 * @return void
	 */
	function order_update_status($data='',$redirect=TRUE){

			// Are we coming from a form post or 
			// from the batch process? Batch passes 
			// the data in a variable. Form sends it
			// as a $_POST. 
			if($data == ''){
				foreach($_POST as $key => $val){
					$data[$key] = $this->EE->input->post($key);
                }
			}
			// Is the notify flag set?
                        $notify = FALSE;
                        if(isset($data["notify"])){
                                if(strtolower($data["notify"]) !== 'false' ){
                                        $notify = TRUE;
                                        unset($data["notify"]);
                                }
                        }
				
			// Update the order status		
				$tracknum = @$data['tracknum'];
				unset($data['tracknum']);
				
				if ($tracknum){
					$this->EE->db->where('order_id',$data['order_id']);
					$this->EE->db->update('br_order_ship',array('tracknum' => $tracknum));
				}
				
				// Hook before we update the order
					if($this->EE->extensions->active_hook('br_order_update_before') === TRUE){
						$data = $this->EE->extensions->call('br_order_update_before', $data); 
					}

					$this->EE->order_model->update_order_status($data);
									
				// Hook after we update the order
					if($this->EE->extensions->active_hook('br_order_update_after') === TRUE){
						$data = $this->EE->extensions->call('br_order_update_after', $data); 
					}

				$tmp = $this->EE->order_model->get_order($data["order_id"]);
			
			// Do we notify the user?
				if($notify == TRUE){
					$eml[0]["email"] = $tmp["member"]["email"];
					$eml[0]["order_id"] = $data["order_id"];
					$eml[0]["order_status"] = $this->_config["status"][$data["status_id"]];
                    $eml[0]["tracknum"] = $tracknum;
					foreach($tmp["member"] as $key => $val){
						if(substr($key,0,3) == 'br_'){
							$eml[0][str_replace("br_","",$key)] = $val;
						}
					}
					$this->_send_email('customer-order-status', $eml);
				}

			// Add a system note to the order
				$note = array(
							'order_note' 	=> lang('br_order_status_updated_to').' '.$this->_config["status"][$data["status_id"]],
							'created'		=> time(),
							'member_id'		=> 0,
							'order_id' 		=> $data["order_id"], 
							'isprivate'		=> 2
						);
				$this->EE->order_model->create_order_note($note);	
				
			// Set the message and relocate	
				$_SESSION["message"] = lang('br_order_status_success');
			
			// Redirect if set to TRUE
				if($redirect === TRUE)
				{
					$this->EE->functions->redirect($_SERVER["HTTP_REFERER"]);
					exit();
				}
		}
		
	/**
	 * order_add_note function.
	 * 
	 * @access public
	 * @return void
	 */
	function order_add_note(){
            // Only allow these POST variables
            $allowed = array('order_id',
                             'order_note',
                             'isprivate',
                             'order_note_notify'
                                );
            // Put the POST in a data array			
            foreach($_POST as $key => $val){
                if(in_array($key,$allowed)){$data[$key] = $this->EE->input->post($key);}
            }

            if(isset($_FILES)){
                    $attachment = $this->vars["media_dir"].'attachments';
                    if(!file_exists($attachment)){
                            mkdir($attachment,DIR_WRITE_MODE,TRUE);
                    }
                    $config['upload_path'] 	= $attachment;
                    $config['allowed_types'] = $this->_config["allowed_filetypes"];
                    $this->EE->load->library('upload',$config);
                    if($this->EE->upload->do_upload('order_note_file')){
                            $result = array('upload_data' => $this->EE->upload->data()); 
                            $data["filenm"] = $result["upload_data"]["file_name"];
                    }
            }
			
    // Get Order Details
            $tmp = $this->EE->order_model->get_order($data['order_id']);
    // Did we specify User Notification?
            $notify = FALSE;
            if(isset($data['order_note_notify'])){
                    $notify = TRUE;
                    unset($data['order_note_notify']);
            }
    // lets notify
            if($notify == TRUE){
                    $eml[0]['email'] 		= $tmp['member']['email'];
                    $eml[0]['order_id'] 	= $data['order_id'];
                    $eml[0]['order_note'] 	= nl2br($data['order_note']);
                    $eml[0]['fname'] 		= $tmp['member']['br_fname'];
                    $this->_send_email('customer-order-note', $eml);
            }
            unset($data['order_note_notify']);

    // Create the note
            $data['member_id'] = $this->EE->session->userdata['member_id'];
            $data['created'] = time();
            $this->EE->order_model->create_order_note($data);
    // Message and relocate
            $_SESSION['message'] = lang('br_order_add_note_success');
            $this->EE->functions->redirect($this->base_url.AMP.'method=order_detail'.AMP.'order_id='.$data['order_id']);
	}
		
	/**
	 * order_remove_note function.
	 * 
	 * @access public
	 * @return void
	 */
	function order_remove_note(){
			// Get the parameters 
				$order_id 		= $this->EE->input->get('order_id'); 
				$order_note_id 	= $this->EE->input->get('note_id');
			// Remove it 
				$this->EE->order_model->remove_order_note($order_note_id);
			// Message and redirect
				$_SESSION["message"] = lang('br_order_remove_note_success');
				$this->EE->functions->redirect($this->base_url.AMP.'method=order_detail'.AMP.'order_id='.$order_id);
		}
				
	/************************/
	/* Customer Tab		 	*/
	/************************/
	
	/**
	 * customer function.
	 * 
	 * @access public
	 * @return void
	 */
	function customer(){
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_customer');

			// ajax url to get customer_collection from data tables
				$this->vars["ajax_url"] = $this->base_url.AMP.'method=customer_ajax';
			
			return $this->_view('customer/customer', $this->vars);	
		}
		
	/**
	 * customer_ajax function.
	 * 
	 * @access public
	 * @return void
	 */
	function customer_ajax(){
			// Member Collection	
				$members = $this->EE->customer_model->get_customers('',$_GET["iDisplayLength"],$_GET["iDisplayStart"],$_GET["sSearch"],$_GET["iSortCol_0"],$_GET["sSortDir_0"]);
			
			// Container for member rows
				$member = array();
				foreach ($members["results"] as $row){
					if($row["customer"] == ''){
						$row["customer"] = '('.lang('empty').')';
					}
					$member[] = array(	'<a href="'.BASE.'&C=myaccount&id='.$row["member_id"].'">'.$row["customer"].'</a>',
										'<a href="mailto:'.$row["email"].'">'.$row["email"].'</a>',
										date("n/d/Y",$row["join_date"]), 
										$row["group_title"],
										number_format($row["total"],2),
										'<a href="'.BASE.'&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=customer_orders&memberid='.$row["member_id"].'">'.lang('view').'</a>'
									);
				}
			// Build the response array
				$output = array(
									"sEcho" => $_GET["sEcho"],
									"iTotalRecords" => $members["total"],
									"iTotalDisplayRecords" => $members["displayTotal"],
									"aaData" => $member  
								);
			// Return the json data 
				@header("HTTP/1.1 200 OK");
				echo json_encode($output);
				exit();
		}
		
	/**
	 * customer_orders function.
	 * 
	 * @access public
	 * @return void
	 */
	function customer_orders(){
			// Parameters
				$member_id = $this->EE->input->get('memberid');

			$this->vars['cp_page_title'] = lang('nav_br_customer_orders');
			
			// Get the order collection
				$query = $this->EE->order_model->get_order_by_member($member_id);
				
				if(count($query)==0){
					$this->vars['order_collection']=array();
					$this->vars['member_info']='Customer';
				}else{
					$this->vars['member_info'] = $query[0]['member']['br_fname'].' '.$query[0]['member']['br_lname'];
				}
			
				foreach ($query as $row){
					$line_items='';
					foreach($row['items'] as $item){
						$line_items .= $item['quantity'].' x '.$item['title'].' (SKU: '.$item['sku'].')<br />';
					}
				
					$this->vars['order_collection'][] = array(
																'order_id' 		=> $row["order_id"],
																'created' 		=> $row['created'],
																'line_items' 	=> $line_items,
																'total' 		=> $this->_currency_round($row["base"]+$row["shipping"]+$row["tax"]-$row["discount"]),
																'status'		=> $this->_config["status"][$row["status_id"]] 
															);
				}
			
			return $this->_view('customer/customer_orders', $this->vars);	
		}	 

	/************************/
	/* Product Tab		 	*/
	/************************/
	
	/**
	 * product function.
	 * 
	 * @access public
	 * @return void
	 */
		function product()
		{
			// Set the parameters 
				$_SESSION["catid"] 	= $this->EE->input->get("cat_id");
				$_SESSION["typeid"] = $this->EE->input->get("type_id");
				
				$this->vars['cp_page_title'] = lang('nav_br_products');
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));

			// Get the categories & product types for filtering
				$this->vars['categories'] 	= $this->EE->product_model->get_all_categories();
				$this->vars['product_type'] = $this->_config['product_type'];	
				
				$this->vars['catid'] 		= $_SESSION["catid"];
				$this->vars['typeid'] 		= $_SESSION["typeid"];

			// Add the create product button
				$this->EE->cp->set_right_nav(array(
					'br_new_product' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=product_new'
				));
			
			// Add the ajax url
				$this->vars["ajax_url"]   = $this->base_url.AMP.'method=product_ajax';
		
            // Form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=product_batch';

			$output = $this->_view('product/product', $this->vars);
			return $output;
		}

	/**
	 * product_ajax function.
	 * 
	 * @access public
	 * @return void
	 */
		function product_ajax()
		{
			// Pass in the db prefix for advanced sql statements
				$prefix = $this->EE->db->dbprefix;
			
			// Get product collection 
				$products = $this->EE->product_model->get_product_collection($_GET["sSearch"],$_GET["iDisplayLength"],$_GET["iDisplayStart"],$_GET["iSortCol_0"],$_GET["sSortDir_0"],$_SESSION["catid"],$_SESSION["typeid"]);
				
			// setup the return array 
				$row = array();
				$i = 0;
				foreach($products["results"] as $p){
					$entry_id = $this->_product_entry_id($p["product_id"]);
					$enabled = ($p['enabled'] == 1) ? lang('br_enabled') : lang('br_disabled');
					$row[] = array(	$p['product_id'],$p['sort_order'],
									'<a href="'.$this->vars["base_url"].'&method=product_edit&product_id='.$p['product_id'].'&channel_id='.$this->br_channel_id.'&entry_id='.$entry_id.'">'.$p['title'].'</a>',                                                                        
									$p['sku'],
									$p['quantity'],
									$this->vars["product_type"][$p['type_id']],
									'<span class="order_status_'.$p['enabled'].'">'.$enabled.'</span>',
									'<input type="checkbox" name="batch['.$p['product_id'].']" style="text-align:center" />');
				}
				$output = array(
								"sEcho" => $_GET["sEcho"],
								"iTotalRecords" => $products["total"],
								"iTotalDisplayRecords" => $products["displayTotal"],
								"aaData" => $row 
							);
			// Return the json data 
				@header("HTTP/1.1 200 OK");
				echo json_encode($output);
				exit();
		}
		
	/**
	 * product_batch function.
	 * 
	 * @access public
	 * @return void
	 */
		function product_batch()
		{
			foreach($_POST as $key => $val){
				$data[$key] = $this->EE->input->post($key);
			}
			
			if(isset($data["batch"])){
				if($data["action"] == 0){
					// Delete Products 
						foreach($data["batch"] as $key => $val){
							// delete this product
								$this->EE->product_model->delete_product($key);
							// fire the delete hook
								$data["product_id"] = $key;
								if($this->EE->extensions->active_hook('br_product_delete') === TRUE){
									$data = $this->EE->extensions->call('br_product_delete', $data); 
								}
							// Log it
								$this->EE->logger->log_action("Product #".$key." deleted by ".$this->EE->session->userdata["username"]." (member_id: ".$this->EE->session->userdata["member_id"].")");
								#$this->_index_delete_product($data["product_id"]);
							remove_from_cache('product_'.$key);
						}
						$_SESSION["message"] = lang('br_product_delete_success');

				}elseif($data["action"] == 1){
					
					// Enable Products 
						foreach($data["batch"] as $key => $val){
							$this->EE->product_model->update_product_status($key,1);
							$this->EE->logger->log_action("Product #".$key." enabled by ".$this->EE->session->userdata["username"]." (member_id: ".$this->EE->session->userdata["member_id"].")");
							remove_from_cache('product_'.$key);
						}
						$_SESSION["message"] = lang('br_product_update_success');

				}elseif($data["action"] == 2){

					// Disable Products
						foreach($data["batch"] as $key => $val){
							$this->EE->product_model->update_product_status($key,0);
							$this->EE->logger->log_action("Product #".$key." disabled by ".$this->EE->session->userdata["username"]." (member_id: ".$this->EE->session->userdata["member_id"].")");
							remove_from_cache('product_'.$key);
						}
						$_SESSION["message"] = lang('br_product_update_success');
				}
				
			}
			$this->EE->functions->redirect($this->base_url.'&method=product');
		}
		
	/**
	 * product_new function.
	 * 
	 * @access public
	 * @return void
	 */
		function product_new(){
			return $this->product_edit();	
		}
		
	/**
	 * product_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function product_edit()	{			
			$this->EE->cp->set_breadcrumb($this->base_url.'&method=product', lang('nav_br_products'));

			// Load Resources Required for custom fields
				$this->EE->lang->loadfile('content');
				$this->EE->load->library('api'); 
				$this->EE->api->instantiate('channel_fields');
				$this->EE->api->instantiate('channel_entries');
				$this->EE->load->library('filemanager');
				$this->EE->load->library('spellcheck');
				$this->EE->load->library('file_field');
				$this->EE->load->model('channel_model');
				$this->EE->load->helper(array('snippets','typography', 'spellcheck'));
				
				$this->EE->file_field->browser();
				$this->EE->cp->get_installed_modules();
				
				// Load channel data
					$this->_channel_data = $this->_load_channel_data($this->br_channel_id);

				// Setup the file list for custom fields
					$this->_setup_file_list();
					$this->vars["file_list"] = $this->_file_manager['file_list'];

				$this->EE->cp->add_js_script( array(
												'ui'	 => array('datepicker', 'resizable', 'draggable', 'droppable'),
												'plugin' => array('markitup', 'toolbox.expose', 'overlay', 'tmpl', 'ee_url_title'),
												'file'	=> array('json2', 'cp/publish', 'cp/publish_tabs')
											));

			// Set the Breadcrumb
				$this->EE->cp->set_breadcrumb($this->base_url.'&method=product', lang('nav_br_products'));

			// Lets setup a new product flag. If we are going to edit the product flip 
			// to FALSE so that we can differeniate in certain places when needed. 
				$new_product 	= TRUE;
				$product_id 	= 0;
				$entry_id 		= 0;

			// Get the upload preferences  
				$this->EE->load->model('tools_model');
				$this->_get_upload_preferences($this->EE->session->userdata('group_id'),$entry_id);	
				
			// If we were passed a GET product_id and entry_id then 
			// we are editind
				if(isset($_GET["product_id"]) && isset($_GET["entry_id"])){
					$new_product = FALSE;
					$product_id = $_GET["product_id"];
					$entry_id 	= $_GET["entry_id"];
				}
			
			// Custom Channel Fields
			
				$this->vars["custom"] = array();
					
			// Setup some helpers
				$this->vars["spell_enabled"] 	= TRUE;
				$this->vars["smileys_enabled"] 	= (isset($this->EE->cp->installed_modules['emoticon']) ? TRUE : FALSE);
				if ($this->vars["smileys_enabled"]){
					$this->EE->load->helper('smiley');
					$this->EE->cp->add_to_foot(smiley_js());
				}
	
			// Glossary Items
				$this->vars['glossary_items'] = $this->EE->load->ee_view('content/_assets/glossary_items', '', TRUE);

			// Set the global javascript (Content Publish Method) 	
				$this->_set_global_js($entry_id);
			
			
			// Get current data if its an edit
			
				$data = array();
				
				if($new_product == FALSE){
					// Get the data for the entry_id 	
						$prefix = $this->EE->db->dbprefix;
						$sql = "SELECT 
									d.* 
								FROM 
									".$prefix."br_product_entry p, 
									".$prefix."channel_data d 
								WHERE 
									p.entry_id = d.entry_id 
								AND 
									p.product_id = ".$product_id;
							$qry = $this->EE->db->query($sql);
							$result = $qry->result_array();
							
							// Data array holds the field data 
							// in field_id_# key => val format
								$data = $result[0];
				}

			// Get the fields for the channel
				
				$fields = $this->EE->api_channel_fields->setup_entry_settings($this->br_channel_id,$data,FALSE);
				
			// Build the inputs 
				
				$fields = $this->_prep_field_wrapper($fields);

				// Now that we support RTE lets load up the required js.
					if(version_compare(APP_VER, '2.5', '>=')){
						$rte_js = 	$this->EE->functions->fetch_site_index().QUERY_MARKER
									.'ACT='.$this->EE->cp->fetch_action_id('Rte', 'get_js')
									.'&amp;toolset_id=0'
									.'&amp;cp=y'
									.'&amp;selector='.urlencode(".rte");
						$this->EE->cp->add_to_foot('<script type="text/javascript" src="'.$rte_js.'"></script>');
						$this->EE->cp->add_to_head('<link href="'.$this->EE->config->item('theme_folder_url').'cp_themes/default/css/rte.css" rel="stylesheet" media="all" />');
					}

				$i = 0;
				foreach($fields as $f){
					if(isset($f["field_name"])){
						$this->EE->api_channel_fields->set_settings($f["field_type"],$f);
						$this->EE->api_channel_fields->setup_handler($f["field_id"]);
						
						// Either put in existing data or nothing on new product
							$param[0] = ($new_product == FALSE) ? $data["field_id_".$f["field_id"]] : "";
							
							// Hack added to deal with double encoding issue 
							// from rte. Yuck but what can you do? - dpd 
								$param[0] = form_prep($param[0], "field_id_".$f["field_id"]);
							
							$this->vars["custom"][$i] = array(
															'settings' 		=> $f,
															'display_field' => $this->EE->api_channel_fields->apply('display_field', $param)
															);
							$i++;
					}
				}

				if($new_product == FALSE){
					$this->vars['cp_page_title'] = lang('br_product_edit').' ['.$product_id.']';
				}else{
					$this->vars['cp_page_title'] = lang('nav_br_products');
				}

			// Generate the list of products based 
			// on the search terms provided. 
			
			// Get the products 
			
			if($new_product == FALSE){				
				$products = $this->EE->product_model->get_products($product_id,1);
				
				// Since we are now allowing product type changing 
				// we need to set some defaults on the edit form as 
				// well. We should probably match both instances (new/edit) 
				// but lets just get it started to test it out. -dpd
					if(!isset($products[0]["donation"][0]))	{
						// some defaults for donations 
							$products[0]["donation"][0] = array('min_donation' 			=> 10,
																'allow_recurring' 		=> 0
																);
					}

				// We know the type
					$fields = array();
					
					$values = '<tr>';					
					if(isset($products[0]["configurable"])){
						foreach($products[0]["configurable"] as $c){
							foreach($c["attribute"] as $val){
								$fields[$val["attribute_id"]] = $val["attribute_id"];
								// build the configurable attributes into the row
								$values .= '<td><input type="hidden" name="config_attr_'.$val["attribute_id"].'[]" value="'.$val["option_id"].'" />'.$this->_option_to_label($val["option_id"]).'
                                                                            </td>';
							}

							// Basic inputs
							
							$values .= '	<td>
												<input type="text" name="config_sku[]" value="'.$c["sku"].'" /></td>
											<td>
												<input type="number" max="10000000" name="config_qty[]" value="'.$c["qty"].'" /></td>
											<td>
												<select style="display:none" name="config_adjust_type[]">';
			
												$sel = ($c["adjust_type"] == 'fixed') ? 'selected="selected"' : '' ;
													$values .= '<option '.$sel.'>fixed</option>';
												$sel = ($c["adjust_type"] == 'percent') ? 'selected="selected"' : '' ;
													$values .= '<option '.$sel.'>percent</option>';
			
							$values .= '		</select>
												<input type="number" name="config_adjust[]" value="'.$c["adjust"].'" /></td>
											<td class="move_config_row">
												<img src="'.$this->_theme('images/move.png').'" /></td>
											<td>
												<input type="hidden" name="config_configurable_id[]" value="'.$c["configurable_id"].'" />
												<a href="#" class="config_item_remove"><img src="'.$this->_theme('images/delete.png').'" alt="'.lang('br_delete').'" /></a></td>
										</tr>';
						}
					}	
					
					// if its configurable 
                    if($products[0]["type_id"] == 3){
                            $this->vars["config_products"] = $this->_build_configurable_form($fields,$values);
                    }	
					
					$product_feeds = $this->EE->product_model->get_feed_id_by_product($product_id);
			
                                        if($products[0]["sale_start"] == '0000-00-00 00:00:00'){
                                                $products[0]["sale_start"] = '';
                                        }else{
                                                if($products[0]["sale_start"] != null){
                                                        $products[0]["sale_start"] = date("m/d/y",strtotime($products[0]["sale_start"]));
                                                }
                                        }

                                        if($products[0]["sale_end"] == '0000-00-00 00:00:00'){
                                                $products[0]["sale_end"] = '';
                                        }else{
                                                if($products[0]["sale_end"] != null){
                                                        $products[0]["sale_end"] = date("m/d/y",strtotime($products[0]["sale_end"]));
                                                }
                                        }
			
                                $this->vars['product_feeds'] 	= $product_feeds;
                                $this->vars['products'] 	= $products;
                                $this->vars["title"] 		= $products[0]["title"];
                                $this->vars["hidden"] 		= array('site_id' 	=> $this->site_id,
                                                                        'type_id' 	=> $products[0]["type_id"], 
                                                                        'product_id' 	=> $products[0]["product_id"],
                                                                        'entry_id'	=> $entry_id  
                                                                        );
			
			// Get the available member groups
				$qry = $this->EE->member_model->get_member_groups();
				$groups = array();
				foreach($qry->result_array() as $row){
					$groups[] = $row;
				}
				$this->vars["groups"] = $groups;
			
                                if($this->vars['products'][0]['type_id'] != 3){
                                        $this->vars["config_opts"] = $this->EE->product_model->get_attribute_config();
                                        $this->vars["config_opts_link"] =  $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_configurable_create_options');
                                }

                                // Experimental! 
                                //
                                // This will allow you to switch the product type on the edit 
                                // form? -dpd 
                                // 
				if($this->EE->config->item('br_product_edit_type') === TRUE){
					$options = '<select id="type_id" name="type_id">';
					foreach($this->vars['product_type'] as $key => $val){
						$sel = ($products[0]['type_id'] == $key) ? 'selected' : ''; 
						$options .= '<option value="'.$key.'" '.$sel.'>'.$val.'</option>';
					}
					$options .= '</select>';
					
					$this->vars["type"] = $options;
					$this->vars["sub_type"] = $this->_get_sub_type($this->vars['products'][0]['type_id'],TRUE);
				}else{
					$this->vars["type"] = $this->_config['product_type'][$this->vars['products'][0]['type_id']];
					$this->vars["sub_type"] = $this->_get_sub_type($this->vars['products'][0]['type_id']);
				}

                                $this->vars["attrs"] = $this->_product_attrs($this->vars['products'][0]["attribute_set_id"],$this->vars['products'][0]["product_id"]);
                                $this->vars["attribute_sets"] = $this->EE->product_model->get_attribute_sets();
                                $this->vars['add_attributes'] = $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_add_atributes');
                                $this->vars["options"] = $this->_product_options($this->vars['products'][0]["product_id"]);
			
                                // Get the images 
				$images = $this->EE->product_model->get_product_images($this->vars['products'][0]["product_id"],FALSE);
				// Remove the large / thumb values
					unset($images["image_large"]);
					unset($images["image_large_title"]);
					unset($images["image_thumb"]);
					unset($images["image_thumb_title"]);
					
					$this->vars["images"] = $images;
			
                                // Get Categories
			
				// First get the categories that 
				// apply to this product 
					$selected = $this->EE->product_model->get_category_list($this->vars['products'][0]["product_id"]);

				// Get them all 
					$cat = $this->EE->product_model->get_categories(0);
			
				// Create a tree 
					$categories = lang('br_no_product_categories');
					if(isset($cat[0])){
						$categories = $this->_product_category_tree($cat[0],$cat,0,$selected);
					}
					
					$this->vars["categories"] = $categories;			

			}else{
				// Build an empty product shell 
					$p = new Product();
					$products = $p->createshell();
					$this->vars["products"] = $products;
					$this->vars['product_feeds'] = array();

						// Generate the list of products based 
						// on the search terms provided. 
						$this->vars["type_id"] = 0;
						
						// Set the type options 
							$options = '<select id="type_id" name="type_id">';
							foreach($this->vars['product_type'] as $key => $val){
								$options .= '<option value="'.$key.'">'.$val.'</option>';
							}
							$options .= '</select>';
							
							$this->vars["type"] = $options;
							// member groups for the price matrix
								$qry = $this->EE->member_model->get_member_groups();
								$groups = array();
								foreach($qry->result_array() as $row){
									$groups[] = $row;
								}
								$this->vars["groups"] = $groups;
		
							// some defaults for configurable products 
								$this->vars["config_opts"] = $this->EE->product_model->get_attribute_config();
								$this->vars["config_opts_link"] =  $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_configurable_create_options');
		
							// some defaults for donations 
								$this->vars["products"][0]["donation"][0] = array(
																					'min_donation' 			=> 10,
																					'allow_recurring' 		=> 0
																				);
							// get the sub_type	
								$this->vars["sub_type"] = $this->_get_sub_type();
							
						// No Attributes by default				
						$this->vars["attribute_sets"] = $this->EE->product_model->get_attribute_sets();
						$this->vars['add_attributes'] = $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_add_atributes');
						$this->vars["attrs"] = '';
						$this->vars["options"] = array();
						$this->vars["images"] = array();
						
						$this->vars['title'] 	= lang('br_new_product');
						$this->vars['hidden'] 	= array(
															'site_id' => $this->site_id,
															'product_id' => 0,
															'type_id' => 0 
														);
							// Get Categories
				
								$cat = $this->EE->product_model->get_categories(0);
								
							// Create a tree 
								if(isset($cat[0])){
									$categories = $this->_product_category_tree($cat[0],$cat,0);
								}else{
									$categories = array();
								}
								$this->vars["categories"] = $categories;
			}
			
			// What editor should we use for the detail field
            $this->EE->load->library('product_form');
            $this->vars["detail_field"] = $this->EE->product_form->select_editor($products[0]["detail"]);		
            $this->vars["detail_id_field"] = $this->EE->product_form->select_editor($products[0]["detail_id"],'_id');		

			$this->_markitup();

			$this->vars['feeds'] = $this->EE->feed_model->get_feeds();

			$this->vars["tab"]["main"] 			= $this->_view('product/tabs/main', $this->vars);
			$this->vars["tab"]["detail"] 		= $this->_view('product/tabs/detail', $this->vars);
			
			// Include the attributes unless they were hidden
				if($this->EE->config->item('br_product_hide_attribute') !== TRUE){
					$this->vars["tab"]["attributes"] 	= $this->_view('product/tabs/attributes', $this->vars);
				}
			// Include the options unless they were hidden
				if($this->EE->config->item('br_product_hide_option') !== TRUE){
					$this->vars["tab"]["option"] 		= $this->_view('product/tabs/option', $this->vars);
				}
			// Include the images unless they were hidden
				if($this->EE->config->item('br_product_hide_image') !== TRUE){
					$this->vars["tab"]["image"] 		= $this->_view('product/tabs/image', $this->vars);
				}
			
			$this->vars["tab"]["price"] 		= $this->_view('product/tabs/price', $this->vars);
			$this->vars["tab"]["sale_price"] 	= $this->_view('product/tabs/sale_price', $this->vars);
			$this->vars["tab"]["category"] 		= $this->_view('product/tabs/category', $this->vars);
			#$this->vars["tab"]["addon"] 		= $this->_view('product/tabs/addon', $this->vars);

			// Include the related products unless they were hidden
            if($this->EE->config->item('br_product_hide_related') !== TRUE){
                $this->vars["tab"]["related"] 		= $this->_view('product/tabs/related', $this->vars);
            }
			
			$this->vars["tab"]["seo"] 			= $this->_view('product/tabs/seo', $this->vars);
			
			// Include the product feed unless they were hidden
            if($this->EE->config->item('br_product_hide_feed') !== TRUE){
                $this->vars["tab"]["feed"] 			= $this->_view('product/tabs/feed', $this->vars);	
            }
	
			// Want to do something to the edit form before we show it to the world? 
			// Added 1.1.5.0 DPD
			if($this->EE->extensions->active_hook('br_product_editform_before') === TRUE){
				$this->vars = $this->EE->extensions->call('br_product_editform_before', $this->vars); 
			}
			
			$this->EE->javascript->compile();

            // Set the form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=product_update';

			return $this->_view('product/edit', $this->vars);	
		}
	
		function product_add_atributes()
		{
			$set_id = $this->EE->input->get('set_id');
			$product_id = $this->EE->input->get('product_id');

			$attr = $this->_product_attrs($set_id,$product_id);			
			$i = 0;

			foreach($attr as $a){
				$req = ($a["required"] == 1) ? ' *' : '';
				echo '	<tr>
							<td>';
				if($i==0){
					echo '<input type="hidden" name="attribute_set_id" value="'.$set_id.'" />';
					$i++;
				}
					echo $a['title'].$req.'</td><td>'.$a['input'].'
							</td>
						</tr>';
			}
			exit();
		}
		
		function product_update($data='',$redirect=TRUE)
		{
				if($data == ''){
					// Clean up the post
					foreach($_POST as $key => $val){
						$data[$key] = $this->EE->input->post($key);
					}
				}

				$continue = FALSE; // Go back to the product after update?
				
				if(isset($data["entry_id"])){
					$entry_id = $data["entry_id"];
					unset($data["entry_id"]);
				}else{
					$entry_id = 0;
				}
				
			
			// Check for delete
				if(isset($data["delete"])){
					// Delete the product
					$this->EE->product_model->delete_product($data["product_id"]);
					
					// Remove the feed entries
					$this->EE->product_model->remove_product_from_feed($data['product_id']);
			
					if($this->EE->extensions->active_hook('br_product_delete') === TRUE){
						$data = $this->EE->extensions->call('br_product_delete', $data); 
					}
					
					// Reindex the products
						#$this->_index_delete_product($data["product_id"]);
					remove_from_cache('product_'.$data["product_id"]);
					
					$_SESSION["message"] = lang('br_product_delete_success');
					$this->EE->functions->redirect($this->base_url.AMP.'method=product');
				}
			
			if(isset($data["duplicate"])){
				unset($data["duplicate"]);
				$data["product_id"] = 0;
				$data["title"] .= ' [copy]';
				$data["url"] .= '-copy';
				$continue = TRUE;
			}
			
			if(isset($data["save_continue"])){
				$continue = TRUE;
				unset($data["save_continue"]);
			}elseif(isset($data["save"])){
				$continue = FALSE;
				unset($data["save"]);
			}
			
			// Clean up the SKU and sure it is unique
				$data["sku"] = $this->_check_product_sku($data);
			
			// Clean up the product url and make sure its unique
				$data["url"] = $this->_check_product_url($data);

			// Check For Custom Fields
			
				$this->EE->load->library('api'); 
				$this->EE->api->instantiate('channel_fields');
				$this->EE->api->instantiate('channel_entries');
			
			// Lets play with adding custom channel fields to BR
				
				$prefix = $this->EE->db->dbprefix;

				// Get the fields for the channel
					$fields = $this->EE->api_channel_fields->setup_entry_settings($this->br_channel_id,array(),FALSE);
					
				// Setup the list of custom fields that were posted in		
					$id = array();
					
					foreach($data as $key => $val){
						if(	substr($key,0,6) == 'field_'){
							$a = explode("_",$key);
							// key 2 holds the id number
							// key 1 holds the type (id or ft) 
								$id[$a[2]][$a[1]] = $val;
						}
					}
				
				// New Product 
					if($data["product_id"] == 0){
						// We'll create the new channel entry 
						$entry = array(
						        		'title'         => $data["title"],
						       			'url_title' 	=> $data["url"],
						       			'entry_date'    => time(),
						       			'channel_id' 	=> $this->br_channel_id 
										);

						$entry["status"]		= ($data["enabled"] == 1) ? 'open' : 'closed';

						// Default the fields
							foreach($fields as $f){
								if(isset($f["field_name"])){
									$entry["field_id_".$f["field_id"]] = "";
									$entry["field_ft_".$f["field_id"]] = $f["field_fmt"];
								}	
							}
						
						// Add the field_id and field_ft values
							foreach($id as $key => $val){
								$entry["field_id_".$key] = $val["id"];
								$entry["field_ft_".$key] = $fields["field_id_".$key]["field_fmt"];
							}
						
						if($this->EE->api_channel_entries->submit_new_entry($this->br_channel_id,$entry)){
							$qry 		= $this->EE->db->query("SELECT entry_id FROM ".$prefix."channel_titles ORDER BY entry_id DESC LIMIT 1");
							$result 	= $qry->result_array();
							$entry_id 	= $result[0]["entry_id"];
						}
						
					}

				// Check for custom fields
					$_POST["title"]		= $data["title"];
					$_POST["url_title"]	= $data["url"];
					$_POST["entry_id"] 	= $entry_id;
					$_POST["channel_id"]	= $this->br_channel_id;
					$_POST["entry_date"]	= time();
					$_POST["status"]	= ($data["enabled"] == 1) ? 'open' : 'closed';

					// Get the comment setting for the channel
						$comment_setting = $this->EE->api_channel_structure->get_channel_info($this->br_channel_id);
						$comment = $comment_setting->result_object();
						$_POST["allow_comments"] = $comment[0]->comment_system_enabled;

					$ft = $this->EE->api_channel_fields;
						
					foreach($id as $key => $val){
						$this->EE->api_channel_fields->setup_handler($key);
						
						// We are just validating ourselves. Tried the API method but
						// couldn't get it to work with all the pass by reference grably 
						// gook that is in the there. Parameters never came through. 
							$path = $ft->ft_paths[$ft->field_type];
							$this->EE->load->add_package_path($path,FALSE);
							
							if(isset($_POST["field_id_".$key])){
					        	$valid = $ft->field_types[$ft->field_type]->validate($_POST["field_id_".$key]);
							}else{
					        	$valid = $ft->field_types[$ft->field_type]->validate($_POST);
							}
						
						// File fields
						if(isset($valid["value"])){
							$_POST["field_id_".$key] = $valid["value"];
							if(isset($_POST["field_id_".$key."_directory"])){
								unset($_POST["field_id_".$key."_directory"]);
							}
						}
					}

				if($data["product_id"] != 0){
					// Now we'll run the update entry
					// We are going to assume that the user has access to the BrilliantRetail 
					// Channel regardless of their actual settings. The channel is hidden and 
					// we built it automatically so we should allow admins with access to the 
					// BR module to access it directly. (This solves the disappearing product problem!)
					$_POST["entry_id"] = $entry_id;
					$orig_group_id = $this->EE->session->userdata["group_id"];
					$this->EE->session->userdata["group_id"] = 1; // Temporarily open give SA access to channels
					$this->EE->api_channel_entries->update_entry($entry_id, $_POST);
					
					// Set back to original access
					$this->EE->session->userdata["group_id"] = $orig_group_id;		
				}
							
			// Feeds			
				$prod_feed= array();
				if (isset($data['feed_id'])){
					$prod_feed = $data['feed_id'];
				}
			
			unset($data['feed_id']);
				
			// If product_id is 0 then its a new product
			if($data["product_id"] == 0){

				// Hook before we create the product
					if($this->EE->extensions->active_hook('br_product_create_before') === TRUE){
						$data = $this->EE->extensions->call('br_product_create_before', $data); 
					}

				// Create the product 
					$data["product_id"] = $this->EE->product_model->update_product($data,'',$this->vars["media_dir"]);
				
				// Create the product / entry relationship
					$insert = array(
										"product_id" 	=> $data["product_id"],
										"entry_id"		=> $entry_id
									);
					$this->EE->db->insert('br_product_entry',$insert);
					
				// Hook after we create the product 
					if($this->EE->extensions->active_hook('br_product_create_after') === TRUE){
						$data = $this->EE->extensions->call('br_product_create_after', $data); 
					}
			}else{
				// Hook before we create the product
					if($this->EE->extensions->active_hook('br_product_update_before') === TRUE){
						$data = $this->EE->extensions->call('br_product_update_before', $data); 
					}
					
					$this->EE->product_model->update_product($data,'',$this->vars["media_dir"]);
				
				// Hook after we create the product
					if($this->EE->extensions->active_hook('br_product_update_after') === TRUE){
						$data = $this->EE->extensions->call('br_product_update_after', $data); 
					}
			}
			
			// We need to remove all the entries that exist for this product from the feed;
			$this->EE->product_model->remove_product_from_feed($data['product_id']);
			
			// Now we add all the selected feeds to the table
			if(isset($prod_feed)){
				foreach($prod_feed as $feed_id)
				{
					$feed = array(
						'feed_id' => $feed_id,
						'product_id' => $data['product_id']		
					);
					$this->EE->product_model->add_product_to_feed($feed);
				}
			}
							
			// Clear the meta cache
				remove_from_cache('meta_info');

			// Clear the db cache 
				$this->EE->functions->clear_caching('db');
			
			if($redirect==TRUE){
				//Reindex product search
					$_SESSION["message"] = lang('br_product_update_success');
					if($continue == TRUE){
						$this->EE->functions->redirect($this->base_url.'&method=product_edit&product_id='.$data["product_id"].'&channel_id='.$this->br_channel_id.'&entry_id='.$entry_id);
					}else{
						$this->EE->functions->redirect($this->base_url.'&method=product');
					}
			}else{
				return $data["product_id"];	
			}
		}

	/**
	 * product_configurable_create_options function.
	 * 
	 * @access public
	 * @return void
	 */
		function product_configurable_create_options()
		{
			// Get the products 
			$fields = array();
			foreach($_GET["fields"] as $f){
				$fields[] = $f;
			}
			$form = $this->_build_configurable_form($fields);
			echo $form;
			exit();
		}
		
	/**
	 * product_search function.
	 * 
	 * @access public
	 * @return void
	 */
		function product_search()
		{
			// Get the products 
			$term = isset($_GET["term"]) ? trim($_GET["term"]) : '';
			$type = isset($_GET["type"]) ? trim($_GET["type"]) : '';
			$products = $this->EE->product_model->search_products($term,$type);
			echo json_encode($products);
			exit();
		}

	/************************/
	/* Promotions Tab	 	*/
	/************************/
	
	/**
	 * promo function.
	 * 
	 * @access public
	 * @return void
	 */
		function promo()
		{
			$this->vars["promo"] = $this->EE->promo_model->get_promo();
			
			// Set the header/breadcrumb 
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_promotion');

				$this->EE->cp->set_right_nav(array(
					'br_new_promo' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=promo_new'
				));
			
			$this->EE->cp->add_js_script( array(
												'ui' => 'tabs,datepicker' 
												));
															
			return $this->_view('promo/promo', $this->vars);	
		}
	
	/**
	 * promo_new function.
	 * 
	 * @access public
	 * @return void
	 */
		function promo_new()
		{
			// Search Url for selecting individual products
			$this->vars['product_search'] = $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_search');			

			$this->vars['cp_page_title'] = lang('nav_br_promotion');
			
			$this->EE->cp->add_js_script(  array(
										'ui' => 'datepicker' 
									));
			
			$cat = $this->EE->product_model->get_categories(0);
			
			$this->vars["categories"] = '';
			if(isset($cat[0])){
				$this->vars["categories"] = $this->_product_category_tree($cat[0],$cat,0);
			}
			$this->vars["products"] = array();					

			$this->vars["promo"][0] = array(
												"promo_id" 		=> 0,
												"discount_type" => 'item',
												"title" 		=> '',
											    "code" 			=> '',
											    "start_dt" 		=> '',
											    "end_dt" 		=> '',
											    "code_type" 	=> 'fixed',
											    "amount" 		=> '',
											    "enabled" 		=> '1',
											    "descr"	 		=> '',
											    "category_list" => '',
											    "product_list" 	=> '',
											    "min_subtotal" 	=> '1.00',
											    "min_quantity" 	=> '1',
											    "uses_per" 		=> '0',
										        "groups"        => array(0)
										    );

            // Set the form action
                $this->vars["action"] = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=promo_update';
                $this->vars["hidden"] = array('promo_id' => 0);
            
    		// Get the group names
    			$qry = $this->EE->member_model->get_member_groups();
    			$groups = array();
    			foreach($qry->result_array() as $row){
    				$groups[$row["group_id"]] = $row["group_title"];
    			}
    
    			$this->vars["group_list"] = $groups;

			return $this->_view('promo/edit', $this->vars);
		}
		
	/**
	 * promo_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function promo_edit()
		{
			$promo_id = $this->EE->input->get('promo_id');

			if(!is_numeric($promo_id)){
				$this->EE->session->set_flashdata('message_failure',lang('br_error_invalid_id'));
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_promo');
			}
			$this->vars['product_search'] = $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_search');			

			$this->vars['cp_page_title'] = lang('nav_br_promotion');
			
			$this->EE->cp->add_js_script(  array(
									'ui' => 'accordion,datepicker' 
									));
									
			// Get the promo details 
				$this->vars["promo"] = $this->EE->promo_model->get_promo($promo_id);
				
			// Get Categories
		
				$cat = $this->EE->product_model->get_categories(0);
				
				$cat_list = $this->vars["promo"][0]["category_list"];
				$selected = array();
				if($cat_list != ''){
					$cat_array = json_decode($this->vars["promo"][0]["category_list"]);
					foreach ($cat_array as $c){
						$selected[$c] = $c;	
					}
				}

			// Create a tree 
				$this->vars["categories"] = $this->_product_category_tree($cat[0],$cat,0,$selected);
				
				$categories = $this->_product_category_tree($cat[0],$cat,0,$selected);

			
			// Get the products 
				$this->vars["products"] = array();
				$product_list = $this->vars["promo"][0]["product_list"];
				if($product_list != ''){
					$list = json_decode($product_list);
					foreach($list as $product_id){
						$this->vars["products"][] = $this->EE->product_model->get_product_basic($product_id);
					}
				} 

            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=promo_update';
			$this->vars["hidden"] = array('promo_id' => $promo_id);
			
    		// Get the group names
    			$qry = $this->EE->member_model->get_member_groups();
    			$groups = array();
    			foreach($qry->result_array() as $row){
    				$groups[$row["group_id"]] = $row["group_title"];
    			}
                
                // Convert groups into array
                    $this->vars["promo"][0]["groups"] = explode(",",$this->vars["promo"][0]["groups"]);
                
    			$this->vars["group_list"] = $groups;

			return $this->_view('promo/edit', $this->vars);	
		}
		
	/**
	 * promo_update function.
	 * 
	 * @access public
	 * @return void
	 */
		function promo_update()
		{
			// Check for delete
				if(isset($_POST["duplicate"])){
					$_POST["promo_id"] = 0;
					$_POST["title"] .= ' [copy]';
					unset($_POST["duplicate"]);
				}
			
			// Check for delete
				if(isset($_POST["delete"])){
					$this->EE->promo_model->delete_promo($_POST["promo_id"]);
					$_SESSION["message"] = lang('br_promo_delete_success');
					$this->EE->functions->redirect($this->base_url.AMP.'method=promo');
				}
			
			// Format the dates 
				$_POST["start_dt"] = ($_POST["start_dt"] > 0) ? date("Y-m-d 00:00:00",strtotime($_POST["start_dt"])) : '';
				$_POST["end_dt"] = ($_POST["end_dt"] > 0) ? date("Y-m-d 23:59:59",strtotime($_POST["end_dt"])) : '';

			// Format the category list
				if(isset($_POST["category_list"])){
					$_POST["category_list"] = '';
				}else{
					if(isset($_POST["category_title"])){
						$_POST["category_list"] = json_encode($_POST["category_title"]);
					}else{
						$_POST["category_list"] = '';
					}
				}
				
			// Format the category list
				if(isset($_POST["product_list"])){
					$_POST["product_list"] = '';
				}else{
					if(isset($_POST["product"])){
						$_POST["product_list"] = json_encode($_POST["product"]);
					}else{
						$_POST["product_list"] = '';
					}
				}
	
	        $_POST["groups"] = join(',',$_POST["groups"]);
	        
			$continue = isset($_POST["save_continue"]) ? 1 : 0 ;
			unset($_POST["category_title"]);
			unset($_POST["product"]);
			unset($_POST["save"]);
			unset($_POST["save_continue"]);
			if($_POST["promo_id"] == 0){
				$promo_id = $this->EE->promo_model->create_promo($_POST);
			}else{
				$this->EE->promo_model->update_promo($_POST);
				$promo_id = $_POST["promo_id"];
			}
			$_SESSION["message"] = lang('br_promo_update_success');
			if($continue == 1){
				$this->EE->functions->redirect($this->base_url.AMP.'method=promo_edit'.AMP.'promo_id='.$promo_id);
			}
			$this->EE->functions->redirect($this->base_url.AMP.'method=promo');
		}
		
	/************************/
	/* Reports Tab  		*/
	/************************/
	
	/**
	 * report function.
	 * 
	 * @access public
	 * @return void
	 */
		function report()
		{
			// Set the header/breadcrumb 
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_report');
				
			// Get all of the reports
				$list = read_system_files('report');		

			// Grab them
				$i = 0; 	
				foreach($list as $inc){
					// Include the file
						include_once($inc["path"]);
						$str = 'Report_'.$inc["code"];
						$report = new $str();
						$reports[$i++] = array(
												'title' 	=> '<a href="'.$this->base_url.'&method=report_detail&report='.$inc["code"].'">'.$report->title.'</a>',
												'type' 		=> $report->category,  
												'descr' 	=> $report->descr,
												'version' 	=> $report->version
												);
						$i++;
				}
			$this->vars["reports"] = $reports;

			return $this->_view('report/report', $this->vars);	
		}

	/**
	 * report_detail function.
	 * 
	 * @access public
	 * @return void
	 */
		function report_detail()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->EE->cp->set_breadcrumb($this->base_url.'&method=report', lang('nav_br_report'));
				$this->vars['cp_page_title'] = lang('br_report_detail');

			// Add the data picker js
				$this->EE->cp->add_js_script(array('ui' => 'datepicker'));
			
			// Get all of the reports
				$list = read_system_files('report');		
		
			// Include the file
				foreach($list as $inc){
					$this->vars["report"] = $this->EE->input->get('report');
					if($inc["code"] == $this->vars["report"]){
						include_once($inc["path"]);
						$str = 'Report_'.$inc["code"];	
					}
				}

			// Initiate the selected report class
				$report = new $str();
				
				$this->vars["parent"] 	= $report->category;
				$this->vars["title"] 	= $report->title;
				$this->vars["detail"] 	= $report->get_report();
				$this->vars["input"] 	= '';
				
				foreach($this->vars["detail"]["input"] as $in){
					$this->vars["input"] .= $this->_build_report_input($in);
				}
			
            // Set the form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=report_detail'.AMP.'report='.$this->vars["report"];
			
			// Export it as a csv 	
				if(isset($_POST["export"]) && $_POST["export"] == 1){
					$this->_build_report_csv($this->vars["detail"]);
					return;
				}
			// return the view file
				return $this->_view('report/detail', $this->vars);	
		}
	
	/************************/
	/* Configuration Tab 	*/
	/************************/
		
    /**
     * config function.
     * 
     * IMPORTANT: Config method is just a placeholder to build our permissions array. 
     * 
     * @access public
     * @return void
     */
		function config(){}
		
    /**
     * config_attribute function.
     * 
     * @access public
     * @return void
     */
		function config_attribute()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_attribute');
			
			$this->vars["attributes"] = (array)$this->EE->product_model->get_attributes();
			// Set the selected menu
			
			$this->EE->cp->set_right_nav(array(
				'br_new_attribute' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_attribute_create'
			));
			
			$this->vars["content"] = $this->_view('config/attribute', $this->vars);
			return $this->_view('config/index', $this->vars);
		}

	/**
	 * config_attribute_update function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attribute_update()
		{
			$continue = FALSE;

			// Check for duplicate
				if(isset($_POST["duplicate"])){
					$_POST["attribute_id"] = 0;
					$_POST["title"] .= ' [copy]';
					$_POST["code"] .= 'copy';
					unset($_POST["duplicate"]);
					$continue = TRUE;
				}
			
			// Check for delete
				if(isset($_POST["delete"])){
					$this->EE->product_model->delete_attribute($_POST["attribute_id"]);
					remove_from_cache('config');
					$_SESSION["message"] = lang('br_attribute_delete_success');
					$this->EE->functions->redirect($this->base_url.AMP.'method=config_attribute');
				}
			
			// Check for Save Buttons
				if(isset($_POST["submit"])){
					if($_POST["submit"] == 'Save'){
						$continue = FALSE;	
					}else{
						$continue = TRUE;
					}
					unset($_POST["submit"]);
				}
			
			$attribute_id = $this->EE->product_model->update_attribute($_POST);
			remove_from_cache('config');
			$_SESSION["message"] = lang('br_attribute_update_success');
			if($continue == TRUE){
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_attribute_edit'.AMP.'attribute_id='.$attribute_id);
			}else{
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_attribute');
			}
		}
		
	/**
	 * config_attribute_create function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attribute_create()
		{
			$this->vars["attributes"] = array(
												'attribute_id' 	=> 0,
												'title' 		=> '',
												'code' 			=> '',
												'fieldtype' 	=> 'text',
												'required' 		=> 0,
												'filterable' 	=> 1,
												'default_text' 	=> '',
												'options' 		=> array()
												);

            // Set the form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_attribute_update';

			$this->vars["content"] = $this->_view('config/attribute_edit', $this->vars);
			
			return $this->_view('config/index', $this->vars);			
		}

	/**
	 * config_attribute_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attribute_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_attribute');

			$attribute_id = $this->EE->input->get('attribute_id');
			$this->vars["attributes"] = $this->EE->product_model->get_attribute_by_id($attribute_id);
			$this->vars["attributes"]["attribute_id"] = $attribute_id;
			
            // Set the form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_attribute_update';

    			$this->vars["content"] = $this->_view('config/attribute_edit', $this->vars);

			return $this->_view('config/index', $this->vars);			
		}
		
		
	/**
	 * config_attributeset function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attributeset()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_attributeset');

			$this->vars["attributes"] = (array)$this->EE->product_model->get_attribute_sets();
			
				$this->EE->cp->set_right_nav(array(
					'br_new_attribute_set' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_attributeset_create'
				));

			$this->vars["content"] = $this->_view('config/attribute_set', $this->vars);
			return $this->_view('config/index', $this->vars);	
		}

	/**
	 * config_attributeset_create function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attributeset_create()
		{
			$this->vars['cp_page_title'] = lang('nav_br_config_attributeset');

			$attribute_set_id = 0;
			$this->vars["attributes"] = $this->EE->product_model->get_attribute_set_list($attribute_set_id);
			$attribute_set = $this->EE->product_model->get_attribute_sets($attribute_set_id);
			
			$this->vars["attribute_set_id"] = $attribute_set_id;
			$this->vars["title"] = '';

            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_attributeset_update';

			$this->vars["content"] = $this->_view('config/attribute_set_edit', $this->vars);
			return $this->_view('config/index', $this->vars);	
		}
		
	/**
	 * config_attributeset_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attributeset_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_attributeset');

			$attribute_set_id = $this->EE->input->get('attribute_set_id');
			$this->vars["attributes"] = $this->EE->product_model->get_attribute_set_list($attribute_set_id);
			$attribute_set = $this->EE->product_model->get_attribute_sets($attribute_set_id);
			
			$this->vars["attribute_set_id"] = $attribute_set_id;
			$this->vars["title"] = $attribute_set[0]["title"];

            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_attributeset_update';

			$this->vars["content"] = $this->_view('config/attribute_set_edit', $this->vars);
			return $this->_view('config/index', $this->vars);	
		}	
		
	/**
	 * config_attributeset_update function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attributeset_update()
		{	
			$this->EE->product_model->update_attribute_set();
			remove_from_cache('config');
			$_SESSION["message"] = lang('br_attribute_set_update_success');
			if(isset($_POST["continue"])){
				// stay on the edit screen
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_attributeset_edit'.AMP.'attribute_set_id='.$_POST["attribute_set_id"]);
			}
			else
			{
				// go to the overview
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_attributeset');
			}
		}

	/**
	 * config_attributeset_delete function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_attributeset_delete()
		{
			$attribute_set_id = $this->EE->input->get('attribute_set_id');
			$this->vars["attributes"] = $this->EE->product_model->delete_attribute_set($attribute_set_id);
			remove_from_cache('config');
			$_SESSION["message"] = lang('br_attribute_set_delete_success');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_attributeset');
			exit();
		}
		
	/**
	 * config_category function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_category()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_category');

			$this->EE->cp->add_js_script( array(
												'ui' => 'droppable' 
												));

			// Get the list of categories
				$cat = $this->EE->product_model->get_categories(0);
			// Create a tree 
				if(isset($cat[0])){
					$this->vars["categories"] = $this->_config_category_tree($cat[0],$cat,0);
				}else{
					$this->vars["categories"] = array();
				}
			
            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_category_update';

			$this->vars["content"] = $this->_view('config/category', $this->vars);

			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_category_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_category_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_category');

			$this->vars['product_search'] = $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_search');			

			$cat = $this->EE->product_model->get_category($this->EE->input->get('cat_id'));
			
			$prod = $this->EE->product_model->get_product_by_category($this->EE->input->get('cat_id'),"TRUE");
			
			// Create a tree 
				if(isset($cat[0])){
					$this->vars["categories"] = $this->_config_category_tree($cat[0],$cat,0);
				}else{
					$this->vars["categories"] = array();
				}
				
				$this->vars["categories"] = $this->EE->product_model->get_categories(0);
			
			$cnt = 0;
			$prod_ary = array();
			
			foreach($prod as $p)
			{
				$products[$p["product_id"]] 	= $p["product_id"];
				$sort_order[$p["product_id"]] 	= $p['sort_order'];
				$cnt++;
			}
			if($cnt > 0){
				$sql = "SELECT 
							pc.sort_order, 
							p.product_id,
							p.title 
						FROM 
							exp_br_product p, 
							exp_br_product_category pc 
						WHERE 
							p.product_id = pc.product_id 
						AND 
							p.product_id in (".join(",",$products).")
						AND 
							pc.category_id = ".$cat[0]["category_id"]." 
						ORDER BY 
							pc.sort_order";

				$qry = $this->EE->db->query($sql);
				$i=0;
				foreach($qry->result_array() as $rst)
				{
					$prod_ary[$i]['id']			= $rst['product_id'];
					$prod_ary[$i]['title']		= $rst['title'];
					$prod_ary[$i]['sort_order']	= $rst['sort_order'];
					$i++;
				}
			}
			
			if($cat[0]["image"] != ''){
				$cat[0]["image"] = '<input type="hidden" id="remove_image" name="remove_image" value="0" />
									<div id="cat_image_container">
										<img src="/media/images/'.$cat[0]["image"].'" width="300" style="border:1px #ccc solid;margin-bottom: 10px;" /><br />
										<a href="#" id="remove_image_link">'.lang('br_remove_image').'</a>
										<br />
										<br />
										</div>
									<script type="text/javascript">
										$(function(){
											$(\'#remove_image_link\').bind(\'click\',function(){
												$(\'#remove_image\').val(1);
												$(\'#cat_image_container\').remove();
												return FALSE;
											});
										});
									</script>';
			}
			$this->vars['products'] = $prod_ary;
			$this->vars["category"] = $cat[0];
			
            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_category_update';

			$this->vars["content"] = $this->_view('config/category_edit', $this->vars);
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_category_update function.
	 * 
	 * @access public
	 * @return void
	 */
	function config_category_update(){

            if($_POST['action'] == 'order') {
                $order = explode('&',$_POST['order']);
                $i = 0;
                foreach($order as $row){
                        $category_id = str_replace('cat[]=','',$row);
                        $this->EE->product_model->update_category_order($category_id,$i);
                        $i++;
                }
                echo 1;
            }elseif($_POST['action'] == 'update'){
                $image = '';
                if(isset($_FILES)){
                    $config['upload_path'] 	= $this->vars['media_dir'].'images';
                    $config['allowed_types'] = 'gif|jpg|png';
                    #$config['max_size'] = '4096'; 
                    #$config['max_width'] = '1024';
                    #$config['max_height'] = '768';
                    $this->EE->load->library('upload',$config);
                    if($this->EE->upload->do_upload('image')){
                            $result = array('upload_data' => $this->EE->upload->data()); 
                            $image = $result['upload_data']['file_name'];
                    }
                }
				
		$data = array('category_id' 	=> $_POST['category_id'],
                                'title' 	=> $_POST['title'], 
                                'detail' 	=> $_POST['detail'],  
                                'url_title' 	=> $_POST['url_title'], 
                                'enabled' 	=> $_POST['enabled'], 
                                'template_path' => $_POST['template_path'],
                                'meta_title' 	=> $_POST['meta_title'], 
                                'meta_descr' 	=> $_POST['meta_descr'], 
                                'meta_keyword' 	=> $_POST['meta_keyword'] 
				);
				
        // If the remove was passed remove it.
                if(isset($_POST['remove_image']) && $_POST['remove_image'] == 1){
                        $data['image'] = $image;
                        unset($_POST['remove_image']);
                }
        // If a new image was set add it.
                if($image != ''){
                        $data['image'] = $image;
                }
				
				// lets deal with the product ordering process
					
		// Drop all of the products for the category
		$this->EE->db->delete('br_product_category', array('category_id' => $_POST['category_id']));

		if(!empty($_POST['items'])){
                    $items = explode('|',rtrim($_POST['items'],'|'));
						
                    foreach($items as $a){
                        $b = explode(':',$a);
                        $row = array('site_id' 		=> $this->site_id,
                                     'category_id'	=> $_POST['category_id'],
                                     'product_id'	=> $b[0], 
                                     'sort_order'	=> $b[1]
                                    );			
                        $this->EE->db->insert('br_product_category', $row);
                    }
					}

                    $data['url_title'] = $this->_check_category_url($data,$_POST['category_id']);
                    $this->EE->product_model->update_category($_POST['category_id'],$data);
                    $this->EE->functions->clear_caching('db');
				
				// Clear the meta cache
                    remove_from_cache('meta_info');
				
                    return $this->config_category();
            }elseif($_POST['action'] == 'create'){
                $data = array('site_id' 	=> $this->site_id,
                                'title' 	=> trim($_POST['title']), 
                                'url_title' => $_POST['title'], 
                                'parent_id' => $_POST['parent_id'],
                                'sort' 		=> -time() 
                        );
                $data['url_title'] = $this->_check_category_url($data,0);
                $cat_id = $this->EE->product_model->update_category_create($data);
                $this->EE->functions->clear_caching('db');
                echo $cat_id;			
            }elseif($_POST['action'] == 'delete'){
		$cat_id = $this->EE->product_model->update_category_delete($_POST['category_id']);
		$this->EE->functions->clear_caching('db');
		return $this->config_category();
            }
            exit();
        }

	/**
	 * config_email function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_email()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_email');
	
			$this->vars["content"] = $this->_view('config/email', $this->vars);
			return $this->_view('config/index', $this->vars);	
		}

	/**
	 * config_email_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_email_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_email');

			$list = $this->EE->email_model->get_emails_by_site_id($this->site_id);
			$email_id = $this->EE->input->get('email_id');
			$this->vars["email"] = $this->EE->email_model->get_email_by_id($email_id);

			// Do we have a local version?
				$short_name = $this->EE->config->item("site_short_name");
				$fl = PATH_THIRD.'_local/brilliant_retail/notifications/'.$short_name.'/'.$this->vars["email"]["title"].'.html';
				if(file_exists($fl)){
					// File helper
					$this->EE->load->helper('file');
					$this->vars["email"]["content"] = read_file($fl);
				}
			
            // Set the form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_email_update';

			$this->vars["content"] = $this->_view('config/email_edit', $this->vars);
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_email_update function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_email_update()
		{
			$email_id = $_POST["email_id"];
			$data = array(
							'subject' 		=> $_POST['subject'],
							'content' 		=> $_POST['content'],
							'from_name' 	=> $_POST['from_name'],
							'from_email'	=> $_POST['from_email'],
							'bcc_list' 		=> $_POST['bcc_list'] 
						);
			$this->EE->email_model->update_email($email_id,$data);
			
			// Do we have a local version?
				$short_name = $this->EE->config->item("site_short_name");
				$fl = PATH_THIRD.'_local/brilliant_retail/notifications/'.$short_name.'/'.$_POST["title"].'.html';
				if(file_exists($fl)){
					// File helper
					$this->EE->load->helper('file');
					write_file($fl, $_POST['content']);
				}
			
			
			$_SESSION["message"] = lang('br_email_update_success');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_email');
		}
		
	/**
	 * config_feeds function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_feeds()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_feeds');
			
			$this->EE->cp->set_right_nav(array(
				'br_new_config_feeds' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_feeds_edit'
			));	
			
			$this->vars["feeds"]        = $this->EE->feed_model->get_feeds();
			$this->vars['feed_aid']     = $this->EE->core_model->get_aid('Brilliant_retail','pull_feed');
			$this->vars["content"]      = $this->_view('config/feed', $this->vars);
			
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_feeds_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_feeds_edit()
		{	
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_feeds');

  			// Load Libraries & Helpers
  				$this->EE->load->library( array('form_validation') );

			$feed_data = array(
								'feed_title'  => '',
								'feed_code'   => '',
								'feed_id'     => '',
		 						);

			$feed_id    = $this->EE->input->get('feed_id');
			
			if ( $feed_id != '' ){
				$feed_data  = $this->EE->feed_model->get_feeds($feed_id); 
			}
			
  	  
	  		// Configure Form Validation
		  	 	$rules  = array(
		        	array(
		         			'field'   => 'feed_title',
		          			'label'   => lang( 'feed_title' ),
		          			'rules'   => 'required'
		        	),
		        	array(
		          			'field'   => 'feed_code',
		          			'label'   => lang( 'feed_code' ),
		          			'rules'   => 'required|alpha_dash' . ($this->EE->input->post('feed_id') == '' ? '|callback__feed_code_exists' : '')
		        	)
		     	);
  	  		
  	  			$this->EE->form_validation->set_rules( $rules )->set_error_delimiters('<div class="notice">', '</div>'); 
				$this->EE->form_validation->set_message('_feed_code_exists', lang('br_feed_code_exists'));
      
	      // Get Feed Data
	      	$feed_data = array(
		        'feed_title'  => $this->EE->input->post('feed_title') != '' ? $this->EE->input->post('feed_title') : $feed_data['feed_title'],
		        'feed_code'   => $this->EE->input->post('feed_code') != '' ? $this->EE->input->post('feed_code') : $feed_data['feed_code'],
		        'feed_id'     => $this->EE->input->post('feed_id') != '' ? $this->EE->input->post('feed_id') : $feed_data['feed_id'],
	      	);
		  
		  // Form Validation
		  	if($this->EE->input->post('submit')){
  		  		if($this->EE->form_validation->run()){
  		    		// Create or Update Feed
		      		$feed_id = $this->EE->feed_model->update_feed($feed_data);
		    		
		    		if ( $this->EE->input->post('feed_id') != '' ){
  				  		br_set( 'message', lang('br_feed_update_success') );
  		    		}else{
  				  		br_set( 'message', lang('br_feed_create_success') ); 
  		   			}
		      
  				// Redirect User
  					if( $this->EE->input->post('submit') == 'Save' ){
  				  		$this->EE->functions->redirect( $this->base_url . AMP . 'method=config_feeds'); 
  					}else{
  				  		$this->EE->functions->redirect( $this->base_url . AMP . 'method=config_feeds_edit' . AMP . 'feed_id=' . $feed_id ); 
  					}
  		  		}else{
  					br_set( 'message', lang('br_feed_update_failure') );
  		  		} 
			}
		  
		// Delete Feed
  			if( $this->EE->input->post('delete') ){
  				$this->EE->feed_model->delete_feed($this->EE->input->post('feed_id'));
  				remove_from_cache('config');
  				$_SESSION["message"] = lang('br_feed_delete_success');
  				$this->EE->functions->redirect( $this->base_url . AMP . 'method=config_feeds'); 
  			}
			
			// Prepare Interface
				$this->vars['feed']         = $feed_data;
				$this->vars['categories']   = $this->EE->product_model->get_all_categories();
				$this->vars['products']     = $this->EE->product_model->get_products_by_feed($feed_id);
				
                $this->vars["action"]       = $this->base_url.AMP.'method=config_feeds_edit';
				
				$this->vars["content"]      = $this->_view('config/feed_edit', $this->vars);
				
				return $this->_view('config/index', $this->vars);
		}
	
	/* 
	function config_integration()
	{
	    $this->vars["content"]      = $this->_view('config/integration', $this->vars);
				
        return $this->_view('config/index', $this->vars);
	}	
	*/
		
		
	/**
	 * _feed_code_exists function.
	 * 
	 * @access private
	 * @param mixed $code
	 * @return void
	 */
		function _feed_code_exists( $code )
		{
		  $feeds = $this->EE->feed_model->get_feed_by_code( $code );
		  return (count( $feeds ) == 0 ? TRUE : FALSE);
		}

	/**
	 * config_gateway function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_gateway()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_gateway');

			// Load the content
				$files = read_system_files('gateway');	
                                //error_log('gateways:'. print_r($files,1));
				$gateway = array();
				
				foreach($files as $f){
					if(isset($this->_config["gateway"][$this->site_id][$f["code"]])){
						include_once($f["path"]);
						$str = 'Gateway_'.$f["code"];
						$class = new $str();
						$version = $class->version;
						$installed = $this->_config["gateway"][$this->site_id][$f["code"]]["version"];
						if($version > $installed){
							$class->update($installed,$this->_config["gateway"][$this->site_id][$f["code"]]["config_id"]);
						}else{
							$version = $installed;
						}
						$gateway[$this->_config["gateway"][$this->site_id][$f["code"]]["title"]] = array(
												'config_id'	=> $this->_config["gateway"][$this->site_id][$f["code"]]["config_id"],
												'title' 	=> $this->_config["gateway"][$this->site_id][$f["code"]]["title"],
												'code' 		=> $f["code"],
												'version' 	=> $version,
												'descr' 	=> $this->_config["gateway"][$this->site_id][$f["code"]]["descr"],
												'type' 		=> $f["type"], 												
												'enabled' 	=> $this->_config["gateway"][$this->site_id][$f["code"]]["enabled"], 
												'has_options' => isset($this->_config["gateway"][$this->site_id][$f["code"]]["config_data"]) ? 1 : 0, 
												'installed' => 1
											);
					}else{
                                                //error_log($f['path']);
						include_once($f["path"]);
						$str = 'gateway_'.$f["code"];
                                                //error_log($str);
						$class = new $str();
						$gateway[$class->title] = array(
												'title' 	=> $class->title,
												'code'		=> $f["code"],
												'version' 	=> $class->version,
												'descr' 	=> $class->descr,
												'type' 		=> $f["type"],												
												'enabled' 	=> 0, 
												'installed' => 0  											
											);
					}
				}
				ksort($gateway);
				$this->vars["modules"] = $gateway;
			$this->vars["content"] = $this->_view('config/gateway', $this->vars);
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_gateway_install function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_gateway_install()
		{
			$type = trim(strtolower($_GET["type"]));
			$code = trim(strtolower($_GET["code"]));
	
			// Create the file page
				$loc = ($type=='local') ? '_local/brilliant_retail' : 'brilliant_retail/core';			
				$path = PATH_THIRD.$loc.'/gateway/gateway.'.$_GET["code"].'.php';
			
			if(!file_exists($path)){ 
				$this->EE->session->set_flashdata('message_failure',lang('br_module_install_error'));
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_gateway');
			}else{
				include_once($path);
				$str = 'Gateway_'.$code;
				$class = new $str();
				$config_id = $this->EE->core_model->module_install(
																		'gateway',
																		$class->title,
																		$class->label,
																		$code,
																		$class->descr,
																		$class->version
																	);
				$_SESSION["message"] = lang('br_module_install_success');
				$class->install($config_id);
			}
			remove_from_cache('config');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_gateway_edit'.AMP.'config_id='.$config_id.AMP.'code='.$code);
		}
		
	/**
	 * config_gateway_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_gateway_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_gateway');
				
				$code 		= $_GET["code"];
				$config_id	= $_GET["config_id"];
			
			// Create the file path
				$str = 'Gateway_'.$code;
				if(!class_exists($str)){
					$local_path = PATH_THIRD.'_local/brilliant_retail/gateway/gateway.'.$_GET["code"].'.php';
					if(file_exists($local_path)){
						include_once($local_path);
					}else{
						include_once(PATH_THIRD.'brilliant_retail/core/gateway/gateway.'.$_GET["code"].'.php');
					}
				}	
				$class = new $str();
				$ipn_url = $class->ipn_url;
				
				$this->vars["instructions"] = $class->instructions;
				
				$fields = array();
				// Providee the IPN Url if IPN is enabled in the gateway
					if($class->ipn_enabled){
						$fields[] = array(
											'label' 	=> lang('br_ipn_url'),
											'input' 	=> $ipn_url.$config_id,
											'descr' 	=> "",
											'required' 	=> "required"
										);
					}				
				if(isset($this->_config["gateway"][$this->site_id][$code]["config_data"])){
					foreach($this->_config["gateway"][$this->site_id][$code]["config_data"] as $f){
						// Use our input functions
							$fx = '_producttype_'.$f["type"];
							
							$input = $this->$fx(0,
												$f["config_data_id"],
												'',
												$f["label"],
												$f["required"],
												$f["value"],
												$f["options"]); 
	
						// Create a fields array
						// for the module settings
							$fields[] = array(
												'label' 	=> $f["label"],
												'input' 	=> $input,
												'descr' 	=> $f["descr"],
												'required' 	=> $f["required"]
											);
					}
				}
							
			$this->vars["config_id"] 	= $this->_config["gateway"][$this->site_id][$code]["config_id"];
			$this->vars["title"] 		= $this->_config["gateway"][$this->site_id][$code]["title"];
			$this->vars["label"] 		= $this->_config["gateway"][$this->site_id][$code]["label"];
			$this->vars["sort"] 		= $this->_config["gateway"][$this->site_id][$code]["sort"];
			$this->vars["enabled"] 		= $this->_config["gateway"][$this->site_id][$code]["enabled"];
			$this->vars["groups"] 		= explode(",",$this->_config["gateway"][$this->site_id][$code]["groups"]);
			$this->vars["fields"] 		= $fields;

            $qry = $this->EE->member_model->get_member_groups();
            $groups = array();
            foreach($qry->result_array() as $row){
            	$groups[$row["group_id"]] = $row["group_title"];
            }
            $this->vars["group_list"] = $groups;

            // Set the form action
            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_gateway_update';
        
			$this->vars["content"] = $this->_view('config/gateway_edit', $this->vars);
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * Update the gateway in the database
	 * 
	 * @access public
	 * @return void
	 */
		function config_gateway_update()
		{
			remove_from_cache('config');
			
  			if(version_compare(APP_VER, '2.7.0', '>=')){
				$this->EE->security->restore_xid();
			}
			
            foreach($_POST as $key => $val){
				$data[$key] = $val;
			}
			
            if(!isset($data["groups"]))
            {
                $data["groups"] = 0;
            }else{
                $data["groups"] = join(',',$data["groups"]);
            }

			$this->EE->core_model->module_update($data);
			$_SESSION["message"] = lang('br_module_update_success');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_gateway');
		}

	/**
	 * Remove the gateway from the database 
	 * 
	 * @access public
	 * @return void
	 */
		function config_gateway_remove()
		{
			$config_id = strtolower($this->EE->input->get("config_id",TRUE));
			$code = strtolower($this->EE->input->get("code",TRUE));
			
			// Make sure the class file is loaded
				$str = 'Gateway_'.$code;
				if(!class_exists($str)){
					$local_path = PATH_THIRD.'_local/brilliant_retail/gateway/gateway.'.$_GET["code"].'.php';
					if(file_exists($local_path)){
						include_once($local_path);
					}else{
						include_once(PATH_THIRD.'brilliant_retail/core/gateway/gateway.'.$_GET["code"].'.php');
					}
				}
			$class = new $str();
			$class->remove($config_id);
			$this->EE->core_model->module_remove($_GET["config_id"]);
			$_SESSION["message"] = lang('br_module_remove_success');
			remove_from_cache('config');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_gateway');
		}

	/**
	 * config_permission function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_permission()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_permission');
			
			$this->vars["groups"] = $this->EE->access_model->get_member_groups();

			// Set the selected menu
			$this->vars["content"] = $this->_view('config/permission', $this->vars);
			return $this->_view('config/index', $this->vars);
		}

	/**
	 * config_permission_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_permission_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_permission');
			$group_id = $this->EE->input->get("group_id",TRUE);
			$this->vars["permissions"] = $this->_admin_permission_tree($group_id);
			$this->vars["group"] = $this->EE->access_model->get_group_title($group_id);

			// Form stuff 
				$this->vars["hidden"] = array(
												'site_id' => $this->site_id,
												'group_id' => $group_id 
											);
				$this->vars["store"] = $this->EE->store_model->get_store_by_id($this->site_id);

            $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_permission_update';

			$this->vars["content"] = $this->_view('config/permission_edit', $this->vars);
			return $this->_view('config/index', $this->vars);
		}		

	/**
	 * config_permission_update function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_permission_update()
		{
			// Remove any previous group records
				$this->EE->access_model->delete_admin_access($_POST["group_id"]);
			
			// Add each of the permissions 
				if(isset($_POST["permissions"])){
					foreach($_POST["permissions"] as $p){
						$a = explode("|",$p);
						$data = array(
										'site_id' => $this->site_id, 
										'group_id' => $_POST["group_id"],
										'class' => $a[0],
										'method' => $a[1] 
									);
						$this->EE->access_model->create_admin_access($data);
					}
				}
		
			// Set a message and return to overview
				$_SESSION["message"] = lang('br_permission_update_success');
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_permission');
		}

	/**
	 * config_shipping function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_shipping()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_shipping');

			// Load the content
				
				$files = read_system_files('shipping');		
				
				$shipping = array();
				
				foreach($files as $f){
					if(isset($this->_config["shipping"][$this->site_id][$f["code"]])){
						$str = 'Shipping_'.$f["code"];
						if(!class_exists($str)){
							include_once($f["path"]);
						}
						$class 		= new $str();
						
						// Test for the version 
							$version 	= $class->version;
							$installed 	= $this->_config["shipping"][$this->site_id][$f["code"]]["version"];
							$config_id 	= $this->_config["shipping"][$this->site_id][$f["code"]]["config_id"];
							if($version > $installed){
								$class->update($installed,$config_id);
								$this->EE->core_model->module_update_version($version,$config_id);
								remove_from_cache('config');
							}else{
								$version = $installed;
							}
						
						$shipping[$this->_config["shipping"][$this->site_id][$f["code"]]["title"]] = array(
												'config_id'	=> $this->_config["shipping"][$this->site_id][$f["code"]]["config_id"],
												'title' 	=> $this->_config["shipping"][$this->site_id][$f["code"]]["title"],
												'code' 		=> $f["code"],
												'version' 	=> $version,
												'descr' 	=> $this->_config["shipping"][$this->site_id][$f["code"]]["descr"],
												'type' 		=> $f["type"], 												
												'enabled' 	=> $this->_config["shipping"][$this->site_id][$f["code"]]["enabled"], 
												'has_options' => isset($this->_config["shipping"][$this->site_id][$f["code"]]["config_data"]) ? 1 : 0
											);
					}else{
						include_once($f["path"]);
						$str = 'Shipping_'.$f["code"];
						$class = new $str();
						$shipping[$class->title] = array(
												'title' 	=> $class->title,
												'code'		=> $f["code"],
												'version' 	=> $class->version,
												'descr' 	=> $class->descr,
												'type' 		=> $f["type"],												
												'enabled' 	=> 0 											
											);
					}
				}
				ksort($shipping);
				$this->vars["modules"] = $shipping;

			$this->vars["content"] = $this->_view('config/shipping', $this->vars);
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_shipping_install function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_shipping_install()
		{
			$type = trim(strtolower($_GET["type"]));
			$code = trim(strtolower($_GET["code"]));
			
			// Create the file page
				$loc = ($type=='local') ? '_local/brilliant_retail' : 'brilliant_retail/core';			
				$path = PATH_THIRD.$loc.'/shipping/shipping.'.$_GET["code"].'.php';

			if(!file_exists($path)){ 
				$this->EE->session->set_flashdata('message_failure',lang('br_module_install_error'));
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_shipping');
			}else{
				include_once($path);
				$str = 'Shipping_'.$code;
				$class = new $str();
				$config_id = $this->EE->core_model->module_install(
																		'shipping',
																		$class->title,
																		$class->label,
																		$code,
																		$class->descr,
																		$class->version
																	);
				$_SESSION["message"] = lang('br_module_install_success');
					$data[] = array(
								'config_id' => $config_id, 
								'label'	 	=> lang('br_label'), 
								'code' 		=> 'label',
								'type' 		=> 'text',
								'sort' 		=> 0, 
								'value' 	=> $class->label
								);

				foreach($data as $d){
					$this->EE->db->insert('br_config_data',$d);
				}
				$class->install($config_id);
			}
			remove_from_cache('config');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_shipping_edit'.AMP.'config_id='.$config_id.AMP.'code='.$code);
		}
		
	/**
	 * config_shipping_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_shipping_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_shipping');

				$code = $_GET["code"];                                
				foreach($this->_config["shipping"][$this->site_id][$code]["config_data"] as $f){
					// Use our input functions
                                    
						$fx = '_producttype_'.$f["type"];
						
						$input = $this->$fx(0,
											$f["config_data_id"],
											'',
											$f["label"],
											$f["required"],
											$f["value"],
											$f["options"]); 

					// Create a fields array
					// for the module settings
						$fields[] = array(
											'label' 	=> lang($f["label"]),
											'input' 	=> $input,
											'descr' 	=> $f["descr"],
											'required' 	=> $f["required"]
										);
					$this->vars["config_id"] = $this->_config["shipping"][$this->site_id][$code]["config_id"];
					$this->vars["title"] 	= $this->_config["shipping"][$this->site_id][$code]["title"];
					$this->vars["fields"] 	= $fields;
				}
	
			$this->vars["label"] 	= $this->_config["shipping"][$this->site_id][$code]["label"];
			$this->vars["enabled"] 	= $this->_config["shipping"][$this->site_id][$code]["enabled"];
			$this->vars["sort"] 	= $this->_config["shipping"][$this->site_id][$code]["sort"];
			$this->vars["groups"] 	= explode(",",$this->_config["shipping"][$this->site_id][$code]["groups"]);
			
            // Get member groups
                $qry = $this->EE->member_model->get_member_groups();
                $groups = array();
                foreach($qry->result_array() as $row){
                	$groups[$row["group_id"]] = $row["group_title"];
                }
                $this->vars["group_list"] = $groups;

            // Set the form action
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_shipping_update';
            
			$this->vars["content"] = $this->_view('config/shipping_edit', $this->vars);
			return $this->_view('config/index', $this->vars);
		}
		
	/**
	 * config_shipping_update function.
	 * 
	 * @access public
	 * @return void
	 */
        function config_shipping_update(){
            remove_from_cache('config');			
            if(!isset($_POST["groups"])){
                $_POST["groups"] = 0;
            }else{
                $_POST["groups"] = join(',',$_POST["groups"]);
            }
            
            foreach($_POST as $key => $val){
                if(is_array($val)){
                    $data[$key] = serialize($_POST[$key]);
                }else{
                    $data[$key] = $val;
                }
            }
			
			foreach($_FILES as $key => $file){								
				$fkey =  str_replace('_file','',$key);
				unset($data[$fkey.'_title']);
				if($file['error'] == 4 ) continue;
				$fname =  $this->_config['media_dir'] . 'file/' . $file['name']   ;				
				move_uploaded_file($file['tmp_name'],$fname);
				$data[$fkey] = serialize(array('file'=> $fname,'title' => $_POST[$fkey.'_title'] ));				
				
			}

            $this->EE->core_model->module_update($data);
            $_SESSION["message"] = lang('br_module_update_success');
            $this->EE->functions->redirect($this->base_url.AMP.'method=config_shipping');
	}

	/**
	 * config_shipping_remove function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_shipping_remove()
		{
			$config_id = $this->EE->input->get("config_id",TRUE);
			$code 	= $this->EE->input->get("code",TRUE);
			$str 	= 'Shipping_'.$code;
			
			// We need to make sure the class is included. 
				if(!class_exists($str)){
					$local_path = PATH_THIRD.'_local/brilliant_retail/shipping/shipping.'.$_GET["code"].'.php';
					if(file_exists($local_path)){
						include_once($local_path);
					}else{
						include_once(PATH_THIRD.'brilliant_retail/core/shipping/shipping.'.$_GET["code"].'.php');
					}
				}

			$class 	= new $str();
			$class->remove($config_id);
			$this->EE->core_model->module_remove($config_id);
			$_SESSION["message"] = lang('br_module_remove_success');
			remove_from_cache('config');
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_shipping');
		}
		
	/**
	 * config_site function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_site()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_site');

			$this->vars["hidden"] = array(
											'site_id' => $this->site_id 
										);
			$query = $this->EE->member_model->get_member_groups();
			$groups = $query->result_array();
			$this->vars["groups"] = $groups;
			
			$this->vars["store"] = $this->_config["store"][$this->site_id];
			
			$this->vars["currencies"] = $this->EE->store_model->get_currencies();
			$this->vars["countries"] = $this->EE->product_model->get_countries(0);
			
            // Set the update 
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_site_update';
			
			$this->vars["content"] = $this->_view('config/site_edit', $this->vars);
			return $this->_view('config/index', $this->vars);
		}		
		
	/**
	 * config_site_update function.
	 * 
	 * @access public
	 * @return void
	 */
	function config_site_update(){ 
			// Set the selected menu
            foreach($_POST as $key => $val){
                    $data[$key] = $this->EE->input->post($key,TRUE);
            }
            // Unset some unwanted post variables
            unset($data['submit']);
            unset($data['max_file_size']);

    // Update the countries			
            if(!isset($data['countries'])) $data['countries'] = array();
            $this->EE->store_model->update_countries($data);
            unset($data['countries']);
			
            if(isset($_FILES)){
                $config['upload_path'] 		= $this->vars['media_dir'];
                $config['allowed_types'] 	= 'gif|jpg|png';
                $config['max_size'] 		= '1000'; 
                $config['max_width'] 		= '1024';
                $config['max_height'] 		= '768';
                $this->EE->load->library('upload',$config);
                if($this->EE->upload->do_upload('logo')){
                    $result = array('upload_data' => $this->EE->upload->data()); 
                    $data['logo'] = $result['upload_data']['file_name'];
                }
            }
            if(!uuid_validate($data['license'])){
                $data['license'] = '';
                $this->EE->session->set_flashdata('message_failure',lang('br_invalid_license'));
            }
			
            $this->EE->store_model->update_store($data);
			
			// Clear the cache file before we redirect
            remove_from_cache('config');
            $this->EE->core_model->get_config();

            $_SESSION['message'] = lang('br_store_update_success');
            $this->EE->functions->redirect($this->base_url.AMP.'method=config_site');
	}
		
	/**
	 * config_tax function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_tax()
		{ 
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_tax');
			
			$this->EE->cp->set_right_nav(array('br_new_tax' => BASE.AMP.'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_tax_new'));
			
			$this->vars["tax"] = $this->EE->tax_model->list_taxes();
			$this->vars["content"] = $this->_view('config/tax', $this->vars);	
			return $this->_view('config/index', $this->vars);
		}

	/**
	 * config_tax_new function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_tax_new()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_tax');

			// GET THE TAX ID 
				$tax_id = 0;

				$this->vars["hidden"] = array('tax_id' => $tax_id);
			// Get the tax info 				
			// Get the tax info 				
				$this->vars["zones"] = $this->EE->tax_model->get_zone();
				$states = $this->EE->tax_model->get_state();
				foreach($states as $s)
				{
					$this->vars["states"][$s["zone_id"]][$s["title"]] = $s["state_id"]; 
				
				}
				$this->vars["map"] 	= json_encode($this->vars["states"]);

				$this->vars["tax"] = array(
												'tax_id' 	=> 0,
												'title' 	=> '',
												'zone_id' 	=> '',
												'state_id' 	=> '',
												'zipcode' 	=> '',
												'rate' 		=> '10.00'
											);
				
            // Set the update 
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_tax_update';
			
			$this->vars["content"] = $this->_view('config/tax_edit', $this->vars);	
			
			return $this->_view('config/index', $this->vars);
		}

	/**
	 * config_tax_edit function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_tax_edit()
		{
			// Breadcrumb & Title
				$this->EE->cp->set_breadcrumb($this->base_url, lang('nav_br_store'));
				$this->vars['cp_page_title'] = lang('nav_br_config_tax');

			// GET THE TAX ID 
				$tax_id = (int) $_GET["tax_id"];
				$this->vars["hidden"] = array('tax_id' => $tax_id);

			// Get the tax info 				
				$this->vars["zones"] = $this->EE->tax_model->get_zone();
				$states = $this->EE->tax_model->get_state();
				foreach($states as $s)
				{
					$this->vars["states"][$s["zone_id"]][$s["title"]] = $s["state_id"]; 
				
				}
				$this->vars["map"] 	= json_encode($this->vars["states"]);
					
				$this->vars["tax"] = $this->EE->tax_model->get_tax_by_id($tax_id);

            // Set the update 
                $this->vars["action"]     = 'C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_tax_update';

			$this->vars["content"] = $this->_view('config/tax_edit', $this->vars);	
			
			return $this->_view('config/index', $this->vars);
		}

	/**
	 * config_tax_update function.
	 * 
	 * @access public
	 * @return void
	 */
		function config_tax_update()
		{
			// Check for delete
				if(isset($_POST["duplicate"])){
					$_POST["tax_id"] = 0;
					$_POST["title"] .= ' [copy]';
					unset($_POST["duplicate"]);
				}
			
			// Check for delete
				if(isset($_POST["delete"])){
					$this->EE->tax_model->delete_tax($_POST["tax_id"]);
					$_SESSION["message"] = lang('br_tax_delete_success');
					$this->EE->functions->redirect($this->base_url.AMP.'method=config_tax');
				}
			
			$continue = isset($_POST["save_continue"]) ? 1 : 0 ;
			unset($_POST["save"]);
			unset($_POST["save_continue"]);
			if($_POST["tax_id"] == 0){
				$tax_id = $this->EE->tax_model->create_tax($_POST);
			}else{
				$this->EE->tax_model->update_tax($_POST);
				$tax_id = $_POST["tax_id"];
			}
			$_SESSION["message"] = lang('br_tax_update_success');
			if($continue == 1){
				$this->EE->functions->redirect($this->base_url.AMP.'method=config_tax_edit'.AMP.'tax_id='.$tax_id);
			}
			$this->EE->functions->redirect($this->base_url.AMP.'method=config_tax');
		}

	/**
	 * tools_clear_cache function.
	 * 
	 * @access public
	 * @return void
	 */
    	public function tools_clear_cache()
    	{
    		// First delete all the cache files
    			delete_file_cache();
    
    		// Set a success message 
    			$_SESSION["message"] = lang('br_tools_cache_delete');
    
    		// Redirect to dashboard 
    			$this->EE->functions->redirect($this->base_url.'&method=dashboard');
    	}
		
	/* Helper Functions */
		
	/**
	 * _ajax_url function.
	 * 
	 * @access private
	 * @return void
	 */
		function _ajax_url()
		{
			$url = $this->EE->functions->fetch_site_index(0,0);

			$host = (isset($_SERVER['HTTP_HOST']) == TRUE && $_SERVER['HTTP_HOST'] != FALSE) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
			$url = preg_replace('#http\://(([\w][\w\-\.]*)\.)?([\w][\w\-]+)(\.([\w][\w\.]*))?\/#', "http://".$host."/", $url);
			
			// Create new URL
			$this->ajax_url = $url.QUERY_MARKER.'ACT=';
		}
		
		
	/**
	 * _init_emails function.
	 * 
	 * @access private
	 * @return void
	 */
		private function _init_emails()
		{
			$path = PATH_THIRD.'brilliant_retail/core/notifications';
			$files = read_dir_files($path);
			
			$list = $this->EE->email_model->get_emails_by_site_id($this->site_id);
			$emails = array();
		
			foreach($files as $f){
				
				// skip hidden files
					if(substr($f,0,1) == '.') continue;

				// proceed
					$nm = substr($f,0,-4);
					if(isset($list[$nm])){
						$emails[$list[$nm]["title"]] = array(
																'email_id' => $list[$nm]["email_id"], 
																'title' => lang($nm),
																'version' => $list[$nm]["version"] 
															);
					}else{
						include_once(rtrim($path,"/")."/".$f);
						$url = rtrim($this->EE->config->item('site_url'),"/");
						$a = explode('/',$url);
						$email = rtrim('contact@'.$a[count($a)-1]);
						$data = array(
										'site_id' => $this->EE->config->item('site_id'),
										'title' => $nm,
										'version' => $msg["version"],
										'content' => $msg["content"],
										'subject' => isset($msg["subject"]) ? $msg["subject"] : lang($nm),   
										'from_name' => $this->EE->config->item('site_name'), 
										'from_email' => $email 
									);
						$data["email_id"] = $this->EE->email_model->create_email($data);							
						$emails[$nm] = $data;
					}
			}

			// Send all templates to the view
			$this->vars["emails"] = $emails;
		}
		
	/**
	 * _product_entry_id function.
	 * 
	 * @access private
	 * @param mixed $product_id
	 * @return void
	 */
		function _product_entry_id($product_id){
			if (isset($this->session->cache['product_entry_id'])){
				$products = $this->session->cache['product_entry_id'];
			}else{
				$this->EE->db->from('br_product_entry');		
				$query = $this->EE->db->get();
				$products = array();
				foreach ($query->result_array() as $row){
					$products[$row["product_id"]] =  $row["entry_id"];
				}
				$this->session->cache['product_entry_id'] = $products;
			}
			return $products[$product_id];
		}
		
	/**
	 * _get_sub_type function.
	 * 
	 * @access private
	 * @param string $type (default: '')
	 * @param mixed $allow_edit (default: FALSE)
	 * @return void
	 */
		function _get_sub_type($type = '',$allow_edit=FALSE) 
		{
			$str = ''; 

			$this->vars['product_search'] = $this->ajax_url.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 'product_search');			
			
			// File upload options for new or download products only
			
				if($type == '' || $type == 4){
					// Its downloadable or new! Lets try to get some uploaded files 
					// if they are available we need to get a list of possible 
						$this->vars["has_import"] 	= FALSE;
						$this->vars["imports"]		= array();
						
						if($this->_config["store"][$this->site_id]["downloads_use_local"]){
							$fl = read_dir_files($this->_config["media_dir"].'import');
					
							if(count($fl) > 0){
								$this->vars["has_import"] = TRUE;
								foreach($fl as $f){
									if(!is_dir($this->_config["media_dir"].'import/'.$f)){
										$this->vars["imports"][] = $f;
									}
								}
							}
						}
						
					// Do we allow S3 browsing of files?
						$this->vars["has_s3"] 		= FALSE;
						$this->vars["s3_buckets"] 	= array();
						$this->vars["s3_get_files"] = '';
						
						if($this->_config["store"][$this->site_id]["downloads_use_s3"]){
							$this->vars["has_s3"] = TRUE;
						
							// Get the buckets 
								$this->EE->load->library('aws');
								$this->EE->aws->AWSAccessKeyId 	= $this->_config["store"][$this->site_id]["downloads_s3_access_key"];
								$this->EE->aws->AWSSecretKey	= $this->_config["store"][$this->site_id]["downloads_s3_secret_key"];
								$this->vars["s3_buckets"] = $this->EE->aws->listBuckets();
								$this->vars["s3_get_files"] = 	$this->EE->functions->fetch_site_index()
																.QUERY_MARKER
																.'ACT='.$this->EE->cp->fetch_action_id('Brilliant_retail_mcp', 's3_get_files');
						}
				}
			
			// New products 					

			if($type != ''){
					$file = array(
									2 => 'bundle',
									3 => 'configurable',
									4 => 'downloadable', 
									7 => 'donation'
									);
					$str = '';				
					// Show all options for edit. 
					if($allow_edit == TRUE)
					{
						foreach($file as $f){
							$str .= $this->_view('product/sub_types/'.$f,$this->vars);
						}
					}else{
						// Only show the type if it exists
						if(isset($file[$type])){
							$str .= $this->_view('product/sub_types/'.$file[$type],$this->vars);
						}
					}
					$str .= "	<script type=\"text/javascript\">
									$(function(){
										$('#sub_type_".$type."').show();
									})
								</script>";
			}else{
				$a["bundle"] = $this->_view('product/sub_types/bundle',$this->vars);
				$a["configurable"] = $this->_view('product/sub_types/configurable',$this->vars);
				$a["downloadable"] = $this->_view('product/sub_types/downloadable',$this->vars);
				$a["donation"] = 	$this->_view('product/sub_types/donation',$this->vars);
				$str = 	$a["bundle"].$a["configurable"].$a["downloadable"].$a["donation"];
			}
			
			$str .= "	<script type=\"text/javascript\">
								$(function(){
									$('#type_id').bind('change',function(){
										var a = $(this).val();
										$('.subtypes').hide();
										$('#sub_type_'+a).show();
										
										// First we set reset all requireds to 1
											$('.sub_type_req').val(1);
										
										// Then we set the selected required to empty. 
											$('#sub_type_req_'+a).val('');
									});
								})
							</script>"; 
			return $str;
		}

    /**
     * _check_admin_access function.
     * 
     * Check for access to the admin sections 
     * 		 
     * @access private
     * @param mixed $method
     * @return void
     */
		function _check_admin_access($method){
			
			// Get the Group ID
				$group_id = $this->EE->session->userdata['group_id'];

			// Reset the index method to dashboard
				if($method == 'index'){
					$method = 'dashboard';
				}
			
			// Super Admins can go anywhere
				if($group_id == 1){
					// We are going to give the super admin access to 
					// all sections
					$f = get_class_methods('Brilliant_retail_mcp');
					foreach($f as $m){
						if(substr($m,0,1) != '_' && $m != 'index'){
							$this->group_access['brilliant_retail'][$m] = $m;
						}
					}
					return TRUE;
				}else{
					// all other memeber groups are validated
					if(!in_array($method,$this->method_ignore)){
						$this->group_access = $this->EE->access_model->get_admin_access($group_id);
						if(in_array($method,$this->group_access[$this->module])){
							return TRUE;
						}else{
							return FALSE;					
						}
					}else{
						$this->group_access = $this->EE->access_model->get_admin_access($group_id);
					} 
				}
			return TRUE;
		}

	/**
	 * _admin_permission_tree function.
	 * 
	 * @access public
	 * @param mixed $group_id
	 * @return void
	 */
		public function _admin_permission_tree($group_id)
		{
			$group = $this->EE->access_model->get_admin_access($group_id);
			
			// Get all our methods
				$f = get_class_methods('Brilliant_retail_mcp');
			
				foreach($f as $m){
					if(substr($m,0,1) != '_' && $m != 'index'){
						$methods[] = $m;
					}
				}
				#sort($methods);
			
			// Define a list of safe methods
			$tree = '<ul id="permmision_tree">';
			foreach($methods as $m){
				if(!in_array($m,$this->method_ignore)){
					$a = explode('_',$m);
					// Setup the css so that we can indent
						$b = count($a); 
						if($b == 1){
							$class = 'permission_parent';
							$level = 1;
						}elseif($b == 2){
							$class = 'permission_child' ;
							$level = 2;
						}else{
							$class = 'permission_child-child' ;
							$level = 3;
						}
					// Set input to checked if permission 
						$chk = '';
						if(isset($group[$this->module])){
							if(in_array($m,$group[$this->module])){
								$chk = 'checked="checked"';
							}
						}
					$tree .= '	<li class="'.$class.' level_'.$level.'">
									<input type="checkbox" name="permissions[]" class="permmision_checkbox" value="'.$this->module.'|'.$m.'" '.$chk.' />&nbsp;'.lang('nav_br_'.$m).'
								</li>';
				}
			}
			$tree .= '</ul>';
			return $tree;
		}
		
	/**
	 * _check_product_sku function.
	 * 
	 * @access private
	 * @param mixed $data
	 * @param int $cnt (default: 1)
	 * @return void
	 */
		function _check_product_sku($data,$cnt=1)
		{
				if(trim($data["sku"]) == ''){
					$data["sku"] = str_replace(" ","-",strtolower($data["title"]));
				}
				$data["sku"] = preg_replace('/[^A-Za-z0-9-_]/','',$data["sku"]);
				$count = $this->EE->product_model->_check_sku($data["sku"],$data["product_id"]);
				if($count == 0){
					return $data["sku"];
				}else{
					$data["sku"] = $data["sku"].'-'.$cnt;
					return $this->_check_product_sku($data,$cnt++);
				}
			}
			
	/**
	 * _check_product_url function.
	 * 
	 * @access private
	 * @param mixed $data
	 * @param int $cnt (default: 1)
	 * @return void
	 */
		function _check_product_url($data,$cnt=1)
		{
			if(trim($data["url"]) == ''){
				$data["url"] = str_replace(" ","-",strtolower($data["title"]));
			}
			$data["url"] = strtolower(preg_replace('/[^A-Za-z0-9-_]/','',$data["url"]));
			$count = $this->EE->product_model->_check_url($data["url"],$data["product_id"]);
			if($count == 0){
				return $data["url"];
			}else{
				$data["url"] = $data["url"].'-'.$cnt;
				return $this->_check_product_url($data,$cnt++);
			}			
		}
			
	/**
	 * _check_category_url function.
	 * 
	 * @access private
	 * @param mixed $data
	 * @param int $cnt (default: 1)
	 * @return void
	 */
		function _check_category_url($data,$cnt=1)
		{
  			if(version_compare(APP_VER, '2.7.0', '>=')){
				$this->EE->security->restore_xid();
			}

			// If the url_title is blank we better default one
                if(trim($data["url_title"]) == ''){
                    $data["url_title"] = str_replace(" ",$sep,strtolower(trim($data["title"])));
    			}

            // We should use the core seperator for EE 
    			$sep = ($this->EE->config->item('word_separator') == 'dash') ? '-' : '_';
			
			// Need to clean out an special characters and 
			// recursively check to make sure that we aren't 
			// creating any double seperators. 
                $data["url_title"] = strtolower(preg_replace('/[^A-Za-z0-9-_]/',$sep,trim($data["url_title"])));
			    $data["url_title"] = trim($data["url_title"],$sep);

                // Replace the double instance.
                    $pattern = '/'.$sep.$sep.'+/';
                    $data["url_title"] = preg_replace($pattern,$sep,$data["url_title"]);

			// If its new lets just say teh category_id is 0 
			// so it plays nicely with our model then 
			// check that there are no duplicates in the system
    			if(!isset($data["category_id"])){
    				$data["category_id"] = 0;
    			}
    			$count = $this->EE->product_model->_check_url($data["url_title"],$data["category_id"]);
			
			// If no dupes we're good. If not append a count and go again
    			if($count == 0){
    				return $data["url_title"];
    			}else{
    				$data["url_title"] = $data["url_title"].'-'.$cnt;
    				return $this->_check_category_url($data,$cnt++);
    			}
		}
			
	/**
	 * _build_report_input function.
	 * 
	 * @access private
	 * @param mixed $in
	 * @return void
	 */
		function _build_report_input($in)
		{
			$val = $this->EE->input->post($in[2]);
			$str = '';
			if($in[0] == 'date'){
				// Set the post variables
					$range = $this->EE->input->post($in[2]);
					$st = $this->EE->input->post($in[2].'_st');
					$end = $this->EE->input->post($in[2].'_end');
				
				// Do we hide the custom date fields?
					$class = ($range != 'custom') ? 'nodisplay' : '';
				
				$str .= '	<label>'.lang($in[1]).'</label>
							<select name="'.$in[2].'" id="'.$in[2].'">';
							
					// Check for a selection in the post (i.e. $range) 
					
					$options = array('week','month','year','l_week','l_month','l_year','all','custom');
					
					foreach($options as $opt){
						$sel = ($opt == $range) ? 'selected' : '' ;
						$str .= '<option value="'.$opt.'" '.$sel.'>'.lang('br_'.$opt).'</option>';
					}

				$str .= '	</select>
							<br />
							<div id="'.$in[2].'_custom" class="'.$class.'">
								<label>'.lang('br_start').'</label><input type="text" name="'.$in[2].'_st" class="datepicker" value="'.$st.'" />
								<label>'.lang('br_end').'</label><input type="text" name="'.$in[2].'_end" class="datepicker" value="'.$end.'" />
							</div>
						<script type="text/javascript">
							$(function(){
								$(\'#'.$in[2].'\').change(function(){
									var a = $(\'#'.$in[2].'_custom\');
									if($(this).val() == \'custom\'){
										a.show();
									}else{
										a.hide();
									}	
								});
							});
						</script>';
			}else{
				$str .= '<label>'.$in[1].'</label><input type="text" name="'.$in[2].'" value="'.$val.'" />';
			}
			return $str;
		}
			
	/**
	 * _build_report_csv function.
	 * 
	 * @access private
	 * @param mixed $data
	 * @return void
	 */
		function _build_report_csv($data)
		{
			$csvoutput = '';
			$csvoutput .= join(",",$data["header"])."\n";
			foreach($data["results"] as $r){
				$csvoutput .= strip_tags(join(",",$r))."\n";
			}
			header ( "Content-Type: application/force-download" );
			header ( "Content-Type: application/octet-stream" );
			header ( "Content-Type: application/download" );
			header ( "Content-Type: text/csv" );
			header ( 'Content-Disposition: attachment; filename="Report_'.time().'.csv"');
			header ( "Content-Transfer-Encoding: binary" );
			header ( "Accept-Ranges: bytes" );
			header ( "Content-Length: ".strlen ( $csvoutput ) );
			echo $csvoutput;
			exit();
		}
		
	/**
	 * _build_configurable_form function.
	 * 
	 * @access private
	 * @param mixed $fields
	 * @param string $values (default: '')
	 * @return void
	 */
		function _build_configurable_form($fields,$values = '')
		{
			$str = '<input id="config_attr" name="config_attr" type="hidden" value="'.join($fields,',').'" />
					<h4 style="margin-bottom:5px">'.lang('br_create_config_options').'</h4>
					<table id="configurable_form" class="product_edit" width="100%" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th>
									'.lang('br_title').'</th>
								<th>
									'.lang('br_create_config_options').'</th>
							</tr>
						</thead>';
						
			$headings = '';
            error_log(print_r($fields,1));
			foreach($fields as $f){                                
				$attr 		= $this->EE->product_model->get_attribute_by_id($f);                                
				$headings 	.= '<th>'.@$attr["title"].'</th>';
				$opt 		= $this->_configurable_dropdown(@$attr["attribute_id"],@$attr["title"],'',0,'',@$attr["options"]);
				$str 		.= '<tr><td>'.@$attr["title"].'</td><td>'.$opt.'</td></tr>';
			}		
						
			$str .=	'	<tr>
							<td>&nbsp;</td>
							<td>
								<div id="configurableCreate" class="button"><a class="submit" href="#">'.lang('create').'</a></div></td>
						</tr>
						</table>
								<h4 style="margin-bottom:5px">'.lang('br_products').'</h4>
								<table id="config_selected" class="product_edit" width="100%" cellpadding="0" cellspacing="0"><thead>'
						.$headings.
						'	<th>'.lang('br_sku').'</th>
							<th>'.lang('br_quantity').'</th>
							<th>'.lang('br_price_adjust').'</th>
							<th colspan="2">'.lang('br_actions').'</th>';
												
			$str .= '			</thead><tbody>'.$values.'</tbody></table>';
			return $str;
		}
			
	/**
	 * _view function.
	 * 
	 * @access private
	 * @param mixed $view
	 * @param mixed $vars
	 * @return void
	 */
		function _view($view,$vars){
			if(file_exists(PATH_THIRD.'_local/brilliant_retail/views/'.trim($view).'.php')){
				$this->EE->load->add_package_path(PATH_THIRD.'_local/brilliant_retail');
				$output = $this->EE->load->view($view,$vars,TRUE);	
				$this->EE->load->remove_package_path();
			}else{
				$this->EE->load->add_package_path(PATH_THIRD.'brilliant_retail');
				$output = $this->EE->load->view($view,$vars,TRUE);	
			}
			return $output;
		}
		
	/**
	 * _get_upload_preferences function.
	 * 
     * Thanks Brandon Kelly for this Cross-compatible between ExpressionEngine 2.0 and 2.4
     * Referenced: https://gist.github.com/1671737
	 * 
	 * @access private
	 * @param mixed $group_id (default: NULL)
	 * @param mixed $id (default: NULL)
	 * @return void
	 */
		function _get_upload_preferences($group_id = NULL, $id = NULL)
		{
			if (version_compare(APP_VER, '2.4', '>='))
			{
				$this->EE->load->model('file_upload_preferences_model');
				return $this->EE->file_upload_preferences_model->get_file_upload_preferences($group_id, $id);
			}
		
			if (version_compare(APP_VER, '2.1.5', '>='))
			{
				$this->EE->load->model('file_upload_preferences_model');
				$result = $this->EE->file_upload_preferences_model->get_upload_preferences($group_id, $id);
			}
				$this->EE->load->model('tools_model');
				$result = $this->EE->tools_model->get_upload_preferences($group_id, $id);
			
			// If an $id was passed, just return that directory's preferences
			if ( ! empty($id))
			{
				return $result->row_array();
			}
		
			// Use upload destination ID as key for row for easy traversing
			$return_array = array();
			foreach ($result->result_array() as $row)
			{
				$return_array[$row['id']] = $row;
			}
		
			return $return_array;
		}

	/**
	 * _check_store_channel function.
	 * 
     * Method checks to see if there is a paired 
	 * channel_id for a store
     * 
	 * @access private
	 * @return void
	 */
    	function _check_store_channel(){
    
    		$this->EE->load->library('api'); 
    		$this->EE->api->instantiate('channel_structure');
    		$this->EE->api->instantiate('channel_entries');
    		$this->EE->api->instantiate('channel_fields');
    
    		$reset_config = FALSE;
    		
    		foreach($this->_config["store"] as $store){
    
    			if($store["channel_id"] == 0){
    			
    				// We will want to reset the _config variable 
    				// when we're all done. 
    					$reset_config = TRUE;
    			
    				// Create a field group for the site
    					$data = array(	
    									"site_id" 		=> $store["site_id"],
    									"group_name" 	=> "BrilliantRetail Products"
    								);
    					$this->EE->db->insert("field_groups",$data);
    					$field_group = $this->EE->db->insert_id();
    				
    				// Create a channel for the site
    					$channel = array(
    										"site_id"		=> $store["site_id"],
    										"field_group"	=> $field_group, 
    										"channel_title" => "BrilliantRetail Products",
    										"channel_name"	=> "brilliantretail_".$store["site_id"] 
    									);
    					
    					$this->br_channel_id = $this->EE->api_channel_structure->create_channel($channel);
    					
    					$this->EE->session->userdata['assigned_channels'][$this->br_channel_id] = $channel['channel_title'];
    				
    				// Create a matching channel entry for every product
    					$this->EE->db->from('br_product');
    					$this->EE->db->WHERE('site_id',$store["site_id"]);
    					$qry = $this->EE->db->get();
    					foreach($qry->result_array() as $rst){
    						$data = array(
    						        'title'         => $rst["title"],
    						        'status'		=> ($rst["enabled"] == 1) ? 'open' : 'closed', 
    						        'entry_date'    => time() 
    						);
    						$this->EE->api_channel_entries->submit_new_entry($this->br_channel_id,$data);	
    						$qry = $this->EE->db->query("SELECT entry_id FROM exp_channel_titles ORDER BY entry_id DESC LIMIT 1");
    						$result = $qry->result_array();
    
    						$this->EE->db->query("	INSERT INTO 
    													exp_br_product_entry 
    												(product_id, entry_id) 
    													VALUES 
    												(".$rst["product_id"].",".$result[0]["entry_id"].")");
    						
    						// Remove cache file
    							remove_from_cache('product_'.$rst["product_id"]);
    					}
    
    				// Update the br_store table with the new 
    				// channel_id value	
    					$data = array(
    		               			'channel_id' => $this->br_channel_id
    		               		);
    					$this->EE->db->where('site_id', $store["site_id"]);
    					$this->EE->db->update('br_store', $data);
    			}
    		}
    		
    		if($reset_config == TRUE){
    			remove_from_cache('config');
    		}
    
    	}	
	
	/**
	 * _check_product_entry_pair function.
	 * 
     * Create a method for verifying that there is a product and 
	 * entry for all products in the system
	 * 
	 * @access private
	 * @return void
	 */
    	function _check_product_entry_pair(){
    		$this->EE->load->database();
    		$sql = "SELECT 
    					p.product_id, 
    					p.title, 
    					p.enabled 
    				FROM 
    					".$this->EE->db->dbprefix."br_product p 
    				WHERE 
    					p.site_id = ".$this->vars["site_id"]." 
    				AND 
    					p.product_id 
    						NOT IN 
    							(SELECT product_id FROM ".$this->EE->db->dbprefix."br_product_entry)";
    		$qry = $this->EE->db->query($sql);
    		if($qry->num_rows() >= 0){
    			
    			foreach($qry->result_array() as $rst){
    				$data = array(
    				        'title'         => $rst["title"],
    				        'status'		=> ($rst["enabled"] == 1) ? 'open' : 'closed', 
    				        'entry_date'    => time() 
    				);
    				$this->EE->api_channel_entries->submit_new_entry($this->br_channel_id,$data);	
    				$qry = $this->EE->db->query("SELECT entry_id FROM exp_channel_titles ORDER BY entry_id DESC LIMIT 1");
    				$result = $qry->result_array();
    
    				$this->EE->db->query("	INSERT INTO 
    											exp_br_product_entry 
    										(product_id, entry_id) 
    											VALUES 
    										(".$rst["product_id"].",".$result[0]["entry_id"].")");
    				
    				// Remove cache file
    					remove_from_cache('product_'.$rst["product_id"]);
    			}
    		}
    	}

	/**
	 * s3_get_files function.
	 * 
	 * @access public
	 * @return void
	 */
    	public function s3_get_files()
    	{	
    		$bucket = $this->EE->input->get('bucket');
    		
    		// Get the buckets 
    		$this->EE->load->library('aws');
    		$this->EE->aws->AWSAccessKeyId 	= $this->_config["store"][$this->site_id]["downloads_s3_access_key"];
    		$this->EE->aws->AWSSecretKey	= $this->_config["store"][$this->site_id]["downloads_s3_secret_key"];
    		$list = $this->EE->aws->listFiles($bucket);
    		echo json_encode($list);
    		exit;
    	}
	
	/************************************************/
	/* The section below includes helper functions	*/
	/* required by the Channel Fieldtypes. 			*/ 
	/************************************************/

	/**
	 * _setup_file_list function.
	 * 
	 * @access private
	 * @return void
	 */
		private function _setup_file_list()
		{
			$this->EE->load->model('file_upload_preferences_model');
			
			$upload_directories = $this->EE->file_upload_preferences_model->get_file_upload_preferences($this->EE->session->userdata('group_id'));
			
			$this->_file_manager = array(
				'file_list'						=> array(),
				'upload_directories'			=> array(),
			);
		
			$fm_opts = array(
								'id', 'name', 'url', 'pre_format', 'post_format', 
								'file_pre_format', 'file_post_format', 'properties', 
								'file_properties'
							);
		
			foreach($upload_directories as $row)
			{
				$this->_file_manager['upload_directories'][$row['id']] = $row['name'];
	
				foreach($fm_opts as $prop)
				{
					$this->_file_manager['file_list'][$row['id']][$prop] = $row[$prop];
				}
			}
		}

	/**
	 * _markitup function.
	 * 
	 * @access private
	 * @return void
	 */
    	function _markitup()
    	{
    		$this->EE->load->model('admin_model');
    		
    		$html_buttons = $this->EE->admin_model->get_html_buttons($this->EE->session->userdata('member_id'));
    		$button_js = array();
    		$has_image = FALSE;
    		
    		foreach ($html_buttons->result() as $button)
    		{
    			if (strpos($button->classname, 'btn_img') !== FALSE)
    			{
    				// images are handled differently because of the file browser
    				// at least one image must be available for this to work
    				$has_image = TRUE;
    												
    				if (count($this->_file_manager['file_list']))
    				{
    					$button_js[] = array('name' => $button->tag_name, 'key' => $button->accesskey, 'replaceWith' => '', 'className' => $button->classname);
    					$this->EE->javascript->set_global('filebrowser.image_tag', $button->tag_open);
    				}
    			}
    			elseif(strpos($button->classname, 'markItUpSeparator') !== FALSE)
    			{
    				// separators are purely presentational
    				$button_js[] = array('separator' => '---');
    			}
    			else
    			{
    				$button_js[] = array('name' => $button->tag_name, 'key' => strtoupper($button->accesskey), 'openWith' => $button->tag_open, 'closeWith' => $button->tag_close, 'className' => $button->classname);
    			}
    		}
    		
    		// We force an image button if it doesn't already exist
    		if ($has_image == FALSE && count($this->_file_manager['file_list']))
    		{
    			$button_js[] = array('name' => 'img', 'key' => '', 'replaceWith' => '', 'className' => 'btn_img');
    			$this->EE->javascript->set_global('filebrowser.image_tag', '<img src="[![Link:!:http://]!]" alt="[![Alternative text]!]" />');			
    		}
    		
    		$this->EE->javascript->set_global('p.image_tag', 'foo you!');
    
    		$markItUp = $markItUp_writemode = array(
    			'nameSpace'		=> "html",
    			'onShiftEnter'	=> array('keepDefault' => FALSE, 'replaceWith' => "<br />\n"),
    			'onCtrlEnter'	=> array('keepDefault' => FALSE, 'openWith' => "\n<p>", 'closeWith' => "</p>\n"),
    			'markupSet'		=> $button_js,
    		);
    
    		// -------------------------------------------
    		//	Hidden Configuration Variable
    		//	- allow_textarea_tabs => Add tab preservation to all textareas or disable completely
    		// -------------------------------------------
    
    		if ($this->EE->config->item('allow_textarea_tabs') == 'y')
    		{
    			$markItUp['onTab'] = array('keepDefault' => FALSE, 'replaceWith' => "\t");
    			$markItUp_writemode['onTab'] = array('keepDefault' => FALSE, 'replaceWith' => "\t");
    		}
    		elseif ($this->EE->config->item('allow_textarea_tabs') != 'n')
    		{
    			$markItUp_writemode['onTab'] = array('keepDefault' => FALSE, 'replaceWith' => "\t");
    		}
    
    		$markItUp_nobtns = $markItUp;
    		unset($markItUp_nobtns['markupSet']);
    
    		$this->EE->cp->add_js_script(array("
    			<script type=\"text/javascript\" charset=\"utf-8\">
    			// <![CDATA[
    			mySettings = ".json_encode($markItUp).";
    			myNobuttonSettings = ".json_encode($markItUp_nobtns).";
    			myWritemodeSettings = ".json_encode($markItUp_writemode).";
    			// ]]>
    			</script>
    
    		"), FALSE);
    
    		$this->EE->javascript->set_global('publish.show_write_mode', ($this->_channel_data['show_button_cluster'] == 'y') ? TRUE : FALSE);
    	}
		
	/**
	 * _load_channel_data function.
	 * 
	 * @access private
	 * @param mixed $channel_id
	 * @return void
	 */
    	private function _load_channel_data($channel_id)
    	{
    		$this->EE->load->model('channel_model');
    		$query = $this->EE->channel_model->get_channel_info($channel_id);
    		$row = $query->row_array();
    		return $row;
    	}
	
	/**
	 * _prep_field_wrapper function.
	 * 
	 * @access private
	 * @param mixed $field_list
	 * @return void
	 */
    	private function _prep_field_wrapper($field_list)
    	{
    		$defaults = array(
    			'field_show_spellcheck'			=> 'n',
    			'field_show_smileys'			=> 'n',
    			'field_show_glossary'			=> 'n',
    			'field_show_formatting_btns'	=> 'n',
    			'field_show_writemode'			=> 'n',
    			'field_show_file_selector'		=> 'n',
    			'field_show_fmt'				=> 'n',
    			'field_fmt_options'				=> array()
    		);
    		
    		$markitup_buttons = array();
    		$get_format = array();
    	
    		foreach ($field_list as $field => &$data)
    		{
    			$data['has_extras'] = FALSE;
    			
    			foreach($defaults as $key => $val)
    			{
    				if (isset($data[$key]) && $data[$key] == 'y')
    				{
    					$data['has_extras'] = TRUE;
    					continue;
    				}
    
    				$data[$key] = $val;
    			}
    			
    			if ($data['field_show_smileys'] == 'y' && $this->vars["smileys_enabled"] === TRUE)
    			{
    				$data['smiley_table'] = $this->_build_smiley_table($field);
    			}
    			
    			if ($data['field_show_fmt'] == 'y')
    			{
    				// We'll get all the format options in one go
    				$get_format[] = $data['field_id'];
    			}
    			
    			if ($this->_channel_data['show_button_cluster'] == 'y' && isset($data['field_show_formatting_btns']) && $data['field_show_formatting_btns'] == 'y')
    			{
    				$markitup_buttons['fields'][$field] = $data['field_id'];
    			}
    		}
    		
    		// Field formatting
    		if (count($get_format) > 0)
    		{
    			$this->EE->db->select('field_id, field_fmt');
    			$this->EE->db->where_in('field_id', $get_format);
    			$this->EE->db->order_by('field_fmt');
    			$query = $this->EE->db->get('field_formatting');
    
    			if ($query->num_rows() > 0)
    			{
    				foreach ($query->result_array() as $format)
    				{
    					$name = ucwords(str_replace('_', ' ', $format['field_fmt']));
    			
    					if ($name == 'Br')
    					{
    						$name = lang('auto_br');
    					}
    					elseif ($name == 'Xhtml')
    					{
    						$name = lang('xhtml');
    					}
    					
    					$field_list['field_id_'.$format['field_id']]['field_fmt_options'][$format['field_fmt']] = $name;
    				}
    			}
    		}
    		
    		$this->EE->javascript->set_global('publish.markitup', $markitup_buttons);
    		
    		return $field_list;
    	}
	
	/**
	 * _build_smiley_table function.
	 * 
	 * @access private
	 * @param mixed $field_name
	 * @return void
	 */
    	private function _build_smiley_table($field_name)
    	{		
    		$this->EE->load->library('table');
    
    		$this->EE->table->set_template(array(
    			'table_open' => 
    			'<table style="text-align: center; margin-top: 5px;" cellspacing="0" class="mainTable padTable smileyTable">'
    		));
    
    		$image_array = get_clickable_smileys($this->EE->config->slash_item('emoticon_url'),$field_name);
    		$col_array = $this->EE->table->make_columns($image_array, 8);
    		$smilies = '<div class="smileyContent" style="display: none;">';
    		$smilies .= $this->EE->table->generate($col_array).'</div>';
    		$this->EE->table->clear();
    		
    		return $smilies;
    	}
	
	/**
	 * _set_global_js function.
	 * 
	 * @access private
	 * @param mixed $entry_id
	 * @return void
	 */
    	private function _set_global_js($entry_id)
    	{
    		$autosave_interval_seconds = ($this->EE->config->item('autosave_interval_seconds') === FALSE) ? 60 : $this->EE->config->item('autosave_interval_seconds');
    
    		//	Create Foreign Character Conversion JS
    		include(APPPATH.'config/foreign_chars.php');
    
    		/* -------------------------------------
    		/*  'foreign_character_conversion_array' hook.
    		/*  - Allows you to use your own foreign character conversion array
    		/*  - Added 1.6.0
    		* 	- Note: in 2.0, you can edit the foreign_chars.php config file as well
    		*/  
    			if (isset($this->extensions->extensions['foreign_character_conversion_array']))
    			{
    				$foreign_characters = $this->extensions->call('foreign_character_conversion_array');
    			}
    		/*
    		/* -------------------------------------*/
    
    		$date_fmt = ($this->EE->session->userdata('time_format') != '') ? $this->EE->session->userdata('time_format') : $this->EE->config->item('time_format');
    
    		$this->EE->javascript->set_global(array(
    			'date.format'						=> $date_fmt,
    			'lang.add_new_html_button'			=> lang('add_new_html_button'),
    			'lang.add_tab' 						=> lang('add_tab'),
    			'lang.close' 						=> lang('close'),
    			'lang.confirm_exit'					=> lang('confirm_exit'),
    			'lang.duplicate_tab_name'			=> lang('duplicate_tab_name'),
    			'lang.hide_toolbar' 				=> lang('hide_toolbar'),
    			'lang.illegal_characters'			=> lang('illegal_characters'),
    			'lang.loading'						=> lang('loading'),
    			'lang.tab_name'						=> lang('tab_name'),
    			'lang.show_toolbar' 				=> lang('show_toolbar'),
    			'lang.tab_name_required' 			=> lang('tab_name_required'),
    			'publish.channel_id'				=> $this->_channel_data['channel_id'],
    			'publish.default_entry_title'		=> $this->_channel_data['default_entry_title'],
    			'publish.field_group'				=> $this->_channel_data['field_group'],
    			'publish.foreignChars'				=> $foreign_characters,
    			'publish.lang.layout_removed'		=> lang('layout_removed'),
    			'publish.lang.no_member_groups'		=> lang('no_member_groups'),
    			'publish.lang.refresh_layout'		=> lang('refresh_layout'),
    			'publish.lang.tab_count_zero'		=> lang('tab_count_zero'),
    			'publish.lang.tab_has_req_field'	=> lang('tab_has_req_field'),
    			'publish.markitup.foo'				=> FALSE,
    			'publish.smileys'					=> ($this->vars["smileys_enabled"]) ? TRUE : FALSE,
    			'publish.url_title_prefix'			=> $this->_channel_data['url_title_prefix'],
    			'publish.which'						=> ($entry_id === 0) ? 'new' : 'edit',
    			'publish.word_separator'			=> $this->EE->config->item('word_separator') != "dash" ? '_' : '-',
    			'user.can_edit_html_buttons'		=> $this->EE->cp->allowed_group('can_edit_html_buttons'),
    			'user.foo'							=> FALSE,
    			'user_id'							=> $this->EE->session->userdata('member_id'),
    			'upload_directories'				=> $this->_file_manager['file_list'],
    		));
    	}


}	
