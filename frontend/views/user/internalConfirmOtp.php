<?php

use common\helpers\Helpers;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ConfirmRegisterForm */
?>

<?php $form = ActiveForm::begin(['action' => '/user/internal-confirm-otp', 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>
<p class="font-italic text-center lblSentStatus"><?php if (!$model->getErrors()) echo "Hệ thống đã gửi một mã xác thực tới số thuê bao " . Helpers::hideMsisdn($model->msisdn); ?></p>

<?= $form->field($model, 'otp')->textInput(['autofocus' => true, 'placeholder' => "Nhập mã OTP xác thực đăng ký", 'autocomplete' => 'off'])->label(false) ?>


<?= $form->field($model, 'msisdn')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'email')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'id_number')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'password')->hiddenInput()->label(false); ?>

<?= $form->field($model, 're_password')->hiddenInput()->label(false); ?>

<p class="text-center">
    <a href="javascript:resendOtp('<?= Url::toRoute('/user/resend-otp') ?>', '<?= $model->msisdn; ?>')"
       class="text-reset font-weight-bold btnResendOtp">
        <span class="mdi mdi-refresh"></span> Lấy lại mã xác thực OTP
    </a>
</p>


<?= $form->field($model, 'agree')->checkbox(['label' => 'Tôi hoàn toàn đồng ý với điều khoản dịch vụ. Chi tiết điều khoản tham khảo <a href="javascript:readMore(\'' . Url::toRoute(['info/index', 'id' => Yii::$app->params['page-policy']]) . '\')">tại đây</a>'])->label(false); ?>

<div class="form-group">
    <?= Html::submitButton('Hoàn thành', ['class' => 'btn btn-block btnPopupSubmit']) ?>
</div>

<?php ActiveForm::end() ?>
