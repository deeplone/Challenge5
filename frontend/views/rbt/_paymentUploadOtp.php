<?php

use common\helpers\Helpers;
use frontend\models\OtpConfirmForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $phoneNumber string */
/* @var $msisdn string */
/* @var $message string */
/* @var $fee integer */
/* @var $model OtpConfirmForm */
/* @var $epr_id string */
?>

<?php $form = ActiveForm::begin(['action' => Url::toRoute('/rbt/payment-upload-confirm-2'),
    'options' => ['data-pjax' => true, 'class' => 'form-payment']]); ?>
    <div class="txt-line">
        <div class="lblSentStatus">
            Hệ thống đã gửi một mã OTP xác thực thanh toán về số điện thoại <span class="txt-color"><?= $phoneNumber ?></span>
        </div>
        Số tiền cần thanh toán là <span
                class="txt-color"><?= number_format($fee); ?> VNĐ</span>
    </div>
<?= $form->field($model, 'otp')->textInput(['autocomplete' => 'off', 'placeholder' => 'Nhập mã OTP tại đây', 'onKeyPress'=> 'if(this.value.length==6) return false;', 'type' => 'number',
    'class' => 'form-control rounded-pill text-center'])->label(false) ?>
<?= Html::hiddenInput('id', $id) ?>
    <div class="form-group">
        <?= Html::submitButton('Thanh toán', ['class' => 'btn btn-accept btn-block rounded-pill btnResendOtp']) ?>
    </div>
    <div class="form-group">
        <p>
            <a onclick="clearErrorMsg()" href="javascript:resendOtp('/user/resend-otp','<?= $msisdn ?>')">Lấy lại mã xác thực OTP</a>
        </p>
    </div>
    <div class="form-group was-validated">
        <div class="invalid-feedback d-block">
            <?= $message ?>
        </div>
    </div>
<?php if (isset($success) && $success): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#rbtUpdateMessage').html('Mã hồ sơ trên hệ thống của quý khách là ' + '<?= Helpers::eprCode($id) ?>');
            // $('#successPaymentModal').modal('show');
            $('#successPaymentModal').modal({backdrop: 'static', keyboard: false})
        });
    </script>
<?php endif; ?>
<?php ActiveForm::end(); ?>