<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class PhotoPrint_mcp {
    
    function __construct() {
        $this->ee =& get_instance();
    }
    function index(){
        echo 'HELLO WORD';
    }
}