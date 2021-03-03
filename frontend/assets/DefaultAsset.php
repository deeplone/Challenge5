<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class DefaultAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
//        'css/site.css',
    ];
    public $js = [
        'js/script.js',
        'js/web.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
