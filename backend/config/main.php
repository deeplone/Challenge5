<?php

$params = array_merge(
        require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'vi',
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => LOGIN_TIMEOUT,
            'identityCookie' => [
                'name' => '_backendIdentity',
                'httpOnly' => true,
                'expire' => LOGIN_TIMEOUT
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'cms',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@logs/backend/error.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@logs/backend/warning.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@logs/backend/info.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['yii\db\Command*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/backend/queries.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => '/site/index',
                'login' => '/site/login',
                'logout' => '/site/logout',
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
            //these configuratio allow to rename the auth table  
            'itemTable' => 'epr_auth_item',
            'assignmentTable' => 'epr_auth_assignment',
            'itemChildTable' => 'epr_auth_item_child',
            'ruleTable' => 'epr_auth_rule',
        ],
        'request' => [
            'enableCsrfCookie' => true,
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
        ]
    ],
    'params' => $params,
];
