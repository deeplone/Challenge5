<?php

use frontend\models\LoginForm;
use frontend\models\RegisterForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$model = new LoginForm();
/* @var $this View */
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="modal fade modal-edited modal-theme modal-one" id="successPaymentModal" tabindex="-1" role="dialog"
         aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ctn">
                        <p>Giao dịch thanh toán thành công!</p>
                        <p id="rbtUpdateMessage">Mã hồ sơ trên hệ thống của quý khách là </p>
                        <p>Cảm ơn quý khách đã sử dụng dịch vụ của Viettel</p>
                        <p>
                            <a href="<?= Url::toRoute(['user/index']) ?>" type="button"
                               class="btn btn-block rounded-pill">Quay về quản lý kho nhạc quảng cáo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-edited modal-theme modal-one" id="successPaymentInternalModal" tabindex="-1" role="dialog"
         aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ctn">
                        <p id="rbtUpdateInternalMessage">Mã hồ sơ trên hệ thống của quý khách là </p>
                        <p>
                            <a href="<?= Url::toRoute(['user/index']) ?>" type="button"
                               class="btn btn-block rounded-pill">Quay về quản lý kho nhạc quảng cáo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
