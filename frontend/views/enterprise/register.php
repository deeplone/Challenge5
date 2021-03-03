<?php
$this->title = 'Tạo nhạc chờ mới';


?>
<?php if ($step == 1) { ?>
    <div id="_form1" <?php echo ($step == 1) ? '' : 'style="display: none;"' ?>>
    <?php if ($type == "paid") { ?>
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/register1', 'type' => 'paid']); ?>" method="post" enctype="multipart/form-data">
        <?php } else { ?>
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/register1', 'type' => 'new']); ?>" method="post" enctype="multipart/form-data">
        <?php } ?>
        <!-- <form action="<?php echo \yii\helpers\Url::to(['/enterprise/register1', 'type' => 'paid']); ?>" method="post" enctype="multipart/form-data"> -->
            <?php
            echo $this->render('_form1', [
                'errors' => $errors,
                'model' => $model,
                'type' => $type
            ]);
            ?>
        </form>
    </div>
<?php } else if ($step == 2) { ?>
    <div id="_form2" <?php echo ($step == 2) ? '' : 'style="display: none;"' ?>>
        <?php if ($type == "paid") { ?>
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/register2', 'type' => 'paid']); ?>" method="post" enctype="multipart/form-data">
        <?php } else { ?>
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/register2', 'type' => 'new']); ?>" method="post" enctype="multipart/form-data">
        <?php } ?>
        
            <input type="hidden" name="type" value="<?php echo $type ?>">
            <?php
            echo $this->render('_form2', [
                'errors' => $errors,
                'model' => $model,
                'type' => $type
            ]);
            ?>
        </form>
    </div>
<?php } else if ($step == 3) { ?>

    <div id="_form3" <?php echo ($step == 3) ? '' : 'style="display: none;"' ?>>
        <form action="<?php echo \yii\helpers\Url::to(['/enterprise/register3']); ?>" method="post" enctype="multipart/form-data">
            <?php
            echo $this->render('voice', [
                'errors' => $errors,
                'model' => $model,
                'type' => $type
            ]);
            ?>

        </form>
    </div>
<?php } ?>




<div id="try-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Content 3 -->
                <div class="ctn ctn-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="ttl-sub">Thông tin nhạc chờ doanh nghiệp</h3>
                            <p>1. Tên bài hát: Cty TNHH A</p>
                            <audio controls="">
                                <source src="/uploads/rbt/ab/f7/7a/5e4ce0c288491.mp3"></audio>
                            <p>2. Nội dung quảng cáo:</p>
                            <p class="txt-1 txt-color">Cảm ơn quý khách đã tin dùng sản phẩm/dịch vụ
                                của …(tên doanh nghiệp). Hiện tại đơn vị/công ty
                                chúng tôi có thay đổi/mở thêm cơ sở kinh doanh mới
                                tại địa chỉ số … Rất mong nhận được sự ủng hộ và
                                yêu mến của quý khách. Để biết thêm chi tiết quý
                                khách có thể liên hệ trực tiếp theo số hotline … hoặc
                                truy cập …. (tên công ty) + slogan….</span>
                            </p>
                            <p>3. Giọng đọc: Nữ Miền Bắc 1</p>
                            <p>4. Ngữ điệu: Nhanh vừa truyền cảm</p>
                            <p>5. Nhạc nền: Có</p>
                            <p>6. Yêu cầu mời các thuê bao cài đặt nhạc chờ: <span class="txt-color">Có</span></p>
                        </div>
                        <div class="col-md-6">
                            <div class="card-group text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Thanh toán yêu cầu</h5>
                                        <p class="card-text">Phí tạo mã: 5.000.000</p>
                                        <p class="card-text">Tổng tiền: 10.000.000</p>
                                        <div class="txt-line">
                                            Hệ thống đã gửi một mã OTP xác thực
                                            thanh toán về số điện thoại <span class="txt-color">097xxxxxx6</span>.
                                            Số tiền cần thanh toán là <span class="txt-color">550.000 VNĐ</span>
                                        </div>
                                        <form class="needs-validation form-payment" novalidate>
                                            <div class="form-group">
                                                <input type="text" class="form-control rounded-pill text-center" placeholder="Nhập mã OTP" required>
                                                <div class="valid-feedback">
                                                    Hợp lệ!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Vui lòng không bỏ trống trường này!
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-accept btn-block rounded-pill">Thanh toán</button>
                                            </div>
                                            <div class="form-group">
                                                <p>
                                                    <a href="">Lấy lại mã xác thực OTP</a>
                                                </p>
                                            </div>
                                            <div class="form-group was-validated">
                                                <div class="invalid-feedback d-block">
                                                    * Tài khoản của quý khách không đủ để thực hiện giao dịch thanh toán này. Vui lòng nạp thêm tiềnvào tải khoản gốc và thao tác lại.
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="row-ctn-bottom">
                    <a href="" class="lnk-pre">Quay lại</a>
                    <button href="" onclick="test5();" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                </div>
            </div>
        </div>
    </div>
</div>