<?php

/**
 * Created by PhpStorm.
 * User: Toanhv9
 * Date: 8/11/2015
 * Time: 4:29 PM
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller {

    public function beforeAction($action) {
        $this->layout = 'main';
        $this->view->title = 'Bài tập - Nghiêm Tuấn Hùng';
        if (Yii::$app->session->has('lang')) {
            Yii::$app->language = Yii::$app->session->get('lang');
        } else {
            Yii::$app->language = 'vi';
        }
        $request = Yii::$app->request;
        if ($request->isPjax || $request->getQueryParam('_pjax') || $request->isAjax) {
            $this->layout = false;
        }
        return parent::beforeAction($action);
    }

}
