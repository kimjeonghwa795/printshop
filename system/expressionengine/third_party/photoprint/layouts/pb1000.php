<?php

$layout = new \stdClass();
$layout->name = 'pb1000';
$layout->width = 5161;
$layout->height = 3638;

$margin_x =  195;
$margin_y =  23;
$padding_x = 36;
$padding_y = 23;
$bleed =  18;

$cellWidth = 1181.5;
$cellHeight = 1181.5;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);

$cols[] = $margin_x ;
$cols[] = $margin_x + $cellWidth ;
$cols[] = end($cols) + $cellWidth + $padding_x;
$cols[] = end($cols) + $cellWidth ;

$rows[] = $margin_y ;
$rows[] = end($rows) +$cellHeight + $padding_y;
$rows[] = end($rows) +$cellHeight + $padding_y;

$row_count = count($rows);
$col_count = count($cols);
$count = $row_count * $col_count;

$gl = 20;
$layout->gutter = array();
for($col = 0; $col < $col_count;$col++){	
	$Wpos =  ($col % 2) ? $cellWidth : 0;
	$layout->gutter[] = array(
		'x1' => $cols[$col] + $Wpos , 'y1' => 0,
		'x2' => $cols[$col] + $Wpos, 'y2' => $gl
	);
	$layout->gutter[] = array(
		'x1' => $cols[$col] + $Wpos, 'y1' => $layout->height,
		'x2' => $cols[$col] + $Wpos, 'y2' => $layout->height - $gl
	);
		
}
$gl = 45;
for($row = 0; $row < $row_count;$row++){
	$layout->gutter[] = array(
		'x1' => 150 	  , 'y1' => $rows[$row],
		'x2' => 150+ $gl, 'y2' => $rows[$row],
	);

	$layout->gutter[] = array(
		'x1' => 150, 		'y1' => $rows[$row] + $cellHeight,
		'x2' => 150+ $gl, 'y2' => $rows[$row] + $cellHeight,
	);

	$layout->gutter[] = array(
		'x1' => $layout->width - 150 , 'y1' => $rows[$row],
		'x2' => $layout->width - 150 - $gl  , 'y2' => $rows[$row],
	);

	$layout->gutter[] = array(
		'x1' => $layout->width - 150 , 'y1' => $rows[$row] + $cellHeight,
		'x2' => $layout->width - 150 - $gl , 'y2' => $rows[$row] + $cellHeight,
	);
}

for ($row =  0; $row < $row_count; $row++) {	
	$posY = $rows[$row] ;
    for ($col = 0 ; $col < $col_count ;$col++) {    
		$posX = ($col % 2 ) ? $cols[$col] : $cols[$col] - $bleed ;		
		$cW   =  $cellWidth  + $bleed ;
		$pos  = ($row * $col_count ) + $col + 1;		
		$layout->box[$pos] = array(        
			array('x'=> $posX   	, 'y' => $posY - $bleed/2 ),
			array('x'=> $posX + $cW , 'y' => $posY - $bleed/2),
			array('x'=> $posX + $cW , 'y' => $posY + $cellHeight + $bleed/2 ),
			array('x'=> $posX    	, 'y' => $posY + $cellHeight + $bleed/2),
		);
//		error_log($pos .':'. $posX.',' . $posY);    
//		error_log( print_r($layout->box[$pos],1));    		
    }    	
}

return $layout;