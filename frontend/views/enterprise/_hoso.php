<div class="form-group row required">
    <label for="inputEmail3" class="col-sm-4 col-form-label"> Tên bài hát</label>
    <div class="col-sm-8">
        <div class="upload-btn-wrapper">
            <input type="text" name="<?php echo $formName ?>[name]" class="form-control" value="<?php echo yii\helpers\Html::encode($model->name); ?>" />
        </div>
    </div>
    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'name']); ?>
</div>
<!-- <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label"> Giấy phép kinh doanh (hoặc <a href="/BM03_Mau cam ket ban quyen nhac cho doanh nghiep.doc">cam kết hộ kinh doanh</a>)</label>
    <div class="col-sm-8">
        <div class="upload-btn-wrapper">
            <input name="<?php echo $formName ?>[business_license]" type="file" class="custom-file-input"  accept=".pdf,.png,.jpg" require />
            <label  class="custom-file-label" for="customFile">Chọn file</label>
        </div>
        <?php echo $model->getUrlFile($model->business_license); ?>
    </div>
    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'business_license']); ?>
</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label"> Giấy tờ bản quyền</label>
    <div class="col-sm-8">
        <div class="upload-btn-wrapper">
            <input name="<?php echo $formName ?>[copyright_license]" type="file" class="custom-file-input"  accept=".pdf,.png,.jpg" />
            <label   class="custom-file-label" for="customFile">Chọn file</label>
        </div>
        <?php echo $model->getUrlFile($model->copyright_license); ?>
    </div>
    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'copyright_license']); ?>
</div> -->
<div class="form-group row">
    <label for="inputPassword" class="col-sm-6 col-form-label">
        Danh sách thuê bao mời cài đặt nhạc chờ quảng cáo (nếu có)
    </label>
    <div class="col-sm-6">
        <div class="custom-file">
            <input type="file" class="custom-file-input"  accept=".txt" />
            <label name="RegisterForm2[msisdn_file]" class="custom-file-label" for="customFile">Chọn file</label>
            <?php echo $model->getUrlFile($model->msisdn_file); ?>
        </div>

    </div>
</div>
<div class="form-group">
    Quý khách có thể đính kèm danh sách thuê bao mời kích hoạt và tải nội dung quảng cáo tại đây.
    Hệ thống sẽ gửi lời mời tới thuê bao được yêu cầu.
    Lưu ý thuê bao mời cài đặt phải là cán bộ, nhân viên của doanh nghiệp.
    Định dạng file đính kèm txt. lấy file mẫu <a href="" class="text-decoration-none">tại đây</a>
</div>