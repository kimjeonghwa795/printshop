<?php
/********************************************************************************/
/* IMPORTANT NOTICE																*/
/* 																				*/
/* This file should not be edited. It is a core package file and will be 		*/
/* overwritten with updates. 													*/
/* 																				*/
/* If you need to add your own config variables they should be added 			*/
/* to the /system/expressionengine/config/config.php file. 						*/
/* 																				*/
/********************************************************************************/

if ( ! defined('BR_VERSION')) {
    define('BR_VERSION','1.7.0.0');
}

$config['name']			=	'BrilliantRetail';
$config['version'] 		= 	BR_VERSION;
$config['nsm_addon_updater']['versions_xml'] = 'https://www.brilliantretail.com/version.xml';
$config['br_license'] = '7f32886e-9b03-458e-a589-c4c230df4761';
$config['br_display_out_of_stock'] = TRUE;
$config['br_suppress_new_account_email'] = TRUE;
$config['br_disable_product_cache'] = TRUE;
$config['br_config_hide_adjust_total'] ='y';
$config['br_suppress_new_order_email'] = FALSE;
//$config['br_checkout_thankyou_order_id'] = 1001;

$config['br_autologin'] = 'y';
