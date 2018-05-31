<?php
// cover 
$layout = new \stdClass();
$layout->width = 3555;
$layout->height = 1914;
$cellWidth = 770;
$cellHeight = 770;
$posX = 2082 + 175;
$posY = 350 + 175;
$layout->box = array(
    array(
        array('x'=> $posX , 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
        array('x'=> $posX , 'y' => $posY + $cellHeight),
    ),        
    array(
        array('x'=> 850 , 'y' => 1360 ),
        array('x'=> 1160, 'y' => 1360 ),
        array('x'=> 1160, 'y' => 1557 ),
        array('x'=> 850 , 'y' => 1557 ),
    )
    
);



$layout->gutter = array(
    // kiri
    array(
        'x1' => 0 , 'y1' => 350,
        'x2' => 30, 'y2' => 350,
    ),
    // kiri bwh
    array(
        'x1' => 0 , 'y1' => 1557,
        'x2' => 30, 'y2' => 1557,
    ),

    // kanan
    array(
        'x1' => 3555 , 'y1' => 350,
        'x2' => 3525 , 'y2' => 350,
    ),
    // kanan bwh
    array(
        'x1' => 3555, 'y1' => 1557,
        'x2' => 3525, 'y2' => 1557,
    ),
    
    //atas 1
    array(
        'x1' => 353, 'y1' => 0,
        'x2' => 353, 'y2' => 30,
    ),
    //atas 2
    array(
        'x1' => 1473, 'y1' => 0,
        'x2' => 1473, 'y2' => 30,
    ),
    //atas 3
    array(
        'x1' => 1653, 'y1' => 0,
        'x2' => 1653, 'y2' => 30,
    ),
    //atas 4
    array(
        'x1' => $layout->width - 353, 'y1' => 0,
        'x2' => $layout->width - 353, 'y2' => 30,
    ),
    //atas 5
    array(
        'x1' => $layout->width - 1473, 'y1' => 0,
        'x2' => $layout->width - 1473, 'y2' => 30,
    ),
    //atas 6
    array(
        'x1' => $layout->width - 1653, 'y1' => 0,
        'x2' => $layout->width - 1653, 'y2' => 30,
    ),
    
    //bwh 1
    array(
        'x1' => 353, 'y1' => 1914,
        'x2' => 353, 'y2' => 1914- 30,
    ),
    //bwh 2
    array(
        'x1' => 1473, 'y1' => 1914 - 0,
        'x2' => 1473, 'y2' => 1914 - 30,
    ),
    //bwh 3
    array(
        'x1' => 1653, 'y1' => 1914 - 0,
        'x2' => 1653, 'y2' => 1914 - 30,
    ),
    //bwh 4
    array(
        'x1' => $layout->width - 353, 'y1' => 1914 - 0,
        'x2' => $layout->width - 353, 'y2' => 1914 - 30,
    ),
    //bwh 5
    array(
        'x1' => $layout->width - 1473, 'y1' => 1914 - 0,
        'x2' => $layout->width - 1473, 'y2' => 1914 - 30,
    ),
    //bwh 6
    array(
        'x1' => $layout->width - 1653, 'y1' => 1914 - 0,
        'x2' => $layout->width - 1653, 'y2' => 1914 - 30,
    ),
    
);

return $layout;