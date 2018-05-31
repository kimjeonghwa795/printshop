<?php

function swapwith($index,$max=2){
    $mod = (int)($index - 1) % (int)$max;
    $div = floor(($index-1)/$max);
    return ($div*$max) + ($max - $mod);    
}

class PhotoPrinter {
    var $images = array();
    var $layout = array();
    var $metas = array();
    var $working_dir = '';
    var $working_format = 'jpg';
	

    function __construct($layout,$images,$metas=array(),$working_dir='working/', $mode='production') {
        $this->images = $images;        
        $this->metas = $metas;	
		$this->filename = '';
        $this->working_dir = $working_dir;
        $this->mode = $mode;
        $this->page = 1; 
        $this->setLayout($layout);
        
    }
	function setLayout($layout){
		$this->layout = $layout;
        $this->layout_id = @$layout->name ? substr($layout->name,0,6):  @$_REQUEST['sku'];
		$this->imSetup();
	}
    function parent_dir(){
        $parent = explode('/',$this->working_dir);        
        $parent = array_filter($parent);

        array_pop($parent);
        return  '/'. join('/',$parent) .'/'; 
    }
    
    function generate($fn,$suffix=''){
        $this->filename = $this->get_result_filename($fn);
        $this->printOrder();
        $files = glob($this->working_dir . 'page*.jpg');        
        
        $result = $this->parent_dir() . '/'.$fn;
        if (count($files) == 1 ){
            copy(current($files),$result);
        }
        
        return $result;
    }
    function getImage($format = '.png',$filename=''){
//        $ready = $this->is_ready($format);
        $this->filename = $this->get_result_filename($format);
        if (file_exists($this->filename)) return file_get_contents ($this->filename);
        $ready = $this->printOrder();
		
        if ($format == '.pdf' || $this->page > 1){
            $this->generate_pdf();
        }

        if ($format == '.zip' && $this->page > 1 ){
            $this->generate_zip() ;
        }
        //error_log($this->filename);
        return file_get_contents($this->filename);
    }

    function get_result_filename($fn){
        $files = glob($this->working_dir .$fn);
        return current($files);
    }

    function generate_zip($filename){

//        if (file_exists($filename)) return file_get_contents($filename);

        try {
            $filename = $this->parent_dir() . ($filename);
			@unlink($filename);
            
			$zip = new ZipArchive();
			$ret = $zip->open($filename, ZipArchive::CREATE );			
			$files = glob( $this->working_dir .'page*' );
            foreach($files as $fn){
                $zip->addFile($fn,basename($fn));
            }

            $zip->close();
            
            return $filename;
        }  catch (Exception $ex){
            error_log($ex->getMessage() );
        }
    }
    
    function generate_pdf($filename){        	    
//        if (file_exists($filename)) return  file_get_contents($filename);        
        $images  = glob( $this->working_dir .'page*' );
		try {
            $filename = $this->parent_dir() . ($filename);
			$pdf = new Imagick($images);
			$pdf->setImageFormat('pdf');
			$pdf->setResolution( 300, 300 ); 
					
			$pdf->writeImages($filename,true);		
			////error_log($filename . PHP_EOL . print_r($images,1));
			
			//return $pdf->getImageBlob();            
			return $filename;
		
		}catch(Exception $ex){
			error_log(__FUNCTION__ . $ex->getMessage());
		}
		
        try {			
			$pdf = new PDFLib();
			if ($pdf->begin_document("", "") == 0) {
				die("Error: " . $pdf->get_errmsg());
			}
			//$pdf->set_info();
			$pdf->set_info('Creator', 'Volgram Photoprinter Engine');
			$pdf->set_info('Authors', 'Adorama Printshop');
			$pdf->set_info('Producers', 'Adorama Printshop');		

			$path = str_replace(FCPATH .'working/','',$this->working_dir);
			list($order_id, $item_id) = explode('/',$path);
			$pdf->set_info('Title', 'Order #' . $order_id);		
			$pdf->set_info('Subject', 'Item #' . $item_id);
			
			foreach($images as $img){
				$size  = getimagesize ($img);				
				$pdf->begin_page_ext($size[0] ,$size[1] ,'');
				$imgHandler = $pdf->load_image(image_type_to_extension($size[2],0) , $img , '');
				$pdf->fit_image($imgHandler,0,0,'boxsize {' .$size[0] .' '. $size[1] .'} position 0 fitmethod meet');
				$pdf->close_image($imgHandler);
				$pdf->end_page_ext('');
			}
            //$pdf->writeImages( $filename , true);						
			$pdf->end_document('');
            return   $pdf->get_buffer();
        } catch (Exception $ex){
            error_log(__FUNCTION__ . $ex->getMessage());
        }
    }


    function is_ready($format='.png'){		
		if ( ! @$this->filename ) return false;
        if (file_exists($this->filename)) return file_get_contents($this->filename);

        $files = glob($this->working_dir .'page*') ;
        if ( count($files) == $this->page ) return file_get_contents(current($files));
        return false;
    }

    function getCellPosition($cell,$back=false){
        if ($back ) {
          $mod = $cell %  4;
        }
        return $this->layout->box[$cell];
    }

    function imSetup(){
        if (isset($this->im))
            $this->im->clear();
        $this->im = new Imagick();
		$white = new ImagickPixel('#FFFFFF');
        $this->im->newimage($this->layout->width, $this->layout->height, $white);
        $this->im->setResolution(300,300);
		$this->im->setImageResolution(300,300);
        $this->im->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
        $this->im->setImageFormat($this->working_format);
        $this->im->setImageMatte(true);
        $this->im->setBackgroundColor($white);
		$this->im->setImageProperty('Exif:Make', 'Imagick');
		$this->im->setImageProperty('Exif:Authors', 'Adorama Printshop');

		$path = str_replace(FCPATH .'working/','',$this->working_dir);
		list($order_id, $item_id) = explode('/',$path);
		$this->im->setImageProperty('Exif:Subject', 'Order #' . $order_id);
		$this->im->setImageProperty('Exif:Comments', ' Printshop Order #'. $order_id .'Item #' . $item_id);

		


        $img_cnt = count($this->images);
        $cell_cnt = count($this->layout->box);

        $this->page = ceil($img_cnt/$cell_cnt)  ;
		if (@substr($this->layout->name,0,2) == 'pb')$this->page -=1;
/*
        $this->im->setResourceLimit(6,$cell_cnt);
        $this->im->setResourceLimit(IMagick::RESOURCETYPE_DISK,$cell_cnt * 16 );
        $this->im->setResourceLimit(IMagick::RESOURCETYPE_FILE,$cell_cnt * 16 );
        $this->im->setResourceLimit(IMagick::RESOURCETYPE_MEMORY,$cell_cnt * 16 );
        $this->im->setResourceLimit(IMagick::RESOURCETYPE_MAP,$cell_cnt);
        ini_set('memory_limit', $cell_cnt * 32 * 1024*1024 );
*/
//        error_log($img_cnt . ': ' .  $cell_cnt. ' : ' .$this->page);
        //error_log(print_r(array_keys($this->images) ,1). PHP_EOL .  print_r(array_keys($this->layout->box) ,1) );
        //(FCPATH . 'themes/site_themes/default_site/assets.group/css/fonts');
    }

    function drawGutter(){
        $draw = new ImagickDraw();
        $draw->setStrokeColor(new ImagickPixel('black'));
        $draw->setFillColor(new ImagickPixel('none'));
        $draw->setStrokeWidth(1);
//        $draw->setStrokeDashArray([20, 20]);
//        $draw->setStrokeDashOffset(0);
        foreach  ( $this->layout->gutter as $idx => $line ) {
            if (count($line) == 3) {                
                $draw->circle($line['x'], $line['y'], $line['x'] + $line['r'], $line['y']  );                                
            }else{
                $draw->line($line['x1'], $line['y1'], $line['x2'], $line['y2']);
            }
        }
		
        $draw->setStrokeWidth(3);
/*		$draw->setFillColor(new ImagickPixel('none'));        
        foreach ($this->layout->box as $idx => $cell ) {
			$draw->rectangle($cell[0]['x'],$cell[0]['y'],$cell[2]['x'],$cell[2]['y']);
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
    
    function writeText($text,$pos,$font=array(),$im = null){  
		//error_log(print_r($im,1));
        if ( ! $im ){$im =  $this->im;}
        //$text = 'Ukuran Font Teks Punggung';
		$text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
		
		if ( ! $font ) $font = $this->layout->font;		
        $font['size']   = @$font['size']   ? $font['size'] : 24;
        $font['color']  = @$font['color']  ? $font['color'] : 'black';
        $font['face']   = @$font['face']   ? $font['face'] : 'Tahoma';		
        $font['weight'] = @$font['weight'] ? $font['weight'] : 300;
        $font['rotate'] = @$font['rotate'] ? $font['rotate'] : 0; 
		
		switch( strtolower($font['align']) ){		
			case 'left': { $font['align'] = Imagick::ALIGN_LEFT; break;}
			case 'right': {$font['align'] = Imagick::ALIGN_RIGHT; break;}
			default: {$font['align'] = Imagick::ALIGN_CENTER; }
		}
        
		
        $draw = new ImagickDraw( );		
        $draw->setFont( __DIR__ . '/fonts/'. $font['face']  . '.ttf' );
		$draw->setStrokeColor($font['color']);
        $draw->setFillColor($font['color']);
        $draw->setFontSize( $font['size'] );
        $draw->setFontWeight($font['weight']);
        $draw->setTextAlignment($font['align']);
        if ($font['align'] == 1) $draw->setGravity(imagick::GRAVITY_WEST);
        //$draw->rotate( $font['rotate'] );
		
        
		$lines = array($text);
		$metric = $im->queryFontMetrics($draw,$text);		
		if (@$pos['fit']){
//			error_log( print_r($metric,1) . PHP_EOL . print_r($pos,1));
			while( $metric['textWidth'] < $pos['width'] - 20 && $metric['textHeight'] < $pos['height'] - 20 ) {
				$font['size'] += 1;
				$draw->setFontSize( $font['size'] );
				$metric = $im->queryFontMetrics($draw,$text);
			}
			if ($font['rotate'] > 45) {
				$pos['x'] = $pos['x'] + 10 + ($pos['height'] - $metric['textHeight']) / 2;
			}else{
				$pos['y'] = $pos['y'] + 10 + ($pos['height'] - $metric['textHeight']) / 2;
			}
			
		}else{								
			$lines = $this->wordwrap($text,$pos['width'],$draw) ;
		}
        $lineHeight = $metric['textHeight']  ;
		error_log( print_r($metric,1) . PHP_EOL . print_r($pos,1) . PHP_EOL . $font['size'] );					
//		$lines= array_filter($lines);

//		error_log(print_r($font,1));
//        error_log($draw->getFont());
		$addjustX = ($font['rotate']) ? $metric['textHeight'] / 2: $metric['textWidth'] / 2;
		$addjustY = ($font['rotate']) ? $metric['textWidth'] / 2: $metric['textHeight'] / 2;
        $x = (int)($pos['x']);//- $addjustX );
		$y = (int)($pos['y']);// - $metric['textHeight'] / 2 );
		
		error_log( __LINE__ . ' : '.$x . ' x ' . $y . ' : ' . $text . print_r($metric,1));
//		error_log(print_r($lines,1));
		foreach($lines as $n => $line){
//			error_log( __LINE__ . ' : '. ($x) . ' x ' . ($y ) . ' : ' . $n .' - '. $line );			
			$im->annotateImage($draw,$x, $y , $font['rotate'],$line);
			$im->drawImage($draw);
			$y += $lineHeight ;
		}
		
/*		

		error_log($text . PHP_EOL . print_r($pos,1));
		error_log(print_r($font,1) . PHP_EOL . print_r($metric,1));
		error_log(print_r($draw,1));
*/		        

//		$idx = rand(1,100);
//        $im->annotateImage($draw,$x,$y,$font['rotate'],$text);
//		$im->writeimage($this->working_dir . '../img-' . $idx .'.jpg');
//        $draw->clear();
        return $im;
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
        $draw->setFont('AvantGarde-Book');
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
    
    function generate_meta_image($metas,$cells,$img = null){				
		foreach($cells as $key => $def){		
			if (isset($metas[$key])){
				//error_log($key . ' : ' .   $metas[$key]  . $img );
				$this->writeText(@$metas[$key],@$def['pos'], @$def['font'],$img);
			}
		}	
        return $img;
    }
    
    
    function processImage($file,$cell,$crop=null){
        
        try {
            $img = new Imagick($file);
            $img->setImageFormat($this->working_format);
            $img->setImageMatte(true);

            $background = new ImagickPixel('transparent'); 
            $img->setBackgroundColor($background);


            $width =  abs($cell[2]['x'] - $cell[0]['x']);
            $height = abs($cell[2]['y'] - $cell[0]['y']);
			
			$imgAr = $img->getImageWidth () / $img->getImageHeight() ;
			$boxAr = $width / $height;
//			error_log($file . ' ,   w:' . $img->getImageWidth () . '  h:' . $img->getImageHeight() ) ;
//			error_log($imgAr .':' . $boxAr .' => ' . abs($imgAr * $boxAr - 1));
			
			if ( abs($imgAr * $boxAr - 1) < 0.01 && abs($imgAr * $boxAr - 1) != 0 ) {
				$img->rotateImage($background,90); 					
				$imgAr = 1/$imgAr;
			}
			
			// }else if ($boxAr == 1){
				// $size =  max($img->getImageWidth() , $img->getImageHeight());
				
				// $xpad = abs(($imgAr*$size) - $img->getImageWidth() )/2;
				// $ypad = abs(($imgAr*$size) - $img->getImageHeight())/2 ;
				// error_log($size .'='. $xpad .':'. $ypad);
				// $img->thumbnailImage ($width,$height,1,1);
				 
					
			// }else{
				
			//}
			$img->thumbnailImage ($width,$height,1,1);
			
            $x = 0;
            $y = 0;
/*            if ( $imgAr > 1 ){
                $img->scaleimage($width, 0);// Imagick::FILTER_BOX,0.1,false);        
                $x = 0;
                $y = -abs(($height - $img->getImageHeight ())/2);
            }else {
                $img->scaleimage(0, $height);// Imagick::FILTER_BOX,0.1,false);        
                $x = -abs(($width - $img->getImageWidth())/2);
                $y = 0;
            }
*/			
			
			
            if ($crop < 1 ){
                $img->roundCorners($width * $crop ,$height * $crop);
            }elseif($crop >=1) {
                $img->cropImage ($width,$height,$crop,$crop);
            }

//          $img->setGravity(imagick::GRAVITY_CENTER);
            //$img->extentImage($width, $height, $x, $y);
//          $img = $this->addLabel($img, basename($file));
//			$img->writeImage($file);
            return $img;

        }  catch (Exception $x){
            error_log(__FUNCTION__ . ' : ' . $file . PHP_EOL . $x->getMessage());
            throw $x;
        }
    
    }
    
    function printPage($page=1,$suffix=''){
		$file_name = $this->working_dir . 'page-';
		$file_name .= str_pad($page,2,'0',STR_PAD_LEFT);
		$file_name .= $suffix;
        $file_name .= '.' . $this->working_format;
        $cell_cnt = count($this->layout->box);
		$processed = 0;
		$available =  count( array_slice($this->images,($cell_cnt * ($page - 1 ) ) ));
		//error_log("PAGE:FILENAME:". $page . ":" . $file_name);
        
        //error_log(print_r(array_keys($this->images),1) . PHP_EOL . print_r(array_keys($this->layout->box),1));
        try {

			$draw = new ImagickDraw();
			$draw->setStrokeColor('gray');
			$draw->setFillColor('none');
            //@error_log( str_pad($page,2,'0',STR_PAD_LEFT) .' : '. print_r( array_keys($this->layout->box),1));
			foreach ($this->layout->box as $idx => $cell ) {
				$pos = ($page > 1) ? ($cell_cnt * ($page - 1 ) )   + $idx : $idx;                
	            //@error_log('imagepos:' . $pos . ' cell pos :' . $idx . ' : '.$this->images[ $pos ] );
				if ($processed == $available) break;
				if (!isset($this->images[$pos])) continue;
				$img = $this->processImage( $this->images[ $pos ] , $cell, @$cell['crop'] );                        
				$processed++; 
				if ($metabox = @$this->layout->text[$idx]){				
                    //error_log(print_r($this->metas,1) .':' . $pos .':'.  isset($this->metas[$pos]));
					$metas = isset($this->metas[$pos]) ? ($this->metas[$pos]) : false;					                    
                    //error_log($pos . print_r($metabox,1) .PHP_EOL . print_r($metas,1) );
					if ($metas){
//                        $metas = json_decode(str_replace('\"','"',$metas),true);
                        $metas = is_array($metas)? $metas : unserialize($metas);
                        error_log($pos .':'. json_last_error() .  print_r($metas,1)   );
						if (@substr($this->layout->name,0,2) == 'pb'){
							$meta_img = $this->generate_meta_image( $metas , $metabox, $this->im);
						}else{							
							$meta_img = $this->generate_meta_image( $metas , $metabox, $img);
						}					
					}					
				}
				
				$this->im->compositeImage($img,imagick::COMPOSITE_MULTIPLY  , $cell[0]['x'] , $cell[0]['y'] );
				$img->destroy();				
			}
//        $this->im->combineImages(imagick::CHANNEL_ALL);

        if ($this->mode == 'production' && isset($this->layout->gutter)){
                $this->drawGutter();
        }            
		
        
        $this->im->writeImage($file_name);
		return $this->im->getImageBlob();
        
        }  catch (Exception $x){
            error_log(__FUNCTION__  .': '. $idx . ':' . $this->images[$idx]. PHP_EOL. $x->getMessage());
        }
       //error_log($this->file_name);
       return file_get_contents($file_name);
    }
    
    
    
    function printOrder($suffix=''){        
        
        if ($ready = $this->is_ready()) return $ready;
        
        $img_cnt = count($this->images);
        $cell_cnt = count($this->layout->box);
        $page = ceil($img_cnt/$cell_cnt);
        
        $result_file  = '' ;        
        for ($p=1;$p <= $page ;$p++){
            $this->imSetup();                        
            $result_file = $this->printPage($p,$suffix);            
        }        

        if ($this->im) $this->im->destroy();
//        //generate cover page;
//        if ( substr($this->layout_id,0,2) == 'pb' ){
//            $this->generateCover();
//            $this->page  = $this->page +1;
//        }
		
        return ($result_file);
    }
    
    function generateCover($cover,$meta){
       $real_images = $this->images;
       $layout_file =  __DIR__ . '/layouts/'. $this->layout_id .'_cover.php';       
       $this->layout = include $layout_file ;         
       $this->metas = array($meta);
       $this->images = array(
           0 => $cover ,
           -1 => realpath(__DIR__ . '/layouts/coverlogo.png') ,
       );
       $this->imSetup();
       //error_log(__LINE__ . ':' . print_r($this->layout,1));
       $this->printPage(0);                   
       if ($this->im) $this->im->destroy();       
    }
    
    function generateBack($images,$metas){
        $real_images = $this->images;
       
        $layout_file =  __DIR__ . '/layouts/'. $this->layout_id .'_back.php';               
        $this->layout = include $layout_file ;         
        $this->images = $images;
        // //if ($ready = $this->is_ready()) return $ready;
        // $lmax = (substr($this->layout_id,2,2) == '12')? 3 : 2;
        // $this->metas = array();
        // foreach($metas as $seq => $meta){                
            // $swapwith = swapwith($seq,$lmax);                
            // $this->metas[$seq] = @$metas[$swapwith];                
        // }
        
        $result_file  = '' ;        
        for ($p=1;$p <= $this->page ;$p++){
            $this->imSetup();            
            $result_file = $this->printPage($p,'_back');            
        }        

        if ($this->im) $this->im->destroy();
//        //generate cover page;
//        if ( substr($this->layout_id,0,2) == 'pb' ){
//            $this->generateCover();
//            $this->page  = $this->page +1;
//        }
		
        return ($result_file);
    }

	function wordwrap($text, $maxWidth,&$draw=null){		
        $currentLine = '';
        $accLine = '';
        $text = trim($text);
        $lines = array();
        
		while(strlen($text)){
            $delim = ' ';
            $pos  = strpos($text,' ');            
            $pos2 = strpos($text,'#');
            error_log((int)$pos . ' : '. (int)$pos2);
            if ($pos2 && (int)$pos2 < (int)$pos){
                 $pos = $pos2;
                 $delim = '#';
            }
            
            if ($pos === false) {
                $lines[] = $currentLine . $text ;
                break;
            }
             
            $currentWord = substr($text,0,$pos);
            $text = substr($text, $pos+1);            
            $currentLine .= $currentWord . $delim;
                        
            $metrics = $this->im->queryFontMetrics($draw, $currentLine);
            if ($metrics['textWidth'] > $maxWidth){
                if (count($lines) == 7) {
                    $lines[] = substr($currentLine,0,-4) . '...';
                    break;
                }
                $lines[] = $accLine;
                $currentLine = $currentWord;                
            }else {
                $accLine = $currentLine;
            }                        
		}
        
        foreach($lines as $i => $l ){
            error_log(strlen($l) .':'. $l);
        }
		return $lines;
	}
       
}


