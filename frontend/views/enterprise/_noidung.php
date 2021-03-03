<?php //var_dump($model->recording_content); die; ?>
<p class="font-italic">Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình.</br> Số lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.</p>
<p style="text-align: right; margin-top: 20px;">Bạn có thể sử dụng mẫu nội dung quảng cáo <a href="#" class="lnk-nex text-decoration-none" class="btn btn-banner rounded-pill" onclick="openTemplate()">tại đây</a></p>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Nội dung quảng cáo</label>
    <div class="col-sm-9">
        <textarea placeholder="Nhập nội dung quảng cáo ở đây" id="voice-content" name="<?php echo $model->formName(); ?>[recording_content]" class="form-control" rows="13" maxlength="1200"><?php echo yii\helpers\Html::encode($model->recording_content); ?></textarea>
        <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'recording_content']); ?>
        <small class="form-text text-muted">
            Số lượng ký tự <span style="color: red; font-size: 13px;" id="counter-character"></span>
        </small>
        <small id="less-character" class="form-text text-muted" style="display:none; color:red !important;">
            Nội dung quảng cáo phải lớn hơn 650 ký tự
        </small>
        <small id="more-character" class="form-text text-muted" style="display:none; color:red !important;">
            Nội dung quảng cáo phải ít hơn 1200 ký tự
        </small>
    </div>
</div>

<!-- Template Modal -->
<div class="modal fade modal-edited" id="referenceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center text-uppercase">Các mẫu nội dung quảng cáo tham khảo: <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
                <?php foreach($example_contents as $key => $value) { ?>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-shrink-1">
                            <p>Tích chọn</p>
                            <div class="pretty p-icon p-round p-pulse">
                                <input type="radio" name="voice" checked />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>&nbsp;</label>
                                </div>
                            </div>

                        </div>
                        <div class="p-2 w-100">
                            <p>Nội dung tham khảo</p>
                            <div class="ctn-template">
                                <?php echo $value[recording_content]; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    function openTemplate() {
        $("#referenceModal").modal();
    }
</script>