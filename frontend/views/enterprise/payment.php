<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Content 3 -->
                <div class="ctn ctn-3">
                    <div class="row">
                        <?php if ($model->requires_recording == 1) { ?>
                            <div class="col-md-6">
                                <h3 class="ttl-sub">Thông tin nhạc chờ doanh nghiệp</h3>
                                <p>1. Tên bài hát: <span class="txt-color"><?php echo $model->name; ?></span></p>
                                <p>2. Nội dung quảng cáo:</p>
                                <p class="txt-1 txt-color"><?php echo $model->recording_content; ?></span>
                                </p>
                                <p>3. Giọng đọc: <span class="txt-color"><?php echo $model->accent = 1 ? 'Nam' : 'Nữ'; ?> <?php echo $model->region = 1 ? 'Miền Bắc' : 'Miền Nam' ?></span></p>
                                <p>4. Ngữ điệu: <span class="txt-color"><?php echo $model->intonational = 1 ? 'Vừa, trẻ trung' : 'Nghiêm trang'; ?></span></p>
                                <p>5. Nhạc nền: <span class="txt-color"><?php echo $model->sound_background = 1 ? 'Có' : 'Không'; ?></span></p>
                                <p>6. Yêu cầu mời các thuê bao cài đặt nhạc chờ: <span class="txt-color"><?php echo $model->msisdn_file == null ? 'Không' : 'Có'; ?></span></span></span></p>
                            </div>

                        <?php } else { ?>
                            <div class="col-md-6">
                                <h3 class="ttl-sub">Thông tin nhạc chờ doanh nghiệp</h3>
                                <p>1. Tên bài hát: <span class="txt-color"><?php echo $model->name; ?></span></p>
                                <p>2. Nội dung quảng cáo:</p>
                                <audio controls><source src="<?php echo $model->getFile(); ?>"></audio>
                                </p>
                                <p>3. Yêu cầu mời các thuê bao cài đặt nhạc chờ: <span class="txt-color"><?php echo $model->msisdn_file == null ? 'Không' : 'Có'; ?></span></span></span></p>
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="card-group text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Thanh toán yêu cầu</h5>
                                        <?php if ($type != "paid") { ?>
                                            <p class="card-text">Phí khởi tạo: <?php echo number_format(FEE_KHOI_TAO); ?></p>
                                        <?php } ?>
                                        <?php if ($model->requires_recording == 1) { ?>
                                            <p class="card-text">Phí thu âm: <?php echo number_format(FEE_THU_AM); ?></p>
                                        <?php } ?>
                                        <?php if ($type != "new") { ?> 
                                            <p class="card-text">Tổng tiền: <?php echo ($model->requires_recording == 1) ? number_format(( FEE_THU_AM)) : number_format(FEE_KHOI_TAO) ?></p>
                                        <?php } else { ?>
                                            <p class="card-text">Tổng tiền: <?php echo ($model->requires_recording == 1) ? number_format((FEE_KHOI_TAO + FEE_THU_AM)) : number_format(FEE_KHOI_TAO) ?></p>
                                        <?php } ?>
                                        <div class="txt-line">
                                            Quí khách sẽ thực hiện thanh toán cước phí tạo nhạc chờ quảng cáo bằng tài khoản gốc di động của số thuê bao <span style="color: red"><?php echo $msisdn ?></span>
                                        </div>

                                        <div class="form-group" style="padding-top: 40px; width: 50%; margin-left: 120px;">
                                            <button type="submit" class="btn btn-accept btn-block rounded-pill" id="payment-getotp" otp-url="<?php echo \yii\helpers\Url::to(['/enterprise/get-otp', 'id' => $model->id]) ?>" hreff="<?php echo \yii\helpers\Url::to(['/enterprise/otp', 'id' => $model->id, 'type' => $type]) ?>">Thanh toán</button>
                                        </div>
                                        <div class="txt-line">
                                            Vui lòng đảm bảo tài khoản của quý khách đủ để thanh toán giao dịch này!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="<?php echo \yii\helpers\Url::to(['/enterprise/update', 'id' => $model->id]); ?>" class="lnk-pre">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>