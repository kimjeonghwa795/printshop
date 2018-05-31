<?php

$layout = new \stdClass();
$layout->width = 2480;
$layout->height = 3508;

$margin_x =  58;
$margin_y =  67;
$padding_x = 72;
$padding_y = 72;

$cellWidth = 827;
$cellHeight = 827;

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
//2
$posX = 1600;
$posY = $margin_y;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//3
$posX = 830 ;
$posY = 500 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//4
$posX = $margin_x ;
$posY = $margin_y + $cellHeight + 10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);
//5
$posX = 1600;
$posY = $margin_y + $cellHeight + 10 ;
$layout->box[] = array(
    array('x'=> $posX , 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY ),
    array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
    array('x'=> $posX , 'y' => $posY + $cellHeight),
    'crop' => 0.5,
);

//$cellWidth -= $padding_x;
//$cellHeight -= $padding_y;
//foreach ($layout->box as $box){
//    $posX =  $box[0]['x'] + $padding_x/2;
//    $posY =  $box[0]['y'] + $padding_y/2;
//    $layout->box[] = array(
//        array('x'=> $posX , 'y' => $posY ),
//        array('x'=> $posX + $cellWidth, 'y' => $posY ),
//        array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
//        array('x'=> $posX , 'y' => $posY + $cellHeight),
//        'crop' => 0.5,
//    );
//}

return $layout;