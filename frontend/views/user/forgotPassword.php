<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ForgotPasswordForm */
?>

<?php $form = ActiveForm::begin(['action' => Url::toRoute('/user/forgot-password'), 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>

<?= $form->field($model, 'msisdn')->textInput(['placeholder' => 'Số điện thoại', 'autofocus' => true])->label(false) ?>
<?=
$form->field($model, 'captcha')->widget(Captcha::className(), [
    'template' => '<div class="form-row">
                <div class="col-8 col-md-8">
                  {input}
                </div>
                <div class="col-4 col-md-4 captcha" style="padding-top: 1px;">
                  {image}
                </div>
              </div>',
    'options' => ['placeholder' => 'Nhập captcha'],
])->label(false)
?>

    <div class="form-group">
        <?= Html::submitButton('Lấy mã xác thực', ['class' => 'btn btn-block btnPopupSubmit']) ?>
    </div>
<?php ActiveForm::end(); ?>