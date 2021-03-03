<?php

use common\helpers\Helpers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $id int */
/* @var $phoneNumber string */
/* @var $message string */
if (!isset($message) || !$message) $message = 'Vui lòng đảm bảo tài khoản của quý khách đủ để thanh toán giao dịch này';
?>
<div class="txt-line" style="font-family: Helvetica-Regular">
    Quý khách sẽ thực hiện thanh toán cước phí tạo nhạc chờ quảng cáo bằng tài khoản gốc di
    động của số thuê bao <span class="txt-color"><?= $phoneNumber ?></span>
</div>
<?php $form = ActiveForm::begin(['action' => Url::toRoute('/rbt/payment-upload-internal-confirm'),
    'options' => ['data-pjax' => true, 'class' => 'form-payment']]); ?>
    <?= Html::hiddenInput('id', $id) ?>

    <div class="form-group">
        <?= Html::submitButton('Thanh toán', ['class' => 'btn btn-accept btn-block rounded-pill']) ?>
    </div>
<?php ActiveForm::end(); ?>
<div class="form-group was-validated" style="display: block;">
    <div class="invalid-feedback d-block">
        <?= $message ?>
    </div>
</div>
<?php if (isset($success) && $success): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#rbtUpdateInternalMessage').html('Bạn đã gửi yêu cầu thanh toán đến số điện thoại ' +
                '<?= $phoneNumber ?>'  + ' thành công.<br/>' +
                'Mã hồ sơ trên hệ thống là ' + '<?= Helpers::eprCode($id) ?>' + '.<br/>' +
                'Hãy hướng dẫn khách hàng soạn <b>YN ' + '<?= Helpers::eprCode($id) ?>' +
                '</b> gửi <b>1221</b> để thực hiện xác thực thanh toán.'
            );
            // $('#successPaymentModal').modal('show');
            $('#successPaymentInternalModal').modal({backdrop: 'static', keyboard: false})
        });
    </script>
<?php endif; ?>
