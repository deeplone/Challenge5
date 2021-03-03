<?php

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
<?php $form = ActiveForm::begin(['action' => Url::toRoute('/rbt/payment-upload-confirm-1'),
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
