<?php


/* @var $this \yii\web\View */
/* @var $model \frontend\models\UploadRbtForm */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'formRecordOnline']); ?>
                <div class="ctn ctn-2">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời quý khách thực hiện tạo mã nhạc quảng cáo</h3>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên bài hát <span
                                            class="red-star">*</span></label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'name')->textInput([
                                        'placeholder' => 'Nhập tên bài hát tại đây',
                                        'required' => true
                                    ])->label(false); ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-md-9 col-form-label">
                                    File quảng cáo <span class="red-star">*</span>
                                </label>
                                <div class="col-md-3">
                                    <div class="upload-btn-wrapper">
                                        <button id="btn-recording_file" class="btn-upload hvr-wobble-horizontal">Attach file</button>
                                        <?= $form->field($model, 'recording_file')->fileInput(['accept' => '.mp3', 'value' => $model->recording_file])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 txt-1">
                                    Quý khách đính kèm file nội dung quảng cáo tại đây, định dạng đính kèm .mp3, thời lượng từ 30 - 43 giây
                                </div>
                            </div>
                            <div class="form-group row mb-1">
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
                            <div class="form-group row">
                                <div class="col-md-9 txt-1">
                                    <p><span>Quý khách cần nhập các giấy tờ liên quan như sau:</span></p>
                                    <ul style="list-style-type: square;">
                                        <li><span>Giấy phép đăng ký kinh doanh của doanh nghiệp</span></li>
                                        <li><span>Chứng minh thư của Giám đốc doanh nghiệp (hoặc CMT của người đại diện)</span></li>
                                        <li><span>Giấy cam kết bản quyền và nội dung nhạc chờ đưa lệ (tải mẫu <a href="/uploads/msisdn/camket.docx" class="text-decoration-none" download><u>tại đây</u></a>)</span></li>
                                        <li><span>Giấy tờ liên quan đến bản quyền nếu nội dung quảng cáo của quý khách là tác phẩm âm nhạc hoặc có sự thể hiện của ca sĩ, nhạc sĩ. (nếu có)</span></li>
                                    </ul>
                                    <p><span>Quý khách đính kèm giấy tờ bản quyền nội dung quảng cáo tại đây. Định dạng file là:<strong> pdf, png, jpg.</strong></span></p>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
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
                                <div class="col-md-9 txt-1">
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
                        <?php if($model->id) { ?>
                            <a href="<?= Url::toRoute(['user/index']) ?>" class="lnk-pre">Quay lại</a>
                        <?php } else { ?>
                            <a href="<?= Url::toRoute(['rbt/create']) ?>" class="lnk-pre">Quay lại</a>
                        <?php } ?>
                        <button type="submit" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>
