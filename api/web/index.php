<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

define('_APP_PATH_', dirname(__FILE__));
date_default_timezone_set('Asia/Ho_Chi_Minh');
ini_set('session.cookie_httponly', 1);
ini_set('upload_max_filesize', '1024M');
ini_set('post_max_size', '1024M');
error_reporting(0);

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');
require(__DIR__ . '/../../common/config/predefined.php');

$config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/../../common/config/main.php'), 
        require(__DIR__ . '/../../common/config/main-local.php'), 
        require(__DIR__ . '/../config/main.php'), 
        require(__DIR__ . '/../config/main-local.php')
);
(new yii\web\Application($config))->run();
