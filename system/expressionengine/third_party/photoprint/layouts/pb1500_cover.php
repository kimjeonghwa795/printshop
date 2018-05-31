<?php
$layout = new \stdClass();
$layout->name = 'pb1500';

$layout->width = 4488;
$layout->height = 2362;


$layout->gutter = array();
$layout->gutter[] = array( 'x1' => 289 ,'y1' =>0 , 'x2' => 289,'y2' => 20);
$layout->gutter[] = array( 'x1' => 1978,'y1' =>0 , 'x2' => 1978,'y2' => 20);
$layout->gutter[] = array( 'x1' => 2183,'y1' =>0 , 'x2' => 2183,'y2' => 20);
$layout->gutter[] = array( 'x1' => 2344,'y1' =>0 , 'x2' => 2344,'y2' => 20);
$layout->gutter[] = array( 'x1' => 2508,'y1' =>0 , 'x2' => 2508,'y2' => 20);
$layout->gutter[] = array( 'x1' => 4199,'y1' =>0 , 'x2' => 4199,'y2' => 20);


$layout->gutter[] = array( 'x1' => 0 ,'y1' =>266 , 'x2' => 20,'y2' => 266);
$layout->gutter[] = array( 'x1' => 0,'y1' =>2096 , 'x2' => 20,'y2' => 2096);

$layout->gutter[] = array( 'x1' => 4488,'y1' =>266 , 'x2' => 4468,'y2' => 266 );
$layout->gutter[] = array( 'x1' => 4488,'y1' =>2096, 'x2' => 4468,'y2' => 2096 );

$layout->gutter[] = array( 'x1' => 289 ,'y1' =>2362 , 'x2' => 289 ,'y2' => 2342);
$layout->gutter[] = array( 'x1' => 1978,'y1' =>2362 , 'x2' => 1978,'y2' => 2342);
$layout->gutter[] = array( 'x1' => 2183,'y1' =>2362 , 'x2' => 2183,'y2' => 2342);
$layout->gutter[] = array( 'x1' => 2344,'y1' =>2362 , 'x2' => 2344,'y2' => 2342);
$layout->gutter[] = array( 'x1' => 2508,'y1' =>2362 , 'x2' => 2508,'y2' => 2342);
$layout->gutter[] = array( 'x1' => 4199,'y1' =>2362 , 'x2' => 4199,'y2' => 2342);

$layout->box = array(
	array(
		array('x' => 2755 , 'y' => 610 ),
		array('x' => 3770 , 'y' => 610 ),
		array('x' => 3770 , 'y' => 1625),		
		array('x' => 2755 , 'y' => 1625),
		)
);
$layout->box[-1] = array(
	array('x' => 893 , 'y' => 1817 ),
	array('x' => 1373, 'y' => 1500 ),
	array('x' => 1373, 'y' => 1500 ),
	array('x' => 893 , 'y' => 1877 ),
);

$layout->text = array();
$layout->text[] = array(
				'title' => array(
							'pos' => array(
								'x' => 2175 ,
								'y' => 1182 ,
								'width' => 1815,
								'height' => 160,
								'fit'	=> 1
							),							
							'font' => array(
								'face' 	  => 'gt-haptik-bold-webfont',
								'size'	  => 18,
								'weight'  => 600,
								'align'   => 'center',
								'rotate'  => 90,
								'color'   => '#000'
							),
							)					
);


return $layout;