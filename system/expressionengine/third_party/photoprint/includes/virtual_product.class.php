<?php


/**
 * Description of virtual_product-class
 *
 * @author novan
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if ( ! class_exists( 'VirtualProductDB' ) ) {
    include 'db.class.php';
}
if ( ! class_exists( 'ImageUploader' ) ) {
    include 'image_uploader.class.php';
}

class VirtualProduct {
    var $name;
    var $version;
    public function __construct() {
        $this->name     = 'virtual_product';
        $this->version  = '0.0.1';
    }

    public function enqueue_scripts() {

            wp_enqueue_media();

            wp_enqueue_script(
                    $this->name,
                    plugin_dir_url( __FILE__ ) . 'assets/js/upload_photo.js',
                    array( 'jquery' ),
                    $this->version,
                    'all'
            );

    }

    public function enqueue_styles() {

	wp_enqueue_style(
                    $this->name,
                    plugin_dir_url( __FILE__ ) . 'assets/css/upload_photo.css',
                    array()
		);
    }
    

    function before_cart(){
        $location  = plugins_url( '/customize.php',dirname((__FILE__)));
        wp_redirect($location);
        
    }
    
    function customize_product(){
        echo 'customize product';
    }
    
    function plugin_activation(){
        VirtualProductDB::dbInstall();
        
        $uploader = new ImageUploader();        
        $uploader ->createPage();
                
    }    
    
    function plugin_deactivation(){
        VirtualProductDB::dbRemove();                
    }
    
    function plugin_action_links(){
        
    }
    
    
    
    
}
