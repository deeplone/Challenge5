<!-- STEP 06 -->
<form action="<?php echo \yii\helpers\Url::to(['/enterprise/otp', 'id' => $model->id, 'type' => $type]) ?>" method="post">
    <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
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
                                            <?php if ($type != "paid") { ?>
                                                <p class="card-text">Tổng tiền: <?php echo ($model->requires_recording == 1) ? number_format((FEE_KHOI_TAO + FEE_THU_AM)) : number_format(FEE_KHOI_TAO) ?></p>
                                            <?php } else { ?>
                                                <p class="card-text">Tổng tiền: <?php echo ($model->requires_recording == 1) ? number_format((FEE_THU_AM)) : number_format(FEE_KHOI_TAO) ?></p>
                                            <?php } ?>


                                            <form class="needs-validation form-payment" novalidate>

                                                <?php if ($errorCode == 401) { ?>
                                                    <div class="txt-line" style="font-family: Helvetica-Regular">
                                                        Quý khách sẽ thực hiện thanh toán cước phí tạo nhạc chờ quảng cáo bằng tài khoản gốc di động của số thuê bao 097xxxxxx6
                                                    </div>
                                                    <button style="margin-top: 40px;width: 30%;margin-left: 33%;" type="button" class="btn btn-accept btn-block rounded-pill" id="payment-getotp" otp-url="<?php echo \yii\helpers\Url::to(['/enterprise/get-otp', 'id' => $model->id]) ?>" hreff="<?php echo \yii\helpers\Url::to(['/enterprise/otp', 'id' => $model->id]) ?>">Thanh toán</button>
                                                    <div style="margin-top: 40px; color:red;">
                                                        <?php echo $message; ?>
                                                    </div>
                                                <?php } else if ($errorCode <> 0 && $errorCode <> 401) { ?>

                                                    <div class="txt-line">
                                                        Hệ thống đã gửi một mã OTP xác thực thanh toán về số điện thoại của bạn. Số tiền cần thanh toán là <span class="txt-color"><?php if ($type != "paid") { ?>
                                                                <?php echo ($model->requires_recording == 1) ? number_format((FEE_KHOI_TAO + FEE_THU_AM)) : number_format(FEE_KHOI_TAO) ?>
                                                            <?php } else { ?>
                                                                <?php echo ($model->requires_recording == 1) ? number_format((FEE_THU_AM)) : number_format(FEE_KHOI_TAO) ?>
                                                            <?php } ?> VNĐ</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control rounded-pill text-center" placeholder="Nhập mã OTP" id="otp-code" name="otp-code" required>
                                                        <!-- <input type="text" class="form-control rounded-pill text-center" placeholder="Nhập mã OTP" required> -->
                                                        <div class="valid-feedback">
                                                            Hợp lệ!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Vui lòng không bỏ trống trường này!
                                                        </div>
                                                    </div>
                                                    <?php if ($message) { ?>
                                                        <div class="alert <?php echo ($errorCode == 0) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert" id="error-message">
                                                            <?php echo $message; ?>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                    <?php } ?>
                                                    <p><small>Khi Quý khách nhấn Xác thực, hệ thống sẽ tiến hành thu phí khởi tạo nhạc chờ quảng cáo trên tài khoản di dộng của quý khách! Hãy nạp tiền để đảm bảo giao dịch thành công!</small></p>
                                                    <!-- <button type="submit" class="btn btn-accept btn-block rounded-pill">Xác thực</button> -->
                                                    <button style="color:#00c6ea;" type="button" class="btn lnk-nex text-decoration-none" id="refresh-otp-payment" hreff="<?php echo \yii\helpers\Url::to(['/enterprise/get-otp', 'id' => $model->id]) ?>">Lấy lại mã xác thực</button>
                                                <?php } else { ?>
                                                    <div id="finish-value-code" class="txt-line" value="<?php echo $errorCode; ?>">
                                                        <p>Giao dịch thanh toán thành công!</p>
                                                        <p>Mã hồ sơ trên hệ thống của quý khách là: </p>
                                                        <p>Cảm ơn quý khách đã sử dụng dịch vụ của Viettel</p>
                                                    </div>
                                                    <button style="color:#00c6ea;" type="button" class="btn lnk-nex text-decoration-none" id="refresh-otp-payment">Quay lại quản lý kho nhạc quảng cáo</button>
                                                    <!-- Modal -->

                                                <?php } ?>

                                                <!--  -->

                                                <!-- <?php if ($errorCode <> 0) { ?>
                                                    <p><small>Khi Quý khách nhấn Xác thực, hệ thống sẽ tiến hành thu phí khởi tạo nhạc chờ quảng cáo trên tài khoản di dộng của quý khách! Hãy nạp tiền để đảm bảo giao dịch thành công!</small></p>
                                                    <button type="button" class="btn btn-accept btn-block rounded-pill" id="refresh-otp-payment" hreff="<?php echo \yii\helpers\Url::to(['/enterprise/get-otp', 'id' => $model->id]) ?>">Lấy lại mã xác thực</button>
                                                <?php } else { ?>
                                                    <div class="form-group">
                                                        <a href="<?php echo \yii\helpers\Url::to(['/enterprise/finish', 'id' => $model->id]) ?>" class="btn btn-accept btn-block rounded-pill">Hoàn thành</a>
                                                    </div>
                                                <?php } ?> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-ctn-bottom">
                            <a href="" class="lnk-pre">Quay lại</a>
                            <?php if ($errorCode !== 401) { ?>
                                <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal">Hoàn thành</button>
                            <?php } ?>
                            <!-- <a type="submit">Hoàn thành</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($errorCode == 0) { ?>

            <?php echo
                "<div class=\"modal fade modal-edited modal-theme\" id=\"test1cachnghiemtuc\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-body\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">×</span>
                            </button>
                            <div class=\"ctn\">
                                <p>Giao dịch thanh toán thành công!</p>
                                <p>Mã hồ sơ trên hệ thống của quý khách là MSxx</p>
                                <p>Cảm ơn quý khách đã sử dụng dịch vụ của Viettel</p>
                                <P>
                                    <button type=\"button\" class=\"btn btn-block rounded-pill\">Quay về quản lý kho nhạc quảng cáo</button>
                                </P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>"
            ?>

        <?php } ?>
    </section>

</form>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#test1cachnghiemtuc').modal('show');

    });
    // $(window).load(function() {
    //     $('#test1cachnghiemtuc').modal('show');
    // });
</script> -->