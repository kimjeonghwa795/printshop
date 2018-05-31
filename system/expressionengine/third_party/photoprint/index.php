<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('max_execution_time',0);
define('PHOTOPRINT_MODULE_PATH',  dirname($_SERVER['SCRIPT_FILENAME']) );
define('PHOTOPRINT_WORKING_DIR',  'D:/srv/nginx/html/ex/working/' );
include('includes/photoprint.class.php');

$order_id   = $_REQUEST['order_id'];
$layout_id  = $_REQUEST['layout_id'] ;


$pp = new PhotoPrint($order_id,$layout_id);
$pp->getImage();