<?php

$layout = new \stdClass();
$layout->width = 3780;
$layout->height = 5280;

$margin_x =  118;
$margin_y =  718;
$padding_x = 0;
$padding_y = 150;

$cellWidth = 1773;
$cellHeight = 1773;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);

$count = 4;
$row_count = 2;
$col_count = 2;


$cols[] = $margin_x;
$cols[] = $margin_x+$cellWidth+$padding_x*2;
$layout->gutter = array();
$layout->box = array();
for ($row =  0; $row < $row_count; $row++) {
    for ($col = 0 ; $col < $col_count;$col++) {
    $padding = ($col % 2 ) ? 0 : 60 ;
    $posX = $cols[$col];
    $posY = $margin_y + $row * $cellHeight + $padding_y * $row * 2;
    $pos = ($i*$row) + $j + 1;
    $layout->box[$pos] = array(        
        array('x'=> $posX , 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
        array('x'=> $posX , 'y' => $posY + $cellHeight),
    );
    
//atas    
    $layout->gutter[1] = array(
        'x1' => $posX - 50      , 'y1' => $posY,
        'x2' => $posX - 50 - 100 , 'y2' => $posY,
        
    );
    $layout->gutter[] = array(
        'x1' => $posX , 'y1' => $posY - 50,
        'x2' => $posX , 'y2' => $posY - 50 - 100,
        
    );

    $layout->gutter[] = array(
        'x1' => $posX + $cellWidth + 50      , 'y1' => $posY,
        'x2' => $posX + $cellWidth + 50 + 100 , 'y2' => $posY,
        
    );
    $layout->gutter[] = array(
        'x1' => $posX + $cellWidth, 'y1' => $posY - 50,
        'x2' => $posX + $cellWidth , 'y2' => $posY - 50 - 100,        
    );
    

//bawah    
    $layout->gutter[] = array(
        'x1' => $posX - 50      , 'y1' => $posY + $cellHeight,
        'x2' => $posX - 50 - 100 , 'y2' => $posY + $cellHeight,
        
    );
    $layout->gutter[] = array(
        'x1' => $posX , 'y1' => $posY + $cellHeight + 50 ,
        'x2' => $posX , 'y2' => $posY + $cellHeight + 50 + 100,
        
    );

    $layout->gutter[] = array(
        'x1' => $posX + $cellWidth + 50      , 'y1' => $posY + $cellHeight,
        'x2' => $posX + $cellWidth + 50 + 100 , 'y2' => $posY + $cellHeight,
        
    );
    $layout->gutter[] = array(
        'x1' => $posX + $cellWidth, 'y1' => $posY + $cellHeight + 50,
        'x2' => $posX + $cellWidth , 'y2' => $posY + $cellHeight + 50 + 100,
        
    );
    
    
    }
    
}


return $layout;