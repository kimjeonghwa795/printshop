<?php

$layout = new \stdClass();
$layout->name = 'pp1200';
$layout->width = 3645 ;
$layout->height = 4618 ;

$layout->font = array(
		'face' 	  => 'Circular Book',
		'size'	  => 24,
		'weight'  => 400,
		'align'   => 'left',
		'rotate'  => 0,
		'color'   => '#000'
);

$margin_x =  25;
$margin_y =  160;
$padding_x = 58 ;
$padding_y = 58 ;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);

$cellWidth  = 1182;
$cellHeight = 1418;

$layout->gutter= array();
/* atas */
$layout->gutter[] = array('x1' => $margin_x  			  , 'y1' => $margin_y - 50,'x2' => $margin_x , 'y2' => $margin_y - 100)  ;
$layout->gutter[] = array('x1' => $margin_x +  $cellWidth , 'y1' => $margin_y - 50,'x2' => $margin_x + $cellWidth , 'y2' => $margin_y - 100)  ;

$layout->gutter[] = array('x1' => 2*$margin_x +   $cellWidth , 'y1' => $margin_y - 50, 'x2' => 2*$margin_x +   $cellWidth , 'y2' => $margin_y - 100)  ;
$layout->gutter[] = array('x1' => 2*$margin_x + 2*$cellWidth , 'y1' => $margin_y - 50, 'x2' => 2*$margin_x + 2*$cellWidth , 'y2' => $margin_y - 100)  ;

$layout->gutter[] = array('x1' => 3*$margin_x +  2*$cellWidth, 'y1' => $margin_y - 50, 'x2' => 3*$margin_x + 2*$cellWidth , 'y2' => $margin_y - 100)  ;
$layout->gutter[] = array('x1' => 3*$margin_x +  3*$cellWidth, 'y1' => $margin_y - 50, 'x2' => 3*$margin_x + 3*$cellWidth , 'y2' => $margin_y - 100)  ;

/* bawah */
$bawah = $layout->height;
$layout->gutter[] = array('x1' => $margin_x  			  , 'y1' => $bawah - $margin_y - 50,'x2' => $margin_x , 'y2' => $bawah - $margin_y - 100)  ;
$layout->gutter[] = array('x1' => $margin_x +  $cellWidth , 'y1' => $bawah - $margin_y - 50,'x2' => $margin_x + $cellWidth , 'y2' => $bawah - $margin_y - 100)  ;

$layout->gutter[] = array('x1' => 2*$margin_x +   $cellWidth , 'y1' => $bawah - $margin_y - 50, 'x2' => 2*$margin_x +   $cellWidth , 'y2' => $bawah - $margin_y - 100)  ;
$layout->gutter[] = array('x1' => 2*$margin_x + 2*$cellWidth , 'y1' => $bawah - $margin_y - 50, 'x2' => 2*$margin_x + 2*$cellWidth , 'y2' => $bawah - $margin_y - 100)  ;

$layout->gutter[] = array('x1' => 3*$margin_x +  2*$cellWidth, 'y1' => $bawah - $margin_y - 50, 'x2' => 3*$margin_x + 2*$cellWidth , 'y2' => $bawah - $margin_y - 100)  ;
$layout->gutter[] = array('x1' => 3*$margin_x +  3*$cellWidth, 'y1' => $bawah - $margin_y - 50, 'x2' => 3*$margin_x + 3*$cellWidth , 'y2' => $bawah - $margin_y - 100)  ;

/* kiri */
$layout->gutter[] = array('x1' => 0 , 'y1' => $margin_y ,
						  'x2' => 10, 'y2' => $margin_y );
$layout->gutter[] = array('x1' => 0 , 'y1' => $margin_y + $cellHeight,
						  'x2' => 10, 'y2' => $margin_y + $cellHeight );
						
$layout->gutter[] = array('x1' => 0 , 'y1' => $margin_y + $cellHeight + 25,
						  'x2' => 10, 'y2' => $margin_y + $cellHeight + 25);
$layout->gutter[] = array('x1' => 0 , 'y1' => $margin_y + 2*$cellHeight + 25,
						  'x2' => 10, 'y2' => $margin_y + 2*$cellHeight +25);

$layout->gutter[] = array('x1' => 0 , 'y1' => $margin_y + 2*$cellHeight + 50,
						  'x2' => 10, 'y2' => $margin_y + 2*$cellHeight + 50);
$layout->gutter[] = array('x1' => 0 , 'y1' => $margin_y + 3*$cellHeight + 50,
						  'x2' => 10, 'y2' => $margin_y + 3*$cellHeight + 50);

/* kanan */
$layout->gutter[] = array('x1' => $layout->width , 'y1' => $margin_y ,
						  'x2' => $layout->width - 10, 'y2' => $margin_y );
$layout->gutter[] = array('x1' => $layout->width , 'y1' => $margin_y + $cellHeight,
						  'x2' => $layout->width - 10, 'y2' => $margin_y + $cellHeight );
						
$layout->gutter[] = array('x1' => $layout->width , 'y1' => $margin_y + $cellHeight + 25,
						  'x2' => $layout->width - 10, 'y2' => $margin_y + $cellHeight + 25);
$layout->gutter[] = array('x1' => $layout->width , 'y1' => $margin_y + 2*$cellHeight + 25,
						  'x2' => $layout->width - 10, 'y2' => $margin_y + 2*$cellHeight +25);

$layout->gutter[] = array('x1' => $layout->width , 'y1' => $margin_y + 2*$cellHeight + 50,
						  'x2' => $layout->width - 10, 'y2' => $margin_y + 2*$cellHeight + 50);
$layout->gutter[] = array('x1' => $layout->width , 'y1' => $margin_y + 3*$cellHeight + 50,
						  'x2' => $layout->width - 10, 'y2' => $margin_y + 3*$cellHeight + 50);
						  
$cnt =  0;
$cellHeight = 1182;
for ( $row = 1; $row <= 3; $row++){
for ( $col = 1; $col <=3 ; $col++){		
	$cnt++;
	
	$posX = $margin_x +  ($col - 1) * ( $cellWidth  + $margin_x ) ;
	$posY = $margin_y +  ($row - 1) * ( 1418 + $margin_x );
	
	$layout->box[$cnt] = array(
		array('x'=> $posX + $padding_x, 			  'y' => $posY + $padding_y),
		array('x'=> $posX + $cellWidth - $padding_x , 'y' => $posY + $padding_y),
		array('x'=> $posX + $cellWidth - $padding_x , 'y' => $posY + $cellHeight - $padding_y),
		array('x'=> $posX + $padding_x , 'y' => $posY + $cellHeight - $padding_y),		
	);				
}
}

return $layout;