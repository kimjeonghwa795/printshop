<?php

if ( ! defined( 'ABSPATH' ) ) exit('No Direct access');


class ImageUploader {
    public $name;
    public $version;
    private static $instance;
    
    public function __construct() {
        $this->name     = 'virtual_product';
        $this->version  = '0.0.1';
    }

    public static function get_instance() {
        if( null == self::$instance ) {
                self::$instance = new ImageUploader();
        } 
        return self::$instance;
    }
    
    public function run(){
        
    }
    
    
    public function page(){
        
    }
    
    function createPage(){
        global $wpdb;
        $pageTitle = 'Photo Manager';
        $pageName = 'PhotoManager';

        // the menu entry...
        $option = ($pageTitle .'_page_title');
        delete_optiont($option);
        add_option($option, $pageTitle, '', 'yes');
        // the slug...
        $option = ($pageName .'_page_name');

        delete_option($option);
        add_option($option, $$pageName, '', 'yes');
        // the id...
        $option = ($pageName .'_page_id');
        delete_option($option);
        add_option($option, '0', '', 'yes');

        $the_page = get_page_by_title( $pageTitle );   
        
        if ( ! $the_page ) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $pageTitle;
        $_p['post_content'] = $this->pageContent();
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'

        // Insert the post into the database
        $the_page_id = wp_insert_post( $_p );

        }
        else {

            $the_page_id = $the_page->ID;
            $the_page->post_status = 'publish';
            $the_page_id = wp_update_post( $the_page );
        }
                
    }
    
    function pageContent(){        
        echo 'helloworld!!!';
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
    }
    
    function plugin_deactivation(){
        VirtualProductDB::dbRemove();                
    }
    
    function plugin_action_links(){
        
    }
    
    
    
    
}
