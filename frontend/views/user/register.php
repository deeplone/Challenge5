<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\RegisterForm */
?>

<?php $form = ActiveForm::begin(['action' => Url::toRoute('/user/register'), 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>

<?= $form->field($model, 'msisdn')->textInput(['autofocus' => true, 'placeholder' => "Số điện thoại"])->label(false) ?>

<?= $form->field($model, 'full_name')->input('full_name', ['placeholder' => "Họ và tên"])->label(false) ?>

<?= $form->field($model, 'email')->input('full_name', ['placeholder' => "Email"])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => "Đặt mật khẩu"])->label(false) ?>

<?= $form->field($model, 're_password')->passwordInput(['placeholder' => "Nhập lại mật khẩu"])->label(false) ?>



<div class="form-group">
    <?= Html::submitButton('Tiếp tục', ['class' => 'btn btn-block btnPopupSubmit']) ?>
</div>

<?php ActiveForm::end() ?>
