<?php

use frontend\models\EprBackground;
use frontend\models\EprRecordingContents;
use frontend\models\EprVoices;
use frontend\models\VoiceForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model VoiceForm */
/* @var $exampleContents EprRecordingContents[] */
/* @var $exampleVoices EprVoices[] */
/* @var $backgroundMusics EprBackground[] */
/* @var $voiceSpeeds array */
/* @var $giongDoc array */
/* @var $failStep integer */
?>

<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= Html::hiddenInput('failStep', $failStep, ['class' => 'failStep']) ?>
                <?php $form = ActiveForm::begin(['id' => 'formRecordOnline']); ?>
                <ul class="list-inline tab-4" id="onlineSelect">
                    <li class="list-inline-item rounded-pill active"><span class="d-none d-md-inline-block">Nội dung thu âm</span>
                        <span class="d-sm-none">Nội dung</span></li>
                    <li class="list-inline-item rounded-pill"><span class="d-none d-md-inline-block">Giọng đọc và tốc độ đọc</span>
                        <span class="d-sm-none">Tốc độ</span></li>
                    <li class="list-inline-item rounded-pill"><span class="d-none d-md-inline-block">Nhạc nền</span>
                        <span class="d-sm-none">Nhạc nền</span></li>
                    <li class="list-inline-item rounded-pill"><span class="d-none d-md-inline-block">Tên bài hát và mời cài nhạc chờ</span>
                        <span class="d-sm-none">Cài đặt</span></li>
                </ul>

                <div class="ctn ctn-2 onlineStep" id="onlineStep1">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-italic">Mời Quý khách nhập nội dung quảng cáo hoặc lựa chọn các mẫu quảng cáo có sẵn.
                                Số lượng ký tự từ 550 đến 1200 ký tự</p>
                            <p class="text-right font-italic">
                                <strong>Bạn có thể sử dụng mẫu nội dung quảng cáo </strong>
                                <a href="#" data-toggle="modal" data-target="#referenceModal"><u>tại đây</u></a>
                            </p>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nội dung quảng cáo *</label>
                                <div class="col-sm-9">
                                    <?= $form->field($model, 'recording_content')->textarea([
                                        'class' => 'form-control txtContent',
                                        'placeholder' => 'Nhập nội dung quảng cáo tại đây',
                                        'rows' => 3,
                                        'maxlength' => 1200,
                                    ])->label(false) ?>
                                    <small class="form-text text-muted" id="showCharater">
                                        Số lượng ký tự: 0/1200
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <?php if($model->id) { ?>
                            <a href="<?= Url::toRoute(['user/index']) ?>" class="lnk-pre">Quay lại</a>
                        <?php } else { ?>
                            <a href="<?= Url::toRoute(['rbt/create']) ?>" class="lnk-pre">Quay lại</a>
                        <?php } ?>
                        <a href="javascript:goStepOnline(2, 1)" class="lnk-pre">Tiếp tục</a>
                    </div>
                </div>

                <div class="ctn ctn-3 onlineStep" id="onlineStep2" style="display: none">
                    <div id="formChooseVoice">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="ttl-sub" style="margin-top: 0">Mời bạn lựa chọn giọng đọc</h3>
                            </div>
                        </div>
                        <?php foreach ($exampleVoices as $index => $voice): ?>
                            <?= $index % 2 == 0 ? '<div class="row">' : '' ?>
                            <div class="col-md-5 <?= $index % 2 == 0 ? "offset-md-1" : "" ?> ">
                                <div class="row-try">
                                    <div class="col-try">
                                        <button type="button"
                                                data-value="<?= $voice->getFile() ?>"
                                                class="btn btn-outline-blue-aqua rounded-pill btn-listen btnPlayRbt">
                                            <span class="txt rbtPlay">Nghe thử</span><i class="mdi mdi-pause"></i>
                                        </button>
                                    </div>
                                    <div class="col-try">
                                        <div data-value="<?= $voice->code ?>" data-save="<?= $voice->id ?>" class="btn btn-blue-aqua rounded-pill btnChooseVoice
                                    <?= ($model->accent && $model->accent == $voice->id) ? "btn-blue-aqua-selected" : "" ?>">
                                            <?= Html::encode($voice->description) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?= $index % 2 == 1 ? '</div>' : '' ?>
                        <?php endforeach; ?>
                        <?= count($exampleVoices) % 2 > 0 ? "</div>" : "" ?>
                        <div class="row error-display">
                            <div class="col-md-10 offset-md-1" style="padding-bottom: 0">
                                <?= $form->field($model, 'accent')->hiddenInput(['class' => 'form-control valChooseVoiceSave'])->label(false); ?>
                                <?= Html::hiddenInput('valChooseVoiceSave', $giongDoc, ['class' => 'valChooseVoice']) ?>
                            </div>
                        </div>
                    </div>
                    <div id="formChooseSpeed">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="ttl-sub" >Mời bạn lựa chọn tốc độ đọc</h3>
                            </div>
                        </div>
                        <?php $index = 0 ?>
                        <?php foreach ($voiceSpeeds as $value => $speed): ?>
                            <?= $index % 3 == 0 ? '<div class="row">' : '' ?>
                            <div class="col-md-3 <?= $index % 3 == 0 ? "offset-md-1" : "" ?>">
                                <div data-value="<?= $value ?>" class="btn btn-blue-aqua btn-block rounded-pill btnChooseSpeed
                            <?= ($model->intonational && $model->intonational == $value) ? "btn-blue-aqua-selected" : "" ?>">
                                    <?= Html::encode($speed) ?>
                                </div>
                            </div>
                            <?= $index % 3 == 2 ? '</div>' : '' ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                        <?= count($voiceSpeeds) % 3 > 0 ? "</div>" : "" ?>
                        <div class="row error-display">
                            <div class="col-md-10 offset-md-1" style="padding-bottom: 0">
                                <?= $form->field($model, 'intonational')->hiddenInput(['class' => 'form-control valChooseSpeed'])->label(false); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="javascript:backStepOnline(1, 2)" class="lnk-pre">Quay lại</a>
                        <a href="javascript:goStepOnline(3, 2)" class="lnk-pre">Tiếp tục</a>
                    </div>
                </div>

                <div class="ctn ctn-3 onlineStep" id="onlineStep3" style="display: none">
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn nhạc nền</h3>
                        </div>
                    </div>
                    <div id="formChooseSpeed">
                        <?php foreach ($backgroundMusics as $index => $background): ?>
                            <div class="row justify-content-md-center mt-3">
                                <div class="col-md-6">
                                    <div class="row-try">
                                        <div class="col-try">
                                            <button data-value="<?= $background->getFile() ?>" type="button"
                                                    class="btn btn-outline-blue-aqua rounded-pill btn-listen btnPlayRbt">
                                                <span class="txt">Nghe thử</span>
                                                <i class="btnPlayRbtHot mdi mdi-pause"></i>
                                            </button>
                                        </div>
                                        <div class="col-try">
                                            <div data-value="<?= $background->path ?>" class="btn btn-blue-aqua rounded-pill btnChooseMusic
                                            <?= ($model->sound_background && $model->sound_background == $background->path) ? "btn-blue-aqua-selected" : "" ?>">
                                                <?= Html::encode($background->name) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="row error-display">
                            <div class="col-md-10 offset-md-1" style="padding-bottom: 0">
                                <?= $form->field($model, 'sound_background')->hiddenInput(['class' => 'form-control valChooseMusic'])->label(false); ?>
                                <?= Html::hiddenInput('valHideChooseMusic', null, ['class' => 'form-control valHideChooseMusic']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="javascript:backStepOnline(2, 3)" class="lnk-pre">Quay lại</a>
                        <a href="javascript:generateRbt('<?= Url::toRoute(['rbt/generate-rbt']) ?>')" class="lnk-pre">
                            Nghe thử nhạc chờ
                            <?= $form->field($model, 'recording_file')->hiddenInput(['class' => 'form-control valRecordingFile'])->label(false); ?>
                        </a>
                    </div>
                </div>

                <div class="ctn ctn-2 onlineStep" id="onlineStep4" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên bài hát <span
                                            class="red-star">*</span></label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'name')->textInput([
                                        'placeholder' => 'Nhập tên bài hát ở đây',
                                        'required' => true
                                    ])->label(false); ?>
                                </div>
                            </div>

                            <div class="form-group row mb-1" style="padding-top: 40px;">
                                <label for="inputPassword" class="col-md-9 col-form-label">
                                    Giấy tờ bản quyền (bắt buộc)<span class="red-star">*</span>
                                </label>
                                <div class="col-md-3">
                                    <div class="upload-btn-wrapper">
                                        <button id="btn-copyright_license" class="btn-upload hvr-wobble-horizontal">Attach file</button>
                                        <?= $form->field($model, 'copyright_license')->fileInput(['accept' => '.pdf, .png, .jpg'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-top: 20px;">
                                <div class="col-md-9 txt-1">
                                    <p><span>Quý khách cần nhập các giấy tờ liên quan như sau:</span></p>
                                    <ul style="list-style-type: square;">
                                        <li><span>Giấy phép đăng ký kinh doanh của doanh nghiệp</span></li>
                                        <li><span>Chứng minh thư của Giám đốc doanh nghiệp (hoặc CMT của người đại diện)</span></li>
                                        <li><span>Giấy cam kết bản quyền và nội dung nhạc chờ đưa lên (tải mẫu <a href="/uploads/msisdn/camket.docx" class="text-decoration-none" download><u>tại đây</u></a>)</span></li>
                                        <li><span>Giấy tờ liên quan đến bản quyền nếu nội dung quảng cáo của quý khách là tác phẩm âm nhạc hoặc có sự thể hiện của ca sĩ, nhạc sĩ. (nếu có)</span></li>
                                    </ul>
                                    <p><span>Quý khách đính kèm giấy tờ bản quyền nội dung quảng cáo tại đây. Định dạng file là:<strong> pdf, png, jpg.</strong></span></p>
                                </div>
                            </div>

                            <div class="form-group row mb-1" style="padding-top: 40px;">
                                <label for="inputPassword" class="col-md-9 col-form-label">
                                    Danh sách thuê bao mời cài đặt nhạc chờ quảng cáo (nếu có)
                                </label>
                                <div class="col-md-3">
                                    <div class="upload-btn-wrapper">
                                        <button id="btn-msisdn_file" class="btn-upload hvr-wobble-horizontal">Attach file</button>
                                        <?= $form->field($model, 'msisdn_file')->fileInput(['accept' => '.txt'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 txt-1" style="margin-top: 20px">
                                    Đính kèm danh sách thuê bao mời cài đặt nhạc chờ quảng cáo (đảm bảo là cán bộ, nhân viên của doanh nghiệp).<br>
                                    Hệ thống sẽ gửi lời mời tới thuê bao được yêu cầu. Định dạng file là: txt.<br>
                                    Lấy file mẫu <a href="/uploads/msisdn/1.txt" class="text-decoration-none" download><u>tại đây</u></a>
                                </div>
                            </div>
                            <?php if (Yii::$app->user->getIdentity()->type == USER_TYPE_INTERNAL) { ?>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Số điện thoại thực hiện thanh toán <span
                                            class="red-star">*</span></label>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'msisdn_pay')->textInput([
                                        'placeholder' => 'Nhập SĐT tại đây'
                                    ])->label(false); ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="javascript:backStepOnline(3, 4)" class="lnk-pre">Quay lại</a>
                        <button type="submit" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>

<div class="modal fade modal-edited modal-edited-gradient" id="referenceModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center text-uppercase">Các mẫu nội dung quảng cáo tham khảo:
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
                <?php foreach ($exampleContents as $content): ?>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-shrink-1">
                            <p>Tích chọn</p>
                            <div class="pretty p-icon p-round p-pulse">
                                <input type="radio" name="chooseExampleContent"
                                       value="<?= $content->recording_content; ?>"/>
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>&nbsp;</label>
                                </div>
                            </div>

                        </div>
                        <div class="p-2 w-100">
                            <p>Nội dung tham khảo</p>
                            <div class="ctn-template"><?= Html::encode($content->recording_content); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-edited modal-theme" id="listenModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button onclick="Amplitude.pause();$('#listenModal').modal('hide');" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="player">
                    <div id="single-song-player">
                        <img data-amplitude-song-info="cover_art_url" src="/images/cd.png">
                        <div id="containerProgressBar">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 172 155">
                                <path fill-opacity="0" stroke-width="1" stroke="#fff" d="M40 150A80 80 0 1 1 140 150"/>
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

                            <div class="control-container player-control" style="display: none;">
                                <div class="amplitude-play-pause amplitude-paused" id="play-pause"></div>
                                <div class="meta-container">
                                    <span data-amplitude-song-info="name" class="song-name"></span>
                                    <span data-amplitude-song-info="artist"></span>
                                </div>
                            </div>

                            <div class="loading popup-loading" style="display: none;">
                                <div class="loader">
                                </div>
                                Đang tạo đoạn nhạc chờ ...
                            </div>
                        </div>
                    </div>

                    <div class="text-right btnNext"
                         onclick="Amplitude.pause();$('#listenModal').modal('hide');goStepOnline(4, 3);">Tiếp tục
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>