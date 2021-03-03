<div class="overlay-back"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="txt-1">Chào mừng bạn đến với</p>
            <p class="txt-2">Nhạc chờ doanh nghiệp của Viettel</p>
            <p class="txt-3">Kênh quảng cáo đắc lực cho doanh nghiệp</p>
            <p class="bottom-row">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <a href="/signup" class="btn btn-imuzik hvr-wobble-horizontal">Đăng ký</a> 
                    <a href="/login" class="btn btn-outline-imuzik hvr-wobble-horizontal">Đăng nhập</a>
                <?php } else { ?>
                    <a href="/home" class="btn btn-imuzik hvr-wobble-horizontal">Quản lý kho nhạc quảng cáo</a>
                <?php } ?>
            </p>
        </div>
    </div>
</div>