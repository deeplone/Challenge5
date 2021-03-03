<?php

use common\helpers\Helpers;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ForgotPasswordOtpForm */
?>

<?php $form = ActiveForm::begin(['action' => Url::toRoute('/user/change-password'), 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>

<?= $form->field($model, 'otp')->textInput(['placeholder' => 'Mã xác thực', 'autofocus' => true])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Mật khẩu mới'])->label(false) ?>

<?= $form->field($model, 're_password')->passwordInput(['placeholder' => 'Nhập lại mật khẩu mới'])->label(false) ?>

<?= $form->field($model, 'msisdn')->hiddenInput()->label(false); ?>

    <p class="text-center">
        <a href="javascript:resendOtp('<?= Url::toRoute('/user/resend-otp') ?>', '<?= $model->msisdn; ?>')"
           class="text-reset font-weight-bold btnResendOtp">
            <span class="mdi mdi-refresh"></span> Lấy lại mã xác thực OTP
        </a>
    </p>

    <p class="font-italic text-center lblSentStatus">Hệ thống đã gửi một mã xác thực tới số thuê bao <?= Helpers::hideMsisdn($model->msisdn); ?></p>

    <div class="form-group">
        <?= Html::submitButton('Xác nhận', ['class' => 'btn btn-block btnPopupSubmit']) ?>
    </div>

<?php if (isset($success) && $success): ?>
    <script type="text/javascript">
        alert("Bạn đã lấy mật khẩu thành công. Vui lòng đăng nhập để sử dụng dịch vụ.");
        $('#forgotPasswordModal').modal('hide');
        $('#loginModal').modal('show');
    </script>
<?php endif; ?>

<?php ActiveForm::end(); ?>