<?php


//if ( ! defined( 'ABSPATH' ) ) exit;
//require EASY_INSTAGRAM_PLUGIN_PATH . '/include/Instagram-PHP-API/Instagram.php';


class PhotoPrinter {    
    var $images = array();
    var $layout_id =  null;
    var $layout = array();
    
    function __construct($layout_id,$images,$mode='t',$item_id='') {
        $this->images = $images;
        $this->layout_id = $layout_id;
        $this->mode = ($mode == 't') ? 'thumbnail' : 'production';
        $this->item_id = $item_id ? $item_id : uniqid();
                
    }
    
    
    function getImage(){
        if (!$this->is_ready()) {
            //error_log('not ready:');
            $this->prepareLayout();
            $this->imSetup();           
            //error_log($this->layout_id);
            //error_log('layout:'.print_r($this->layout,1));
            //error_log('images:'.print_r($this->images,1));
            $this->printOrder();
        }        

    }
        
    
    function is_ready(){                
        $this->file_name = FCPATH .'/media/photoprints/'. $this->mode . '/' . $this->item_id . '.jpg';
        if (file_exists($this->file_name)) return true;
        return false;
    }
        
    function prepareLayout(){        
        $this->layout = include __DIR__ . '/layout/'. $this->layout_id .'.php'; 
    }
        
    
    function getCellPosition($cell,$back=false){
        if ($back ) {
          $mod = $cell %  4;          
        }
       
        return $this->layout->box[$cell];
    }    
    
    function imSetup(){
        $this->im = new Imagick($this->images);
        $this->im->newimage($this->layout->width, $this->layout->height,new ImagickPixel('white'));
        $this->im->setResolution(300,300);
        $this->im->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
        $this->im->setImageFormat('jpeg');        
    }
    
    
    function drawGutter(){
        $draw = new ImagickDraw();
        $draw->setStrokeColor(new ImagickPixel('silver'));
        $draw->setFillColor(new ImagickPixel('none'));
        $draw->setStrokeWidth(1);        
        foreach  ( $this->layout->gutter as $line ) {
            $draw->line($line['x1'],$line['y1'],$line['x2'],$line['y2'] );
        }
/*        
        $draw->polygon($this->box);               
        for ($i=0 ; $i< ($this->col * $this->row);  $i++ ){
            $draw->polygon($this->cells[$i]['box']);
        }
*/        
        $this->im->drawImage($draw);                        
        $draw->clear();
    }
    
    function writeTag(){
        $tag = 'Order #' . $this->order_id;
        $draw = new ImagickDraw( );
        $draw->setFillColor('black');
        $draw->setFontSize(60);
        $draw->setfontweight(600);
        $draw->settextalignment(Imagick::ALIGN_CENTER);
        $draw->setgravity(imagick::GRAVITY_SOUTHWEST);
        $draw->rotate(-90);
        $metric = $this->im->queryFontMetrics($draw,$tag);
        $x = (int)250/2;
        $y = (int)(3720 - $metric['textWidth']/2) - 60;
        $draw->annotation($x , $y, $tag);
        $this->im->annotateImage($draw,$x,$y,-90,$tag);
        $draw->clear();
    }
    function addWatermark(){
        $tag = 'ADORAMA SAMPLE';
        $padding = 10;
        $draw = new ImagickDraw($this->layout->width,$this->layout->height );
        $draw->setStrokeColor('gray');
        $draw->setFillColor('none');
        $draw->setFontSize(288);
        $draw->rotate(-45);
//        $draw->setGravity(imagick::GRAVITY_CENTER);
        $draw->settextalignment(Imagick::ALIGN_CENTER);
        $metric = $this->im->queryFontMetrics($draw,$tag);
        $x = ( ($this->layout->width - $metric['textWidth']) / 2 );
        $y = ( ($this->layout->height + $metric['textHeight']) / 2 );
        $this->im->annotateImage($draw, $x , $y,-45,$tag);
        $this->im->annotateImage($draw, $x + $this->layout->width/2, $y,-45,$tag);
        $draw->clear();
        
    }
    
    function addLabel($im,$label){
        $color = new ImagickPixel('#000000');
        $background = new ImagickPixel('#ffffff'); 
               
        $draw = new ImagickDraw();
        $draw->setFont('Arial');
        $draw->setFontSize(50);
        $draw->setFillColor($color);
//        $draw->setStrokeAntialias(true);
//        $draw->setTextAntialias(true);
        $metrics = $im->queryFontMetrics($draw, $label);
        $textX = (int)(( $im->getImageWidth() )/2 - 50 - $metrics['textWidth']/2 );
        $textY = $metrics['textHeight'] ;//($cell[2]['y'] - $cell[0]['y'] ) - 100  - $metrics['textHeight'];
        $im->setGravity(imagick::GRAVITY_NORTH);
        $draw->annotation(0, 10, $label);
        $im->drawimage($draw);
        return $im;
    }
    function processImage($file,$cell){
        $img = new Imagick($file);
        $background = new ImagickPixel('#ffffff'); 
        $width =  $cell[2]['x'] - $cell[0]['x'];
        $height = $cell[2]['y'] - $cell[0]['y'];
        $img->setbackgroundcolor($background);

        if ( $img->getImageWidth() > $img->getImageHeight() ){
            $img->scaleimage($width, 0);// Imagick::FILTER_BOX,0.1,false);        
           $x = 0;
            $y = -abs(($height - $img->getImageHeight ())/2);
        }else{
            $img->scaleimage(0, $height);// Imagick::FILTER_BOX,0.1,false);        
            $x = -abs(($width - $img->getImageWidth())/2);
            $y = 0;
        }        
        
//        $img->setGravity(imagick::GRAVITY_CENTER);        
        $img->extentImage($width, $height, $x, $y);
        $img = $this->addLabel($img, basename($file));
        return $img;
    }
    
    
    
    function printOrder(){
        $draw = new ImagickDraw();
        $draw->setStrokeColor('gray');
        $draw->setFillColor('none');
        $img_cnt = count($this->images);
        $cell_cnt = count($this->layout->box);
        //error_log($img_cnt . ':' . $cell_cnt);
        for ($i=0 ; $i< $cell_cnt ;$i++)
        {   
            $cell = $this->layout->box[$i];
            if ($i >= $img_cnt ) {
                $draw->rectangle($cell[0]['x'], $cell[0]['y'], $cell[2]['x'], $cell[2]['y']);            
                $this->im->drawImage($draw);
                break;
            }
            $img = $this->processImage($this->images[$i], $cell );
            $this->im->compositeImage($img,imagick::COMPOSITE_COPY, $cell[0]['x'] , $cell[0]['y'] );            
            $img->destroy();
        }
        
        $this->im->combineImages(imagick::CHANNEL_ALL);
        
        if ($this->mode == 'p'){
            $this->drawGutter();
        }else{
            $this->addWatermark();
        }            
        if ($this->mode == 't'){
           $this->im->scaleImage(704,504);
        }
        
       $this->im->writeImage($this->file_name);
        
      /*  // If a new page/cover hasn't already been created, or if we've hit a 
        // blank line and the previous page has content (this prevents
        // multiple blank lines from creating multiple pages), then create a new page.
        $page = $this->newCover();            
        foreach ( $this->data as $line){            
            $page = $this->newPage();        
            // Sniff content as image or caption                           
            $page->addImage($line['picture']);
            if (isset($line['caption'])){
              $page->addCaption($line['caption']);
            }            
        }
        $this->render($this->filename, $this->image_dir);
       * 
       */
    }
    
    function __destruct() {
        if ($this->im)$this->im->destroy();
    }
       
}


