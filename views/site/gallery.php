<?php

use yii\web\View;

$list = [
    [ //Hyperrealism
        ['image' => '1.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
        ['image' => '2.gif', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
        ['image' => '3.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '4.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '5.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '6.jpg', 'width' => 1465, 'height' => 2000,  'orig_width' => 1465, 'orig_height' => 2000, 'title' => ''],
        ['image' => '7.jpg', 'width' => 2000, 'height' => 1305, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
        ['image' => '8.jpg', 'width' => 2000, 'height' => 3000,  'orig_width' => 2000, 'orig_height' => 3000, 'title' => ''],
        ['image' => '9.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '10.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '11.jpg', 'width' => 800, 'height' => 2000, 'orig_width' => 800, 'orig_height' => 2000, 'title' => ''],
        ['image' => '12.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 2572, 'title' => ''],
        ['image' => '13.jpg', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
        ['image' => '14.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '15.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '16.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '17.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
    ],
    [//Photorealism
        ['image' => '1.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
        ['image' => '2.gif', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
        ['image' => '3.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '4.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '5.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '6.jpg', 'width' => 1465, 'height' => 2000,  'orig_width' => 1465, 'orig_height' => 2000, 'title' => ''],
        ['image' => '7.jpg', 'width' => 2000, 'height' => 1305, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
        ['image' => '8.jpg', 'width' => 2000, 'height' => 3000,  'orig_width' => 2000, 'orig_height' => 3000, 'title' => ''],
        ['image' => '9.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '10.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '11.jpg', 'width' => 800, 'height' => 2000, 'orig_width' => 800, 'orig_height' => 2000, 'title' => ''],
        ['image' => '12.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 2572, 'title' => ''],
        ['image' => '13.jpg', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
        ['image' => '14.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '15.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '16.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '17.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
    ],
    [ //Sketch
        ['image' => '1.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
        ['image' => '2.gif', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
        ['image' => '3.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '4.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '5.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '6.jpg', 'width' => 1465, 'height' => 2000,  'orig_width' => 1465, 'orig_height' => 2000, 'title' => ''],
        ['image' => '7.jpg', 'width' => 2000, 'height' => 1305, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
        ['image' => '8.jpg', 'width' => 2000, 'height' => 3000,  'orig_width' => 2000, 'orig_height' => 3000, 'title' => ''],
        ['image' => '9.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '10.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '11.jpg', 'width' => 800, 'height' => 2000, 'orig_width' => 800, 'orig_height' => 2000, 'title' => ''],
        ['image' => '12.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 2572, 'title' => ''],
        ['image' => '13.jpg', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
        ['image' => '14.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
        ['image' => '15.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040,  'title' => ''],
        ['image' => '16.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
        ['image' => '17.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000,'title' => ''],
    ],
];
$type = isset($portrait_type_id) ? [$portrait_type_id] : [1, 2, 3]
?>

<div class="pswp-gallery" id="my-gallery">
    <?php foreach ($type as $type_id) { ?>
        <?= $this->render('_gallery_type', ['list' => $list[$type_id - 1], 'portrait_type_id' => $type_id]) ?>
    <?php } ?>
</div>


<?php
$this->registerJs(<<<JS
const lightbox = new PhotoSwipeLightbox({
  gallery: "#my-gallery",
  children: "a.waterfall__link",
  pswpModule: () => PhotoSwipe
});

lightbox.init();
JS
    ,
    View::POS_READY
);
?>
