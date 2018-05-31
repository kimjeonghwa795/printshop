<?php

$layout = new \stdClass();
$layout->name = 'pp1000';
$layout->width = 3638;
$layout->height = 5162;

$layout->font = array(
		'face' 	  => 'Circular Book',
		'size'	  => 14,
		'weight'  => 400,
		'align'   => 'left',
		'rotate'  => 0,
		'color'   => '#000'
);


$margin_x =  612;
$margin_y =  100;
$padding_x = 50 ;
$padding_y = 50 ;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);


$layout->gutter= array();
$layout->gutter[] = array('x1' => 612 , 'y1' => 0,'x2' => 612 , 'y2' => 50);
$layout->gutter[] = array('x1' => 1794 , 'y1' => 0,'x2' => 1794 , 'y2' => 50);
$layout->gutter[] = array('x1' => 1844 , 'y1' => 0,'x2' => 1844 , 'y2' => 50);
$layout->gutter[] = array('x1' => 3026 , 'y1' => 0,'x2' => 3026 , 'y2' => 50);


$layout->gutter[] = array('x1' => 462 , 'y1' => 100,'x2' => 562 , 'y2' => 100);
$layout->gutter[] = array('x1' => 462 , 'y1' => 1282,'x2' => 562 , 'y2' => 1282);
$layout->gutter[] = array('x1' => 462 , 'y1' => 1332,'x2' => 562 , 'y2' => 1332);
$layout->gutter[] = array('x1' => 462 , 'y1' => 2514,'x2' => 562 , 'y2' => 2514);
$layout->gutter[] = array('x1' => 462 , 'y1' => 2564,'x2' => 562 , 'y2' => 2564);
$layout->gutter[] = array('x1' => 462 , 'y1' => 3746,'x2' => 562 , 'y2' => 3746);
$layout->gutter[] = array('x1' => 462 , 'y1' => 3796,'x2' => 562 , 'y2' => 3796);
$layout->gutter[] = array('x1' => 462 , 'y1' => 4978,'x2' => 562 , 'y2' => 4978);

$layout->gutter[] = array('x1' => 3051 , 'y1' => 100 ,'x2' => 3151 , 'y2' => 100);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 1282,'x2' => 3151 , 'y2' => 1282);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 1332,'x2' => 3151 , 'y2' => 1332);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 2514,'x2' => 3151 , 'y2' => 2514);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 2564,'x2' => 3151 , 'y2' => 2564);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 3746,'x2' => 3151 , 'y2' => 3746);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 3796,'x2' => 3151 , 'y2' => 3796);
$layout->gutter[] = array('x1' => 3051 , 'y1' => 4978,'x2' => 3151 , 'y2' => 4978);

$layout->gutter[] = array('x1' => 612  , 'y1' => 5028,'x2' => 612  , 'y2' => 5078);
$layout->gutter[] = array('x1' => 1794 , 'y1' => 5028,'x2' => 1794 , 'y2' => 5078);
$layout->gutter[] = array('x1' => 1844 , 'y1' => 5028,'x2' => 1844 , 'y2' => 5078);
$layout->gutter[] = array('x1' => 3026 , 'y1' => 5028,'x2' => 3026 , 'y2' => 5078);

$layout->text = array();	
$layout->box  = array();
$cellHeight = 1182;
$cellWidth  = 1182;
for ( $row = 1; $row <= 4; $row++ ) {
	$posX = $margin_x;
	$posY = $margin_y + ($row - 1 ) * ($cellHeight+ $padding_y);
	$layout->box[(2*$row)  ] = array(
		array('x'=> $posX , 'y' => $posY ),
		array('x'=> $posX + $cellWidth, 'y' => $posY ),
		array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
		array('x'=> $posX , 'y' => $posY + $cellHeight),
	);
	
	$layout->text[(2*$row)] = array(
				'created_time' => array(
							'pos' => array(
								'x' => 100 ,
								'y' => 1030 ,
								'width' => 300,
								'height' => 35,
							),							
							),
				'location' => array(
							'pos' => array(
								'x' => 100 ,
								'y' => 1090 ,
								'width' => 300,
								'height' => 35,
                                ),							
							),
							
				'name' => array(
							'pos' => array(
								'x' => 500 ,
								'y' => 950 ,
								'width' => 620,
								'height' => 105,
                                ),							
                            //'font' => array('align'=> '')
							),
					);
					
	$posX = $margin_x + $cellWidth + $padding_x;
	$layout->box[(2*$row - 1)] = array(
		array('x'=> $posX , 'y' => $posY ),
		array('x'=> $posX + $cellWidth, 'y' => $posY ),
		array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
		array('x'=> $posX , 'y' => $posY + $cellHeight),
	);
	$layout->text[2*$row - 1] = array(
				'created_time' => array(
							'pos' => array(
								'x' => 100 ,
								'y' => 1030 ,
								'width' => 300,
								'height' => 35,
							),							
							),
				'location' => array(
							'pos' => array(
								'x' => 100 ,
								'y' => 1090 ,
								'width' => 300,
								'height' => 35,
							),							
							),
							
				'name' => array(
							'pos' => array(
								'x' => 500 ,
								'y' => 955 ,
								'width' => 620,
								'height' => 105,
							),							
							),							
							
					);

}


return $layout;