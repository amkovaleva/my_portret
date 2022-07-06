<?php

/* @var $this yii\web\View */

use powerkernel\photoswipe\Gallery;
use yii\helpers\Html;

$img_dir = '/images/index/';
?>
<div class="site-gallery">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="gallery__container">
    <?=
    Gallery::widget([
        'items' => [
            ['image' => $img_dir. '1.jpg', 'size' => '2000x2572', 'height' => 2572, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '1_thumb.jpg'],
            ['image' =>  $img_dir. '2.jpg', 'size' => '2000x2734', 'height' => 2734, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '2_thumb.jpg'],
            ['image' =>  $img_dir. '3.jpg', 'size' => '1480x2000', 'height' => 2000, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '3_thumb.jpg'],
            ['image' =>  $img_dir. '4.jpg', 'size' => '1402x2000', 'height' => 2000, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '4_thumb.jpg'],
            ['image' =>  $img_dir. '5.jpg', 'size' => '1465x2000', 'height' => 2000, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '5_thumb.jpg'],
            ['image' =>  $img_dir. '7.jpg', 'size' => '2000x1305', 'height' => 1305, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '7_thumb.jpg'],
            ['image' =>  $img_dir. '8.jpg', 'size' => '2000x3000', 'height' => 3000, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '8_thumb.jpg'],
            ['image' =>  $img_dir. '9.jpg', 'size' => '3000x2000', 'height' => 2000, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '9_thumb.jpg'],
            ['image' =>  $img_dir. '10.jpg', 'size' => '1500x2040', 'height' => 2040, 'title' => '', 'caption' => '', 'thumb'=> $img_dir. '10_thumb.jpg'],

        ]
    ]);
    ?>
    <div>

</div>
