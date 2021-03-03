<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\LoginForm */
?>

<?php $form = ActiveForm::begin(['action' => Url::toRoute('/user/login'), 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>

<?= $form->field($model, 'msisdn')->textInput(['autofocus' => true])->input('msisdn', ['placeholder' => "Số điện thoại"])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Mật khẩu"])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-block btnPopupSubmit']) ?>
    </div>


    <div class="form-group last-row">
        <div class="form-row">
            <div class="col-5 col-md-5 text-right">
                <a onclick="forgotPasswordPopup();" class="text-reset text-decoration-none active">Quên mật khẩu</a>
            </div>
            <div class="col-2 col-md-2 text-center">
                <span class="border-right"></span>
            </div>
            <div class="col-5 col-md-5 text-left">
                <a onclick="registerPopup();" class="text-reset text-decoration-none">Đăng ký</a>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>