<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class RbtAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/all.css',
        '/css/animate.min.css',
        '/css/hover-min.css',
        '/css/pretty-checkbox.min.css',
        '/css/materialdesignicons.css',
        '/css/bootstrap.min.css',
        '/css/style.css',
        '/css/coder_update.css',
    ];
    public $js = [
        '/js/bootstrap.min.js',
        '/js/smooth-scroll.polyfills.js',
        '/js/scrollreveal.js',
        '/js/amplitude.js',
        '/js/progressbar.js',
        '/js/common.js',
        '/js/rbt.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
