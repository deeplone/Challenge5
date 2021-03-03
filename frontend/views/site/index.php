<?php


use yii\helpers\Html;

/* @var $rbtHot */
$this->title = 'Trang chủ';
$user = Yii::$app->user->identity;
?>

<!---------- 03. Tabs ---------->
<section class="mdl mdl-tab">
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item active"><a href="#page1" data-scroll="page1" class="text-decoration-none">Nhạc
                    chờ</a></li>
            <li class="list-inline-item"><a href="#page2" data-scroll="page2" class="text-decoration-none">Quy trình</a>
            </li>
            <li class="list-inline-item"><a href="#page3" data-scroll="page3" class="text-decoration-none">Lợi ích</a>
            </li>
            <li class="list-inline-item"><a href="#page4" data-scroll="page4" class="text-decoration-none">Khách
                    hàng</a></li>
        </ul>
    </div>
</section>

<!---------- 04. Brand ---------->
<section class="mdl mdl-brand" id="page1">
    <div class="container">
        <div class="col-md-12">
            <p>Dịch vụ Nhạc chờ doanh nghiệp của Viettel cho phép khách
                hàng tạo các bản nhạc chờ để giới thiệu về các sản phẩm, dịch
                vụ, thương hiệu của doanh nghiệp - làm tăng hiệu quả truyền
                thông từ đó phát triển thương hiệu của doanh nghiệp. Nhạc chờ
                doanh nghiệp là kênh quảng bá hình ảnh hiệu quả với chi phí
                cực kỳ tiết kiệm.</p>
            <p>Dịch vụ đang triển khai 3 tính năng hỗ trợ doanh
                nghiệp trong việc sử dụng dịch vụ:</p>
            <p>1. Viettel cung cấp tính năng thu âm online tại website
                bằng công nghệ text to speed: tính năng cho phép
                khách hàng chuyển nội dung text thành nội dung audio.
                Quý khách hoàn toàn chủ động trong việc sáng tạo và phê duyệt
                nội dung quảng cáo ngay trên hệ thống của dịch vụ.</p>
            <p>2. Viettel là cầu nối để khách hàng có được nội dung
                quảng cáo chuyên nghiệp khi thực hiện thu âm nội
                dung quảng cáo với phòng thu: Quý khách gửi yêu cầu
                thu âm nội dung quảng cáo lên hệ thống của dịch vụ. Phòng thu
                sẽ tiếp nhận yêu cầu của Quý khách đồng thời hỗ trợ chỉnh sửa
                nội dung quảng cáo để Quý khách có được môt nội dung quảng cáo
                hấp dẫn và phù hợp nhất với mục đích quảng bá của doanh nghiệp.
                Hệ thống chỉ thực hiện tạo mã nhạc chờ khi Quý khách xác nhận
                và kiểm duyệt nội dung quảng cáo qua email. Phí thu âm: 500k/bản thu.</p>
            <p>3. Viettel tiếp nhận file nội dung quảng cáo có sẵn của doang nghiệp
                để tạo mã nhạc chờ: Quý khách dễ dàng đưa nội dung thu âm sẵn có của
                doanh nghiệp lên hệ thống dịch vụ của Viettel để yêu cầu tạo mã nhạc
                chờ quảng cáo. Định dạng file yêu cầu là .mp3 và độ dài đảm bảo là
                30 giây đến 43 giây.</p>
            <div class="ttl">
                Quý khách có thể nghe thử nhạc chờ quảng cáo tại đây
            </div>
        </div>
        <!-- div.row>div.col-md-4*9>img.img-itm+div.overlay>span.mdi.mdi-play-circle+span.txt-1{Viettel ca}+a.text-reset>i.mdi.mdi-download -->
        <div class="row">
            <?php foreach ($rbtHot as $key => $value): /* @var \frontend\models\RbtHot $value */ ?>
                <div class="col-6 col-md-4" data-toggle="tooltip" data-placement="top" title="<?= $value->name; ?>">
                    <div class="placeholder-undifined">
                        <img src="<?= $value->getImagePath() ?>" alt="<?= $value->name; ?>" class="img-itm">
                    </div>
                    <div class="overlay">
                        <div class="btn-play">
                            <span data-value="<?= $value->getAudioPath(); ?>" class="mdi mdi-play btnPlayRbtHot"></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!---------- 05. Procedure ---------->
<section class="mdl mdl-procedure text-center" id="page2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="ttl">Quy trình tương tác</h3>
                <div class="card-deck text-white text-center">
                    <div class="card card-01">
                        <div class="card-body bg-gradient-secondary">
                            <h5 class="card-title">Bước 1</h5>
                            <h6 class="card-subtitle mb-2">
                                <!-- <i class="mdi mdi-file-document-edit"></i>  -->
                                <img src="images/ico_01.png" alt="" srcset="">
                            </h6>
                            <p class="card-text">Đăng ký tài khoản trên trang Nhạc chờ doanh nghiệp</p>
                        </div>
                    </div>
                    <div class="card card-02">
                        <div class="lnk-step-left"></div>
                        <div class="card-body bg-gradient-secondary">
                            <h5 class="card-title">Bước 2</h5>
                            <h6 class="card-subtitle mb-2">
                                <!-- <i class="mdi mdi-settings"></i>  -->
                                <img src="images/ico_02.png" alt="" srcset="">
                            </h6>
                            <p class="card-text">Đăng ký tài khoản trên trang Nhạc chờ doanh nghiệp</p>
                        </div>
                        <div class="lnk-step-right"></div>
                    </div>
                    <div class="card card-03">
                        <div class="card-body">
                            <h5 class="card-title">Bước 3</h5>
                            <h6 class="card-subtitle mb-2">
                                <!-- <i class="fas fa-bullseye"></i>  -->
                                <img src="images/ico_03.png" alt="" srcset="">
                            </h6>
                            <p class="card-text">Đăng ký tài khoản trên trang Nhạc chờ doanh nghiệp</p>
                        </div>
                    </div>
                </div>
                <h3 class="txt-2">Quy trình đơn giản nhanh gọn</h3>
            </div>
        </div>
    </div>
</section>

