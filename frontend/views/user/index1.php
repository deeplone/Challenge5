<?php
$this->title = 'Nhạc chờ doanh nghiệp';
?>
<section class="mdl mdl-table" id="manageRingTone">
    <div class="container">
        <div class="frm-content" style="padding:0">
            <div class="form-group row">
                <div class="col-md-12">

                    <form action="/home" method="get" class="form-inline">
                        <div class="col-md-3">
                            <a href="<?php echo \yii\helpers\Url::to('/enterprise/index?type=new'); ?>" class="btn btn-outline-info rounded-pill"> <i class="mdi mdi-plus mdi-24px"></i> Tạo yêu cầu mới</a>
                        </div>
                        <div class="col-md-9">
                            <!-- <input class="form-control rounded-pill bg-secondary text-white border-0" value="<?php echo \yii\helpers\Html::encode($name); ?>" type="text" placeholder="Tìm kiếm theo mã nhạc chờ" aria-label="Search"> &nbsp; -->
                            <!-- <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal" style="min-width: 0px; border-radius: 0px;"></button> &nbsp; -->
                            <input type="text" name="name" class="form-control rounded-pill bg-secondary text-white border-0" value="<?php echo \yii\helpers\Html::encode($name); ?>" style="width: 210px;" placeholder="Nhập vào tên bài hát" /> &nbsp;
                            <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal" style="min-width: 0px; border-radius: 0px;"><i class="fas fa-search"></i></button> &nbsp;

                        </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="tlb-content" style="margin-left: -60px;">
            <div style="width: 120%;padding-right: 0 !important;">
                <div class="scroll-table">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Số hồ sơ</th>
                                <th scope="col">Mã bài hát</th>
                                <th scope="col">Tên bài hát</th>
                                <th scope="col">File quảng cáo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">TB cài đặt</th>
                                <th scope="col">Thời gian tạo</th>
                                <th scope="col">Thời gian phê duyệt</th>
                                <th scope="col">Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (sizeof($files)) {
                                // var_dump($files);
                                // die;
                            ?>

                                <?php $index = 0; ?>
                                <?php foreach ($files as $item) { ?>
                                    <tr>
                                        <td><?php echo $item->id; ?></td>
                                        <td><?php $tone_code = yii\helpers\Html::encode($item->rbt->tone_code);
                                            echo $tone_code == "" ? 'Chưa tạo mã' : yii\helpers\Html::encode($item->rbt->tone_code); ?></td>
                                        <td><?php echo yii\helpers\Html::encode($item->name); ?></td>

                                        <td><?php echo $item->audio(); ?></td>
                                        <td><?php echo yii\helpers\Html::encode(Yii::$app->params['enterprise_file_status'][$item->status]); ?></td>
                                        <td><a href="<?php echo \yii\helpers\Url::to(['/user/user-rbt', 'id' => $item->id]); ?>">Kiểm tra</a></td>
                                        <td><?php echo yii\helpers\Html::encode($item->created_at); ?></td>
                                        <td><?php echo yii\helpers\Html::encode($item->updated_at); ?></td>
                                        <td>
                                            <?php if ($item->status == 3) { ?>
                                                <a class="text-reset text-decoration-none">
                                                    <span class="mdi mdi-sync"></span>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?php echo \yii\helpers\Url::to(['/enterprise/update', 'id' => $item->id]); ?>" class="text-reset text-decoration-none disable">
                                                    <span class="mdi mdi-sync"></span>
                                                </a>
                                            <?php } ?>
<!--                                            <a href="/enterprise/index?type=paid" class="text-reset text-decoration-none">-->
<!--                                                <span class="mdi mdi-plus-circle"></span>-->
<!--                                            </a>-->
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                Bạn chưa tạo quảng cáo
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?= $this->render('/layouts/_pagination', ['pages' => $pages]); ?>
            </div>
        </div>
    </div>
</section>