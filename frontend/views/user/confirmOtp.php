<?php

use common\helpers\Helpers;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ConfirmRegisterForm */
?>

<?php $form = ActiveForm::begin(['action' => '/user/confirm-otp', 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>
<p class="font-italic text-center lblSentStatus"><?php if (!$model->getErrors()) echo "Hệ thống đã gửi một mã xác thực tới số thuê bao " . Helpers::hideMsisdn($model->msisdn);?></p>

<?= $form->field($model, 'otp')->textInput(['autofocus' => true, 'placeholder' => "Nhập mã OTP xác thực đăng ký", 'autocomplete' => 'off'])->label(false) ?>



<?= $form->field($model, 'msisdn')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'full_name')->hiddenInput()->label(false); ?>

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



<?= $form->field($model, 'agree')->checkbox(['label' => 'Tôi hoàn toàn đồng ý với điều khoản dịch vụ. Chi tiết điều khoản tham khảo <a onclick="readMore(\'info-6\')">tại đây</a>'])->label(false); ?>

<!--<div class="form-group">-->
<!--    <div class="form-check">-->
<!--        <div class="scroll-content font-italic txt-13">-->
<!--            <p>1. Sử dụng Dịch vụ theo đúng các điều khoản dịch vụ và các quy định của Bộ Thông tin và Truyền thông và Pháp luật Việt Nam.</p>-->
<!--            <p>2. Chịu mọi trách nhiệm liên quan tới bản quyền bài hát nhạc chờ và các trách nhiệm liên quan bao-->
<!--                gồm nhưng không giới hạn về quyền sở hữu trí tuệ hoặc bất ký khiếu nại về nội dung thông tin-->
<!--                được cung cấp qua hệ thống Dịch vụ.-->
<!--            </p>-->
<!--            <p>-->
<!--                3. Hoàn toàn chịu trách nhiệm và đảm bảo: nội dung bài hát không trái với thuần phong mỹ tục, văn hóa Việt Nam,-->
<!--                không có nội dung sex, không mang tính cá cược, đỏ đen; không gây xung đột lợi ích thương hiệu và đảm bảo các quy định khác của Pháp luật.-->
<!--            </p>-->
<!--            <p>-->
<!--                4. Chịu hoàn toàn trách nhiệm về khiếu nại liên quan thuê bao được cài đặt dịch vụ nhạc chờ doanh nghiệp và thực hiện bồi thường các tổn thất liên quan.-->
<!--            </p>-->
<!--            <p>-->
<!--                5. Thông báo tới tất cả thuê bao được cài đặt nhạc chờ trước khi cung cấp danh sách cho Viettel (trường hợp yêu cầu Viettel cài đặt dịch vụ);-->
<!--                đồng thời cam kết các thuê bao của doanh nghiệp chấp thuận và đồng ý về việc được cài đặt dịch vụ và bài hát nhạc chờ doanh nghiệp-->
<!--            </p>-->
<!--            <p>-->
<!--                6. Các điểu khoản khác về thanh toán, về thời hạn mã nhạc chờ theo quy định tại từng thời điểm do Viettel quy định.-->
<!--            </p>-->
<!--            <p>Chi tiết điều khoản tham khảo <a href="javascript:open('/info-6', 'popup-example', 'height='+window.innerheight+',width='+window.innerwidth+'resizable=no')">tại đây</a></p>-->
<!--            <p>Chi tiết điều khoản tham khảo <a onclick="readMore('info-6')">tại đây</a></p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="form-group">
    <?= Html::submitButton('Hoàn thành', ['class' => 'btn btn-block btnPopupSubmit']) ?>
</div>

<?php ActiveForm::end() ?>
