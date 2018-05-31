<?php

$layout = new \stdClass();
$layout->width = 2480;
$layout->height = 3508;

$margin_x =  210;
$margin_y =  210;
$padding_x = 62;
$padding_y = 62;

$cellWidth = 1024;
$cellHeight = 1024;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);


//1
$posX = $margin_x;
$posY = $margin_y;
$layout->box[1] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

$layout->gutter = array(
    array('x'=> $posX + $cellWidth/2  , 
          'y'=> $posY + $cellHeight/2,
          'r'=> $cellWidth/2, 
        )
);


//2
$posX = $margin_x + $cellWidth + 10;
$posY = $margin_y;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
$layout->gutter[] = array('x' => $posX + $cellWidth/2  , 
                          'y' => $posY + $cellHeight/2,
                          'r' => $cellWidth/2 ,
                    );

//3
$posX = $margin_x ;
$posY = $margin_y + $cellHeight + 10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

$layout->gutter[] = array('x' => $posX + $cellWidth/2  , 
                          'y' => $posY + $cellHeight/2,
                          'r' => $cellWidth/2 , 
                    );

//4
$posX = $margin_x + $cellWidth  + 10;
$posY = $margin_y + $cellHeight + 10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

$layout->gutter[] = array('x' => $posX + $cellWidth/2  , 
                          'y' => $posY + $cellHeight/2,
                          'r' => $cellWidth/2 , 
                    );

//5
$posX = $margin_x ;
$posY = $margin_y + 2*$cellHeight + 2*10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
$layout->gutter[] = array('x' => $posX + $cellWidth/2  , 
                          'y' => $posY + $cellHeight/2,
                          'r' => $cellWidth/2 , 
                    );

//6
$posX = $margin_x + $cellWidth  + 10;
$posY = $margin_y + 2*$cellHeight + 2*10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
$layout->gutter[] = array('x' => $posX + $cellWidth/2  , 
                          'y' => $posY + $cellHeight/2,
                          'r' => $cellWidth/2 , 
                    );



return $layout;