<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class RbtUploadAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        '/js/rbtPlayer.js',
    ];
    public $depends = [
        'frontend\assets\RbtAsset',
    ];
}
