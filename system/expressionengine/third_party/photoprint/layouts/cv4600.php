<?php
$layout = new \stdClass();
$layout->name = 'cv4600';
$layout->width = 7087;
$layout->height = 4724;

$margin_x =  0;
$margin_y =  0;
$padding_x = 0;
$padding_y = 0;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);

$posX = 0;
$posY = 0;
$cellHeight = $layout->height - $margin_y;
$cellWidth  = $layout->width - $margin_x;
$layout->box[1] = array(        
        array('x'=> $posX , 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
        array('x'=> $posX , 'y' => $posY + $cellHeight),
    );
return $layout;