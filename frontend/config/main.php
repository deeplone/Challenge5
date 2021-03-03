<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'vi',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
//            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => true,
            'enableCsrfCookie' => false,
        ],
        'user' => [
            'identityClass' => 'frontend\models\Enteprise',
            'enableAutoLogin' => true,
            'authTimeout' => LOGIN_TIMEOUT,
            'identityCookie' => [
                'name' => '_wapIdentity',
                'httpOnly' => true,
                'expire' => LOGIN_TIMEOUT
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'imuzik-enterprise',
        ],
        'cache' => [
            'keyPrefix' => 'frontend.',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@logs/frontend/error.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@logs/frontend/warning.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@logs/frontend/info.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['yii\db\Command*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/frontend/queries.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['otp*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/frontend/otp.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['Charging*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/frontend/charging.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['vtcc.ai*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/frontend/vtcc.ai.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routing.php')
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'devicedetect' => [
            'class' => '\skeeks\yii2\mobiledetect\MobileDetect'
        ],
    ],
    'params' => $params,
];
