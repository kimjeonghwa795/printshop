<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$plugin_info = array(
            'pi_name'           => 'Social Meta',
            'pi_version'	=> '1.4',
            'pi_author'		=> 'Novan',
            'pi_author_url'	=> 'http://www.vardion.net/',
            'pi_description'	=> 'Social Media Ready Meta tags for all your pages',
            'pi_usage'            => social_meta::usage()
);

class Social_meta {
    var $data_arr;
    var $name_arr ;
    var $prop_arr ;
    var $item_arr ;
    public function __construct(){
        $this->collect();        
        foreach ($this->data_arr as $name => $content){
            $this->classify_meta($name,$content);
        }        
        ksort($this->name_arr);
        ksort($this->prop_arr);
        ksort($this->item_arr);
        $s = '';
        foreach ($this->name_arr as $k => $v){
            $s  .= '<meta property="'. $k .'" content="' . $v .'"/>';
        }
        foreach ($this->item_arr as $k => $v){
            $s  .= '<meta itemprop="'. $k .'" content="' . $v .'"/>';
        }
        foreach ($this->prop_arr as $k => $v){
            $s  .= '<meta property="'. $k .'" content="' . $v .'"/>';
        }
        
        return $s;
    }
    
    
    function classify_meta($name,$content){        
        $normal_render = true;        
        
        $arr  = array();
        if (is_array($content)){
            $content = implode(', ', $content);            
        }
        $content = htmlspecialchars($content,ENT_QUOTES);
        
        switch ($name) {
        case 'title': {                
                $this->item_arr[$name] = $content;
                $this->item_arr[$name] = $content;
                $this->item_arr[$name] = $content;                
                $normal_render = FALSE;
                break;
            }
        case 'keywords':{
                $content = explode(', ',$content);                
                $this->prop_arr['article:tag'] = $content;
                
            }                
        case 'type':{                
                $this->prop_arr['og:'.$name] = $content; 
                $normal_render = false;
            }        
        case 'name':{
                $this->prop_arr['og:site_name'.$name] = $content; 
                $this->item_arr[$name] = $content;
                $this->name_arr['twitter:card'] = $content;                
                $normal_render = false;
                break;
            }
        case 'description':{
                $this->prop_arr['og:'.$name] = $content; 
                $this->item_arr[$name] = $content;
                $this->name_arr['twitter:'.$name] = $content;
                break;
             }
        
        case 'url':{                
                $this->prop_arr['og:'.$name] = $content;                                
                $normal_render = false;        
                break;
            }
        
        case 'image':{                
                $this->name_arr['twitter:'.$name] = $content;
                $this->item_arr[$name] = $content;
                $this->prop_arr['og:'.$name] = $content;                                
                $normal_render = false;
                break;
             }
        }
        
        if ($normal_render){
            $this->name_arr[$name] = $content;
        }
        return ($arr);
        
            
    }
    
    public function collect(){
        
    }
    
    function usage(){
        
    }
}
