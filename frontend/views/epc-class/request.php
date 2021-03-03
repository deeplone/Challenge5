<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\RequestRbtForm */
/* @var $exampleContents \frontend\models\EprRecordingContents[] */
/* @var $accents mixed */
/* @var $failStep mixed */
/* @var $linguistics mixed */
/* @var $sound_background mixed */

 ?>

<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <?= Html::hiddenInput('failStep', $failStep, ['class' => 'failStep']) ?>
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'formRecordOnline']); ?>
                <ul class="list-inline tab-3" id="onlineSelect">
                    <li class="list-inline-item rounded-pill active"><span class="d-none d-md-inline-block">Nội dung thu âm</span>
                        <span class="d-sm-none">Nội dung</span></li>
                    <li class="list-inline-item rounded-pill"><span class="d-none d-md-inline-block">Giọng đọc, ngữ điệu và nhạc nền</span>
                        <span class="d-sm-none">Giọng đọc</span></li>
                    <li class="list-inline-item rounded-pill"><span class="d-none d-md-inline-block">Tên bài hát và mời cài nhạc chờ</span>
                        <span class="d-sm-none">Cài đặt</span></li>
                </ul>

                <div class="ctn ctn-2 onlineStep" id="onlineStep1">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-italic">Mời Quý khách nhập nội dung quảng cáo hoặc lựa chọn các mẫu quảng cáo
                                có sẵn. Số lượng ký tự từ 550 đến 1200 ký tự</p>
                            <p class="text-right font-italic">
                                <strong>Bạn có thể sử dụng mẫu nội dung quảng cáo</strong> <a href="#" data-toggle="modal" data-target="#referenceModal"><u>tại đây</u></a>

                            </p>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nội dung quảng cáo</label>
                                <div class="col-sm-9">
                                    <?= $form->field($model, 'recording_content')->textarea([
                                        'class' => 'form-control txtContent',
                                        'placeholder' => 'Nhập nội dung quảng cáo tại đây *',
                                        'rows' => 3
                                    ])->label(false) ?>
                                    <small style="text-align: right;" class="form-text text-muted" id="showCharater">
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
                                <h3 class="ttl-sub">Mời bạn lựa chọn giọng đọc</h3>
                            </div>
                        </div>
                        <?php $index = 0 ?>
                        <?php foreach ($accents as $key => $value): ?>
                            <?= $index % 2 == 0 ? '<div class="row">' : '' ?>
                            <div class="col-md-1"> </div>
                            <div class="col-md-5">
                                <div data-value="<?= $key ?>" data-save="<?= $key ?>" class="btn btn-blue-aqua btn-block rounded-pill btnChooseVoice
                            <?= ($model->accent && intval($model->accent) == $key) ? "btn-blue-aqua-selected" : "" ?>">
                                    <?= Html::encode($value) ?>
                                </div>
                            </div>
                            <?= $index % 2 == 1 ? '</div>' : '' ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                        <?= count($accents) % 2 > 0 ? "</div>" : "" ?>

                        <div class="row error-display">
                            <div class="col-md-10 offset-md-1" style="padding-bottom: 0">
                                <?= $form->field($model, 'accent')->hiddenInput(['class' => 'form-control valChooseVoiceSave'])->label(false); ?>
                                <?= Html::hiddenInput('valChooseVoiceSave', null, ['class' => 'valChooseVoice']) ?>
                            </div>
                        </div>
                    </div>
                    <div id="formChooseSpeed">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="ttl-sub">Mời bạn lựa chọn ngữ điệu</h3>
                            </div>
                        </div>
                        <?php $index = 0 ?>
                        <?php foreach ($linguistics as $key => $value): ?>
                            <?= $index % 2 == 0 ? '<div class="row">' : '' ?>
                            <div class="col-md-1"> </div>
                            <div class="col-md-5">
                                <div data-value="<?= $key ?>" class="btn btn-blue-aqua btn-block rounded-pill btnChooseSpeed
                            <?= ($model->intonational && intval($model->intonational) == $key) ? "btn-blue-aqua-selected" : "" ?>">
                                    <?= Html::encode($value) ?>
                                </div>
                            </div>
                            <?= $index % 2 == 1 ? '</div>' : '' ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                        <?= count($linguistics) % 2 > 0 ? "</div>" : "" ?>
                        <div class="row error-display">
                            <div class="col-md-10 offset-md-1" style="padding-bottom: 0">
                                <?= $form->field($model, 'intonational')->hiddenInput(['class' => 'form-control valChooseSpeed'])->label(false); ?>
                            </div>
                        </div>
                    </div>
                    <div id="formChooseMusic">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="ttl-sub">Sử dụng nhạc nền</h3>
                            </div>
                            <div class="col-md-9">

                            <div class="pretty p-icon p-curve p-pulse use-background" >
                                <input data-value="0" type="checkbox" class="btnChooseUseMusic" <?php if($model->sound_background == 1) echo "checked"?> >
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Có</label>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="row error-display">
                            <div class="col-md-10 offset-md-1" style="padding-bottom: 0">
                                <?= $form->field($model, 'sound_background')->hiddenInput(['class' => 'form-control valChooseMusic', 'value'=> !$model->sound_background ? 0 : $model->sound_background])->label(false); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="javascript:backStepOnline(1, 2)" class="lnk-pre">Quay lại</a>
                        <a href="javascript:goStepOnline(3, 2)" class="lnk-pre">Tiếp tục</a>
                    </div>
                </div>

                <div class="ctn ctn-2 onlineStep" id="onlineStep3" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên bài hát<span
                                        class="red-star">*</span></label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'name')->textInput([
                                        'placeholder' => 'Nhập tên bài hát tại đây',
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
                                    Đính kèm danh sách thuê bao mời cài đặt nhạc chờ quảng cáo (đảm bảo là cán bộ, nhân viên của doanh nghiệp).
                                    Hệ thống sẽ gửi lời mời tới thuê bao được yêu cầu.<br>
                                    Định dạng file là: txt. lấy file mẫu
                                    <a href="/uploads/msisdn/1.txt" class="text-decoration-none" download><u>tại đây</u></a>
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
                        <a href="javascript:backStepOnline(2, 3)" class="lnk-pre">Quay lại</a>
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
                            <div class="ctn-template"><?= Html::encode($content->recording_content); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>