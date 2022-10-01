    <?php
    $list = [
        [ //Hyperrealism
            ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
            ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
            ['src' => '5.jpg', 'width' => 1465, 'height' => 2000, 'alt' => ''],
            ['src' => '7.jpg', 'width' => 2000, 'height' => 1305, 'alt' => ''],
            ['src' => '8.jpg', 'width' => 2000, 'height' => 3000, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
            ['src' => '6.gif', 'width' => 800, 'height' => 1422, 'alt' => ''],
            ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
            ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
        ],
        [//Photorealism
            ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
            ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
            ['src' => '5.jpg', 'width' => 1465, 'height' => 2000, 'alt' => ''],
            ['src' => '7.jpg', 'width' => 2000, 'height' => 1305, 'alt' => ''],
            ['src' => '8.jpg', 'width' => 2000, 'height' => 3000, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
            ['src' => '6.gif', 'width' => 800, 'height' => 1422, 'alt' => ''],
            ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
            ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
        ],
        [ //Sketch
            ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
            ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
            ['src' => '5.jpg', 'width' => 1465, 'height' => 2000, 'alt' => ''],
            ['src' => '7.jpg', 'width' => 2000, 'height' => 1305, 'alt' => ''],
            ['src' => '8.jpg', 'width' => 2000, 'height' => 3000, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
            ['src' => '6.gif', 'width' => 800, 'height' => 1422, 'alt' => ''],
            ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
            ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
            ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
            ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
            ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
        ],
    ];
    $type = isset($portrait_type_id) ? [$portrait_type_id] : [1, 2, 3]
    ?>


    <?php foreach ($type as $type_id) { ?>
        <?= $this->render('_gallery_type', ['list' => $list[$type_id - 1], 'portrait_type_id' => $type_id]) ?>
    <?php } ?>




