<?php

$layout = new \stdClass();
$layout->width = 2480;
$layout->height = 3508;

$margin_x =  35;
$margin_y =  40;
$padding_x = 60;
$padding_y = 60;

$cellWidth = 840;
$cellHeight = 840;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);


//1
$posX = $margin_x;
$posY = $margin_y;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
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

//7
$posX = $margin_x ;
$posY = $margin_y + 3*$cellHeight + 3*10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//8
$posX = $margin_x + $cellWidth  + 10;
$posY = $margin_y + 3*$cellHeight + 3*10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);


//9
$posX = 1620 ;
$posY = 455 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//10

$posY = $posY + $cellHeight + 15 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//11
$posY = $posY + $cellHeight + 15 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

return $layout;