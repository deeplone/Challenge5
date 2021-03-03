<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'vi',
    'controllerNamespace' => 'api\controllers',
    'components' => [

        'user' => [
            'identityClass' => 'api\models\auth\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['radius'],
                    'logVars' => [],
                    'logFile' => '@logs/frontend/radius.log',
                    'maxFileSize' => 102400, //100MB
                    'rotateByCopy' => false
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@logs/api/error.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@logs/api/warning.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@logs/api/info.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['yii\db\Command*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/api/queries.log',
                ],
            ],
        ],
        'request' => [
            'enableCsrfValidation' => false
        ],
        'errorHandler' => [
            'errorAction' => 'api/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routing.php')
        ],
    ],
    'params' => $params,
];
