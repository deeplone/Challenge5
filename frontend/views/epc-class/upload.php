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
                            <h3 class="ttl-sub">Upload bài tập</h3>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên bài tập <span
                                            class="red-star">*</span></label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'name')->textInput([
                                        'placeholder' => 'Nhập tên bài tập tại đây',
                                        'required' => true
                                    ])->label(false); ?>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-md-9 col-form-label">
                                    File bài tập (bắt buộc)<span class="red-star">*</span>
                                </label>
                                <div class="col-md-3">
                                    <div class="upload-btn-wrapper">
                                        <button id="btn-copyright_license" class="btn-upload hvr-wobble-horizontal">Attach file</button>
                                        <?= $form->field($model, 'path')->fileInput(['accept' => '.pdf, .png, .jpg'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <button type="submit" class="btn lnk-nex text-decoration-none">Hoàn thành</button>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>
