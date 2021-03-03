<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $intonational mixed */
/* @var $accent mixed */
/* @var $back mixed */
/* @var $model \frontend\models\EnterpriseFile|null */
/* @var $phoneNumber string */
/* @var $message string */
/* @var $fee1 int */
/* @var $fee2 int */
?>

<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ctn ctn-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="ttl-sub">Thông tin nhạc chờ doanh nghiệp</h3>
                            <p>1. Tên bài hát: <span class="txt-color"><?= $model->name; ?></span></p>
                            <p>2. Nội dung quảng cáo:</p>
                            <p class="txt-1 txt-color">
                                <?= Html::encode($model->recording_content); ?>
                            </p>
                            <p>3. Giọng đọc: <span class="txt-color"><?= $accent ?></span></p>
                            <p>4. Ngữ điệu: <span class="txt-color"><?= $intonational ?></span></p>
                            <p>5. Nhạc nền: <span
                                    class="txt-color"><?= $model->sound_background ? "Có" : "Không" ?></span></p>
                            <p>6. Yêu cầu mời các thuê bao cài đặt nhạc chờ: <span
                                    class="txt-color"><?= filesize('uploads'.$model->msisdn_file) > 1 ? "Có" : "Không" ?></span></p>
                        </div>
                        <div class="col-md-6">
                            <div class="card-group text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Thanh toán yêu cầu</h5>
                                        <p class="card-text">Phí khởi tạo: <?= number_format($fee1); ?> VNĐ</p>
                                        <p class="card-text">Phí thu âm: <?= number_format($fee2); ?> VNĐ</p>
                                        <p class="card-text">Tổng tiền: <?= number_format($fee1 + $fee2); ?> VNĐ</p>

                                        <?php Pjax::begin(['id' => 'pPaymentForm', 'timeout' => 5000, 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                                        <?= $this->render('_paymentRequest', ['id' => $model->id, 'phoneNumber' => $phoneNumber, 'message' => $message]); ?>

                                        <?php Pjax::end(); ?>

                                        <div class="loading popup-loading" style="display: none;">
                                            <div class="loader">
                                            </div>
                                            Đang xử lý ...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <?php if ($back) { ?>
                            <a href="<?= Url::toRoute(['/home']) ?>" class="lnk-pre">Quay
                                lại</a>
                        <?php } else { ?>
                            <a href="<?= Url::toRoute(['rbt/record-request', 'id' => $model->id, 'step' => 3]) ?>" class="lnk-pre">Quay
                                lại</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
