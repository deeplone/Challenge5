<?php

use frontend\assets\RbtUploadAsset;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $intonational mixed */
/* @var $accent mixed */
/* @var $back mixed */
/* @var $model \frontend\models\EnterpriseFile|null */
/* @var $phoneNumber string */
/* @var $message string */
/* @var $fee int */

RbtUploadAsset::register($this);
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
                            <p>2. File quảng cáo:</p>
                            <div class="player">
                                <div id="single-song-player">
                                    <img data-amplitude-song-info="cover_art_url" src="/images/cd.png">
                                    <div id="containerProgressBar1">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px"
                                             viewBox="0 0 172 155">
                                            <path fill-opacity="0" stroke-width="1" stroke="#fff"
                                                  d="M40 150A80 80 0 1 1 140 150"/>
                                            <path id="heart-path" fill-opacity="0" stroke-width="3" stroke="#fff"
                                                  d="M40 150A80 80 0 1 1 140 150"/>
                                        </svg>
                                    </div>
                                    <div class="bottom-container">
                                        <div class="time-container">
                                      <span class="current-time">
                                        <span class="amplitude-current-minutes">00</span>:<span
                                                  class="amplitude-current-seconds">00</span>
                                      </span>
                                            <span class="duration">
                                        <span class="amplitude-duration-minutes">03</span>:<span
                                                        class="amplitude-duration-seconds">30</span>
                                      </span>
                                        </div>

                                        <div class="control-container player-control">
                                            <div class="amplitude-play-pause amplitude-paused" id="play-pause"></div>
                                            <div class="meta-container">
                                                <span data-amplitude-song-info="name" class="song-name"></span>
                                                <span data-amplitude-song-info="artist"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>3. Yêu cầu mời các thuê bao cài đặt nhạc chờ: <span
                                        class="txt-color"><?= filesize('uploads'.$model->msisdn_file) > 1 ? "Có" : "Không" ?></span></p>
                        </div>
                        <div class="col-md-6">
                            <div class="card-group text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Thanh toán yêu cầu</h5>
                                        <p class="card-text">Phí khởi tạo: <?= number_format($fee); ?> VNĐ</p>
                                        <p class="card-text">Tổng tiền: <?= number_format($fee); ?>
                                            VNĐ</p>

                                        <?php Pjax::begin(['id' => 'pPaymentForm', 'timeout' => 5000, 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                                        <?= $this->render('_paymentUploadInternal', ['id' => $model->id, 'phoneNumber' => $phoneNumber, 'message' => $message, 'success' => false]); ?>

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
                            <a href="<?= Url::toRoute(['/home']) ?>" class="lnk-pre">Quay lại</a>
                        <?php } else { ?>
                            <a href="<?= Url::toRoute(['rbt/record-upload', 'id' => $model->id]) ?>" class="lnk-pre">Quay
                                lại</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
