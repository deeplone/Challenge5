<?php


namespace frontend\controllers;


use frontend\models\EprInfo;
use frontend\models\RbtHot;

class InfoController extends AppController
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
        ];
    }

    public function actionIndex($id) {
        $this->layout = 'info';
        $info = EprInfo::findOneByType(intval($id));
        return $this->render('index', ['info' => $info]);
    }
}