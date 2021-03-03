<?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
<input type="hidden" name="RegisterForm2[requires_recording]" value="0" />

<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="ctn ctn-2">
                    <form class="needs-validation" novalidate>

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo $this->render('_hoso', [
                                    'formName' => 'RegisterForm2',
                                    'errors' => $errors,
                                    'model' => $model,
                                ]);
                                ?>
                                <div class="form-group row required">
                                    <label class="col-sm-4 col-form-label"> Nội dung quảng cáo</label>
                                    <div class="col-sm-8">
                                        <div class="upload-btn-wrapper">
                                            <input type="file" class="custom-file-input" name="RegisterForm2[recording_file]" accept="audio/mp3" />
                                            <label class="custom-file-label" for="customFile">Chọn file</label>
                                        </div>
                                        <?php echo $model->getUrlFile($model->recording_file); ?>
                                    </div>
                                    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'recording_file']); ?>
                                </div>
                                <div class="row-ctn-bottom">
                                    <a href="/enterprise" class="lnk-pre">Quay lại</a>
                                    <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Tiếp tục'; ?></button>
                                    <!-- <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal" id="payment-getotp" otp-url="<?php echo \yii\helpers\Url::to(['/enterprise/get-otp', 'id' => $model->id]) ?>" hreff="<?php echo \yii\helpers\Url::to(['/enterprise/otp', 'id' => $model->id]) ?>">Tiếp tục</button> -->
                                </div>

                                <!-- <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Đăng ký'; ?></button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade modal-edited modal-theme" id="paid-finish" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="ctn">
                    <p>Giao dịch thanh toán thành công</p>
                    <p>Mã hồ sơ trên hệ thống của quý khách là <?php echo ($model->id); ?></p>
                    <p>Cảm ơn quý khách đã sử dụng dịch vụ của Viettel</p>
                    <P>
                        <a type="button" href="/user" class="btn btn-block rounded-pill">Quay về quản lý kho nhạc quảng cáo</a>
                    </P>
                </div>
            </div>
        </div>
    </div>
</div>