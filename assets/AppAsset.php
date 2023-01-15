<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/site.css',
        'PhotoSwipe/photoswipe.css',
    ];
    public $js = [
        'js/jquery.spincrement.js',
        'js/outline.js',
        'js/_burger.js',
        'js/_select.js',
        'js/_color-picker.js',
       // 'js/_materials.js',
        'js/_currency-store.js',
        'js/_spincrement.js',
        'js/_modal.js',
        'js/_order.js',
        'js/_store.js',
        'PhotoSwipe/photoswipe.umd.min.js',
        'PhotoSwipe/photoswipe-lightbox.umd.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'demi\cropper\CropperAsset',
    ];
}
