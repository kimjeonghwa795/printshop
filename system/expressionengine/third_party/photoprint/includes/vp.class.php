<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vp
 *
 * @author novan
 */
class VP {
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
    
    
    
}
