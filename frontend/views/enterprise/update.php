<?php
$this->title = 'Cập nhật hồ sơ';
?>
<?php // echo $this->render('_choice', ['step' => $step]); 
?>
<?php if ($step == 1) { ?>
    <div id="_form1" <?php echo ($step == 1) ? '' : 'style="display: none;"' ?>>
        <div class="frm-content">
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/update1', 'id' => $model->id]); ?>" method="post" enctype="multipart/form-data">
                <?php
                echo $this->render('_form1', [
                    'errors' => $errors,
                    'model' => $model,
                ]);
                ?>
                <?php if ($model->status == 4) { ?>
                    <div class="ttl-row"><i class="mdi mdi-file-document-edit fa"></i> Lý do từ chối</div>
                    <div class="form-group">
                        <p class="alert-danger"><?php echo \yii\helpers\Html::encode($model->reason); ?></p>
                    </div>
                <?php } ?>
                <!-- <?php if (!in_array($model->status, [3, 6, 5])) { ?>
                    <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Đăng ký'; ?></button>
                <?php } ?> -->
            </form>
        </div>
    </div>
<?php } ?>
<?php if ($step == 2) { ?>
    <div id="_form2" <?php echo ($step == 2) ? '' : 'style="display: none;"' ?>>
        <div class="frm-content">
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/update2', 'id' => $model->id]); ?>" method="post" enctype="multipart/form-data">
                <?php
                echo $this->render('_form2', [
                    'errors' => $errors,
                    'model' => $model,
                ]);
                ?>
                <?php if ($model->status == 4) { ?>
                    <div class="ttl-row"><i class="mdi mdi-file-document-edit fa"></i> Lý do từ chối</div>
                    <div class="form-group">
                        <p class="alert-danger"><?php echo \yii\helpers\Html::encode($model->reason); ?></p>
                    </div>
                <?php } ?>
                <!-- <?php if (!in_array($model->status, [3, 6, 5])) { ?>
                    <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Đăng ký'; ?></button>
                <?php } ?> -->
            </form>
        </div>
    </div>
<?php } ?>
<?php if ($step == 3) { ?>
    <div id="_form3" <?php echo ($step == 3) ? '' : 'style="display: none;"' ?>>
        <div class="frm-content">
            <form action="<?php echo \yii\helpers\Url::to(['/enterprise/voice', 'id' => $model->id]); ?>" method="post" enctype="multipart/form-data">
                <?php
                echo $this->render('voice', [
                    'model' => $model,
                    'step' => $step,
                    'backgroups' => $backgroups,
                    'voices' => $voices,
                    'playback_speed' => $playback_speed,
                    'giongdoc' => $giongdoc,
                    'enterprise' => $enterprise2,
                    'formName' => $formName,
                    'errors' => $model->getErrors(),
                ]);
                ?>
                <?php if ($model->status == 4) { ?>
                    <div class="ttl-row"><i class="mdi mdi-file-document-edit fa"></i> Lý do từ chối</div>
                    <div class="form-group">
                        <p class="alert-danger"><?php echo \yii\helpers\Html::encode($model->reason); ?></p>
                    </div>
                <?php } ?>
                <!-- <?php if (!in_array($model->status, [3, 6, 5])) { ?>
                    <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Đăng ký'; ?></button>
                <?php } ?> -->
            </form>
        </div>
    </div>
<?php } ?>