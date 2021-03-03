<?php


namespace frontend\controllers;


use frontend\models\EprClass;
use frontend\models\RbtHot;

class HomeController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_DEV ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $allClass = EprClass::getAllClass(9);
        return $this->render('index', ['allClass' => $allClass]);
    }
}