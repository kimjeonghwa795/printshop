<?php

$layout = new \stdClass();
$layout->width = 2480;
$layout->height = 3508;

$margin_x =  210;
$margin_y =  210;
$padding_x = 60;
$padding_y = 60;

$cellWidth = 650;
$cellHeight = 650;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);


//1 => 1:1
$posX = $margin_x;
$posY = $margin_y;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//2 => 1:2
$posX = $margin_x + $cellWidth + 10;
$posY = $margin_y;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//3 ==> 1:3
$posX = $margin_x + 2*$cellWidth + 2*10;
$posY = $margin_y ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//4 => 2:1
$posX = $margin_x;
$posY = $margin_y + $cellHeight + 10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//5 => 2:2
$posX = $margin_x + $cellWidth + 10;
$posY = $margin_y + $cellHeight + 10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//6 ==> 2:3
$posX = $margin_x + 2*$cellWidth + 2*10;
$posY = $margin_y + $cellHeight + 10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);


//7 => 3:1
$posX = $margin_x;
$posY = $margin_y + 2*$cellHeight + 2*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//8 => 3:2
$posX = $margin_x + $cellWidth + 10;
$posY = $margin_y + 2*$cellHeight + 2*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//9 ==> 3:3
$posX = $margin_x + 2*$cellWidth + 2*10;
$posY = $margin_y + 2*$cellHeight + 2*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//10 => 4:1
$posX = $margin_x;
$posY = $margin_y + 3*$cellHeight + 3*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//11 => 4:2
$posX = $margin_x + $cellWidth + 10;
$posY = $margin_y + 3*$cellHeight + 3*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//12 ==> 4:3
$posX = $margin_x + 2*$cellWidth + 2*10;
$posY = $margin_y + 3*$cellHeight + 3*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//13 => 5:1
$posX = $margin_x;
$posY = $margin_y + 4*$cellHeight + 4*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//14 => 5:2
$posX = $margin_x + $cellWidth + 10;
$posY = $margin_y + 4*$cellHeight + 4*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//15 ==> 5:3
$posX = $margin_x + 2*$cellWidth + 2*10;
$posY = $margin_y + 4*$cellHeight + 4*10;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);



return $layout;