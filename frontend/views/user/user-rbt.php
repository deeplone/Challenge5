<?php
$userRbts = $dataProvider->getModels();
?>
<h4 class="txt-welcome">Chào mừng! bạn đến với Nhạc chờ doanh nghiệp của Viettel</h4>
<div class="bar-control">
    <a class="btn btn-imuzik hvr-wobble-horizontal" href="/home" role="button">Quản lý kho nhạc quảng cáo</a>
</div>
<div class="frm-content">
    <div class="form-group row">
        <div class="col-md-12">
            <form action="<?php echo \yii\helpers\Url::to(['/user/user-rbt', 'id' => $profile->id]); ?>" method="get" class="form-inline"> 
                <input type="text" name="msisdn" class="form-control" value="<?php echo $searchModel->msisdn; ?>" placeholder="Nhập vào số điện thoại"/> &nbsp;
                <input type="text" name="tone_code" class="form-control" value="<?php echo $searchModel->tone_code; ?>" placeholder="Nhập vào mã bài hát"/> &nbsp;
                <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal" style="min-width: 0px; border-radius: 0px;">Tìm</button> &nbsp;
                <a href="<?php echo \yii\helpers\Url::to(['/user/user-rbt', 'id' => $profile->id]); ?>">Reset</a> &nbsp;
            </form>
        </div>
    </div>
</div>
<div class="tlb-content">
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Mã nhạc</th>
                    <th scope="col">Ngày đăng ký</th>
                    <th scope="col">Ngày hết hạn</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <?php if (sizeof($userRbts)) { ?>
                <tbody>
                    <?php $index = 0; ?>
                    <?php foreach ($userRbts as $item) { ?>                        
                        <tr>
                            <td><?php echo ++$index; ?></td>
                            <td><?php echo yii\helpers\Html::encode($item->msisdn); ?></td>
                            <td><?php echo yii\helpers\Html::encode($item->tone_code); ?></td>
                            <td><?php echo yii\helpers\Html::encode($item->register_at); ?></td>
                            <td><?php echo yii\helpers\Html::encode($item->exprired_at); ?></td>
                            <td><?php echo yii\helpers\Html::encode($item->status == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt'); ?></td>
                        </tr>
                    <?php } ?>                    
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?= $this->render('/layouts/_pagination', ['pages' => $pages]); ?>
</div>