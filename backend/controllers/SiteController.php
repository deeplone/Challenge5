<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends AppController {

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main';
            return $this->render('index');
        }

        $this->redirect('login');
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUpload() {
        $root = '/uploads/ckeditor/' . date('Ymd') . '/';
        $uploads_dir = \Yii::getAlias('@webroot') . $root;
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        $file = $_FILES["upload"];
        if ($file["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $file["tmp_name"];
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $name = uniqid() . '.' . $extension;
            $allowed_extension = array("jpg", "gif", "png");
            if (in_array($extension, $allowed_extension)) {
                move_uploaded_file($tmp_name, $uploads_dir . $name);
                $function_number = $_GET['CKEditorFuncNum'];
                $url = $root . $name;
                $message = '';
                return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
            }
        }
        return '';
    }

}
