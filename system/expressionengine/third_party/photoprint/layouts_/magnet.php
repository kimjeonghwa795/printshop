<?php

$layout = new \stdClass();
$layout->width = 5280;
$layout->height = 3780;

$margin_x =  250;
$margin_y =  60;
$padding_x = 60;
$padding_y = 60;

$layout->margin[] = array($margin_x,$margin_y);
$layout->margin[] = array($layout->width - $margin_x,$margin_y);
$layout->margin[] = array($margin_x, $layout->height - $margin_y);
$layout->margin[] = array($layout->width - $margin_x, $layout->height - $margin_y);



//top left
$layout->gutter[] = array(
    'x1' => $layout->margin[0][0] -  30, 'y1' => $margin_y,
    'x2' => $layout->margin[0][0] - 130, 'y2' => $margin_y,
);

$layout->gutter[] = array(
    'x1' => $layout->margin[0][0], 'y1' => 0,
    'x2' => $layout->margin[0][0], 'y2' => $margin_y/2,
);

// top right
$layout->gutter[] = array(
    'x1' => $layout->margin[1][0] + 30, 'y1' => $margin_y,
    'x2' => $layout->margin[1][0] + 130, 'y2' => $margin_y,
);

$layout->gutter[] = array(
    'x1' => $layout->margin[1][0], 'y1' => 0,
    'x2' => $layout->margin[1][0], 'y2' => $margin_y/2,
);


//bottom left
$layout->gutter[] = array(
    'x1' => 100, 'y1' => 3720,
    'x2' => 200, 'y2' => 3720,
);
//
$layout->gutter[] = array(
    'x1' => 250, 'y1' => 3750,
    'x2' => 250, 'y2' => 3780,
);

//bottom right
$layout->gutter[] = array(
    'x1' => 5280 - 100, 'y1' => 3720,
    'x2' => 5280 - 200, 'y2' => 3720,
);

$layout->gutter[] = array(
    'x1' => 5280 - 250, 'y1' => 3750,
    'x2' => 5280 - 250, 'y2' => 3780,
);


// col 1-2 atas
$layout->gutter[] = array(
    'x1' => 250 + 2*(1182) , 'y1' => 0,
    'x2' => 250 + 2*(1182) , 'y2' => 30,
);
$layout->gutter[] = array(
    'x1' => 250 + 2*(1182) + 30 , 'y1' => 0,
    'x2' => 250 + 2*(1182) + 30 , 'y2' => 30,
);
$layout->gutter[] = array(
    'x1' => 250 + 2*(1182) + 60 , 'y1' => 0,
    'x2' => 250 + 2*(1182) + 60 , 'y2' => 30,
);

// col 1-2 bawah
$layout->gutter[] = array(
    'x1' => 250 + 2*(1182) , 'y1' => 3780,
    'x2' => 250 + 2*(1182) , 'y2' => 3780-30,
);
$layout->gutter[] = array(
    'x1' => 250 + 2*(1182) + 30 , 'y1' => 3780,
    'x2' => 250 + 2*(1182) + 30 , 'y2' => 3780-30,
);
$layout->gutter[] = array(
    'x1' => 250 + 2*(1182) + 60 , 'y1' => 3780,
    'x2' => 250 + 2*(1182) + 60 , 'y2' => 3780-30,
);

// row 1-2 kiri
$layout->gutter[] = array(
    'x1' => 100 , 'y1' => 60 + 1182,
    'x2' => 200 , 'y2' => 60 + 1182,
);
$layout->gutter[] = array(
    'x1' => 100 , 'y1' => 60 + 1182 + 30,
    'x2' => 200 , 'y2' => 60 + 1182 + 30,
);
$layout->gutter[] = array(
    'x1' => 100 , 'y1' => 60 + 1182 + 60,
    'x2' => 200 , 'y2' => 60 + 1182 + 60,
);

// row 2-3 kiri
$layout->gutter[] = array(
    'x1' => 100 , 'y1' => 60 + 2*1182 + 60,
    'x2' => 200 , 'y2' => 60 + 2*1182 + 60,
);
$layout->gutter[] = array(
    'x1' => 100 , 'y1' => 60 + 2*1182 + 60 + 30,
    'x2' => 200 , 'y2' => 60 + 2*1182 + 60 + 30,
);
$layout->gutter[] = array(
    'x1' => 100 , 'y1' => 60 + 2*1182 + 60 + 60,
    'x2' => 200 , 'y2' => 60 + 2*1182 + 60 +60,
);

// row 1-2 kanan
$layout->gutter[] = array(
    'x1' => 5280 - 100 , 'y1' => 60 + 1182,
    'x2' => 5280 - 200 , 'y2' => 60 + 1182,
);
$layout->gutter[] = array(
    'x1' => 5280 - 100 , 'y1' => 60 + 1182 + 30,
    'x2' => 5280 - 200 , 'y2' => 60 + 1182 + 30,
);
$layout->gutter[] = array(
    'x1' => 5280 - 100 , 'y1' => 60 + 1182 + 60,
    'x2' => 5280 - 200 , 'y2' => 60 + 1182 + 60,
);

// row 2-3 kanan
$layout->gutter[] = array(
    'x1' => 5280 - 100 , 'y1' => 60 + 2*1182 + 60,
    'x2' => 5280 - 200 , 'y2' => 60 + 2*1182 + 60,
);
$layout->gutter[] = array(
    'x1' => 5280 - 100 , 'y1' => 60 + 2*1182 + 60 + 30,
    'x2' => 5280 - 200 , 'y2' => 60 + 2*1182 + 60 + 30,
);
$layout->gutter[] = array(
    'x1' => 5280 - 100 , 'y1' => 60 + 2*1182 + 60 + 60,
    'x2' => 5280 - 200 , 'y2' => 60 + 2*1182 + 60 +60,
);


$count = 12;
$row = 3;
$col = 4;
$cellWidth = 1182;
$cellHeight = 1182;

$cols[] = 250;
$cols[] = 250+$cellWidth;
$cols[] = 250+$cellWidth*2+ 60;
$cols[] = 250+$cellWidth*3+ 60 ;

for ($i =  0; $i < $row; $i++) {
    for ($j = 0 ; $j < $col;$j++) {
    $padding = ($j % 2 ) ? 0 : 60 ;
    $posX = $cols[$j];
    $posY = (60 + $cellHeight) * $i + 60;
    $layout->box[] = array(        
        array('x'=> $posX , 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY ),
        array('x'=> $posX + $cellWidth, 'y' => $posY  + $cellHeight),
        array('x'=> $posX , 'y' => $posY + $cellHeight),
    );
    }
}

return $layout;