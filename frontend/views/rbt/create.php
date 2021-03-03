<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $relateId integer */
?>

<section class="mdl mdl-recording rbtPOnline">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="row-top">
                    <h3 class="ttl">Mời quý khách lựa chọn</h3>
                </div>
                <div class="ctn ctn-1">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <?= Html::a("Thu âm online tại web", array_merge(['rbt/record-online'], Yii::$app->request->getQueryParams()),
                                ['class' => 'btn rounded-pill btn-block btn-blue-aqua']); ?>
                        </div>
                        <p class="txt1">Viettel cung cáp các mẫu quảng cáo có sẵn hoặc khách hàng có thể nhập nội dung
                            nhạc chờ quảng cáo muốn thu âm, hệ thống sẽ tự động chuyển thành nội dung voice để làm nhạc
                            chờ. Tổng phí dịch vụ: <?= $relateId ? 0 : '550.000' ?> đồng</p>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <?= Html::a("Thu âm tại phòng thu", array_merge(['rbt/record-request'], Yii::$app->request->getQueryParams()),
                                ['class' => 'btn rounded-pill btn-block btn-blue-aqua']); ?>
                        </div>
                        <p class="txt1">Viettel cung cấp dịch vụ thu âm chất lượng cao tại phòng thu với cước phí
                            500.000 đ/nội dung. Khách hàng sẽ được nghe và duyệt nội dung quảng cáo trước khi tạo mã
                            nhạc chờ trên hệ thống. Tổng phí dịch vụ: <?= $relateId ? '500.000 đồng' : '1.050.000 đồng (bao gồm phí khởi tạo 550.000 đồng)' ?> </p>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <?= Html::a("Đã có file thu âm", array_merge(['rbt/record-upload'], Yii::$app->request->getQueryParams()),
                                ['class' => 'btn rounded-pill btn-block btn-blue-aqua']); ?>
                        </div>
                        <p class="txt1">Viettel tạo nhạc chờ dựa trên file thu âm nội dung quảng cáo doanh nghiệp cung
                            cấp. Định dạng file yêu cầu là .mp3. Thời lượng đảm bảo của file nhạc trên hệ thống là từ 30
                            đến 43 giây. Tổng phí dịch vụ: <?= $relateId ? 0 : '550.000' ?> đồng</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>