<?php
$layout = new \stdClass();
$layout->name = 'pb1500';
$layout->width = 3638;
$layout->height = 5160;

$margin_x =  48;
$margin_y =  750;
$padding_x = 0;
$padding_y = 118;
$bleed = 30;

$cellWidth = 1771;
$cellHeight = 1771;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);

$cols[] = $margin_x;
$cols[] = end($cols) + $cellWidth  ;

$rows[] = $margin_y ;
$rows[] = end($rows) +$cellHeight + $padding_y;

$row_count = count($rows);
$col_count = count($cols);
$count = $row_count * $col_count;

$layout->gutter = array();
$layout->box = array();
for ($row =  0; $row < $row_count; $row++) {
  $posY = $rows[$row] ;
  for ($col = 0 ; $col < $col_count;$col++) {        
    $posX = $cols[$col] ;
//atas    
    $layout->gutter[] = array('x1' => $posX 		  	, 'y1' => $posY - 30,'x2' => $posX , 'y2' => $posY - 30 - 60,        );
    $layout->gutter[] = array('x1' => $posX - 30      	, 'y1' => $posY,'x2' => $posX - 30 - 60 , 'y2' => $posY,);
    $layout->gutter[] = array('x1' => $posX + $cellWidth, 'y1' => $posY - 30,'x2' => $posX + $cellWidth , 'y2' => $posY - 30 - 60,        );   
    $layout->gutter[] = array('x1' => $posX + $cellWidth + 30, 'y1' => $posY,'x2' => $posX + $cellWidth + 30 + 60 , 'y2' => $posY,        );
//bawah    
    $layout->gutter[] = array('x1' => $posX 			, 'y1' => $posY + $cellHeight + 30 ,'x2' => $posX , 'y2' => $posY + $cellHeight + 30 + 60,    );
    $layout->gutter[] = array('x1' => $posX - 30      	, 'y1' => $posY + $cellHeight,'x2' => $posX - 30 - 60 , 'y2' => $posY + $cellHeight,);
    $layout->gutter[] = array('x1' => $posX + $cellWidth, 'y1' => $posY + $cellHeight + 30,'x2' => $posX + $cellWidth , 'y2' => $posY + $cellHeight + 30 + 60,        );
    $layout->gutter[] = array('x1' => $posX + $cellWidth + 30 , 'y1' => $posY + $cellHeight,'x2' => $posX + $cellWidth + 30 + 60 , 'y2' => $posY + $cellHeight,        );
		
    $posX = ($col % 2 ) ? $cols[$col] : $cols[$col] - $bleed;    
    $pos = ($row * $col_count) + $col + 1;
	
    $layout->box[$pos] = array(        
        array('x'=> $posX , 'y' => $posY - $bleed/2),
        array('x'=> $posX + $cellWidth + $bleed, 'y' => $posY - $bleed/2),
        array('x'=> $posX + $cellWidth + $bleed, 'y' => $posY  + $cellHeight + $bleed/2),
        array('x'=> $posX , 'y' => $posY + $cellHeight + $bleed/2),
    );
//    error_log($cols[$col] .':'. $rows[$row]  . ' ; ' . $posX . ':' . $posY );
  }    
}
return $layout;