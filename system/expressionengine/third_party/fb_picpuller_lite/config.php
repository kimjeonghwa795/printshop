<?php

 /**
 * Pic Puller Lite for Instagram
 *
 * @package			Ig_pic_puller
 * @author 			John Morton
 * @copyright		Copyright (c) 2012 - 2014, John Morton
 *
 */

if ( ! defined('PP_FB_NAME')) {
	define('PP_FB_NAME', 'Pic Puller Lite for Facebook');
	define('PP_FB_PACKAGE', 'fb_picpuller_lite');
	define('PP_FB_VERSION', '1.5.5');
	define('PP_FB_DOCS', 'http://picpuller.com');
	define('PP_FB_DEBUG', FALSE);
}

$config['name'] = PP_FB_NAME;
$config['version']= PP_FB_VERSION;

//$config['nsm_addon_updater']['versions_xml']='http://static.supergeekery.com/nsm_addon_updater/changelog_ig_picpuller_lite.xml';