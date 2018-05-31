<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( __DIR__ . '/config.php');
$plugin_info = array(
	'pi_name'		=> 'Google Maps Plugins',
	'pi_version'		=> '1.3.5',
	'pi_author'		=> 'Novan Firmansyah',
	'pi_author_url'		=> 'http://ellislab.com/',
	'pi_description'	=> 'Show Simple google maps',
	'pi_usage'		=> Google_maps::usage()
);
class Google_maps {

    
    function __construct() {
        $this->ee =  & get_instance();                
    }
    
    function map(){                
        $address = $this->ee->TMPL->fetch_param('address');        
        $class = $this->ee->TMPL->fetch_param('class');        
        $size = $this->ee->TMPL->fetch_param('size');
        $zoom = (int)$this->ee->TMPL->fetch_param('zoom');
        $input = $this->ee->TMPL->fetch_param('input');
        $id = $this->ee->TMPL->fetch_param('id') ;
        if (!$id) {
            $id = 'gmaps';
        }
        
        $center = explode(';',$this->ee->TMPL->fetch_param('center'));
        $marker = $this->ee->TMPL->fetch_param('marker');
        if ($marker){
            $marker = explode(';',$marker);        
            $marker = array('lat' => (float)$marker[0] , 'lng'=> (float)$marker[1]);            
            $label = $this->ee->TMPL->fetch_param('label');
            $address = $label;
        }
        
        
        $options = array();
        $options['center'] = array('lat' => (float)$center[0] , 'lng'=> (float)$center[1]);
        $options['zoom'] = $zoom ? $zoom : 8;        
        if ($class){
            $style = '';
        }
        
        $style = $this->ee->TMPL->fetch_param('style');
        if ($size){
            $size = explode('x',$size);
            $style .= ';width:'.$size[0].'px;height:'.$size[1].'px;';        
        }
        $map_html = '<div class="' .  $class  .'" style="'.$style.'" id="'.$id.'"></div>';
        $map_script = '<script>'
                . 'var map,geocoder,infoWindow,marker;'
                . 'function initMap(){ ' 
                . '     map = new google.maps.Map(document.getElementById("'.$id.'"), ' .json_encode($options). ' ); ' 
                . '     geocoder = new google.maps.Geocoder;' 
                . '     infoWindow = new google.maps.InfoWindow;'
                . ( $marker  ?  '   markMap('. json_encode($marker).',"'.$label.'");' : '') 
                . ( $address ?  '   codeAddress("'. $address.'");' : '')
                . ( $input   ?  '   if (document.getElementsByName("'.$input.'").length) { document.getElementsByName("'.$input.'")[0].onchange = function(){codeAddress(this.value);};}' : '' )
                . '}'
                . 'function markMap(pos,label){' 
                . '  map.setCenter(pos);'                            
                . '  if (label){'
                . '     infoWindow.setContent(label);'
                . '     infoWindow.setPosition(pos);'
                . '     infoWindow.open(map,marker);'
                . ( $input   ?  '  if (document.getElementsByName("'.$input.'").length) {document.getElementsByName("'.$input.'")[0].value = label ;}' : '' )
                . '  }else{'
                . '     marker = new google.maps.Marker({map: map,position: pos});'
                . '  }'
                . ''
                . '}'
                . 'function codeAddress(address) {'
                . '    geocoder.geocode( { "address": address}, function(results, status) {'
                . '        if (status == google.maps.GeocoderStatus.OK) {'
                . '            markMap(results[0].geometry.location,address);'
                . '        } else {'
                . '            console("Geocode was not successful for the following reason: " + status);'
                . '        }'
                . '    });'
                . '}'
                . '</script><script src="https://maps.googleapis.com/maps/api/js?key='. GOOGLE_API_KEY .'&callback=initMap" async defer></script>';        
        return $map_html . $map_script ;
    }
    
    static function usage(){
        return '{exp:google_maps:map center="lat;lng" address="<address>" zoom="<int(8:12)>" size="w x h" marker="pos" label="" style="" class=""/}';
    }
    
}