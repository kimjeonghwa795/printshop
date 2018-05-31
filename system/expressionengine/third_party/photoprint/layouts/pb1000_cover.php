<?php
$layout = new \stdClass();
$layout->name = 'pb1000_cover';
$layout->width = 3555;
$layout->height = 1914;

$layout->gutter = array();
$layout->gutter[] = array( 'x1' => 355 ,'y1' =>0 , 'x2' => 355, 'y2' => 20);
$layout->gutter[] = array( 'x1' => 1475,'y1' =>0 , 'x2' => 1475,'y2' => 20);
$layout->gutter[] = array( 'x1' => 1653,'y1' =>0 , 'x2' => 1653,'y2' => 20);
$layout->gutter[] = array( 'x1' => 1900,'y1' =>0 , 'x2' => 1900,'y2' => 20);
$layout->gutter[] = array( 'x1' => 2078,'y1' =>0 , 'x2' => 2078,'y2' => 20);
$layout->gutter[] = array( 'x1' => 3200,'y1' =>0 , 'x2' => 3200,'y2' => 20);

$layout->gutter[] = array( 'x1' => 0 ,'y1' =>355 , 'x2' => 20,'y2' => 355);
$layout->gutter[] = array( 'x1' => 0,'y1' =>1559 , 'x2' => 20,'y2' => 1559);

$layout->gutter[] = array( 'x1' => 3555,'y1' =>355 , 'x2' => 3535,'y2' => 355);
$layout->gutter[] = array( 'x1' => 3555,'y1' =>1559, 'x2' => 3535,'y2' => 1559);

$layout->gutter[] = array( 'x1' => 355 ,'y1' =>1914 , 'x2' => 355 ,'y2' => 1894);
$layout->gutter[] = array( 'x1' => 1475,'y1' =>1914 , 'x2' => 1475,'y2' => 1894);
$layout->gutter[] = array( 'x1' => 1653,'y1' =>1914 , 'x2' => 1653,'y2' => 1894);
$layout->gutter[] = array( 'x1' => 1900,'y1' =>1914 , 'x2' => 1900,'y2' => 1894);
$layout->gutter[] = array( 'x1' => 2078,'y1' =>1914 , 'x2' => 2078,'y2' => 1894);
$layout->gutter[] = array( 'x1' => 3200,'y1' =>1914 , 'x2' => 3200,'y2' => 1894);

$layout->box = array(
	array(
		array('x' =>  2165 , 'y' => 572  ),
		array('x' =>  2935 , 'y' => 572  ),
		array('x' =>  2935 , 'y' => 1342 ),
		array('x' =>  2165 , 'y' => 1342 ),
	)
);

$layout->box[-1] = array(
	array('x' => 765,  'y' => 1260 ),
	array('x' => 1280, 'y' => 1360 ),
	array('x' => 1280, 'y' => 1485 ),
	array('x' => 665,  'y' => 1485 ),
);

$layout->text = array();
$layout->text[] = array(
				'title' => array(
							'pos' => array(
								'x' => 1655 ,
								'y' => 1002 ,
								'width' => 770,
								'height' => 160,
								'fit' => true
							),							
							'font' => array(
								'face' 	  => 'gt-haptik-bold-webfont',
								'size'	  => 14,
								'weight'  => 400,
								'align'   => 'center',
								'rotate'  => 90,
								'color'   => '#000'
							),
							)
					);


return $layout;