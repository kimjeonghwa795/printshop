<?php

 /**
 * Pic Puller Lite for Instagram
 *
 * @package			Ig_pic_puller
 * @author 			John Morton
 * @copyright		Copyright (c) 2012 - 2014, John Morton
 *
 */

if ( ! defined('PP_IG_NAME')) {
	define('PP_IG_NAME', 'Pic Puller Lite for Instagram');
	define('PP_IG_PACKAGE', 'ig_picpuller_lite');
	define('PP_IG_VERSION', '1.5.5');
	define('PP_IG_DOCS', 'http://picpuller.com');
	define('PP_IG_DEBUG', FALSE);
}

$config['name'] = PP_IG_NAME;
$config['version']= PP_IG_VERSION;

$config['nsm_addon_updater']['versions_xml']='http://static.supergeekery.com/nsm_addon_updater/changelog_ig_picpuller_lite.xml';