<h4 class="txt-welcome">Mời quý khách hoàn thành hồ sơ đăng ký</h4>
<div class="tlb-content">
    <div>
        <form action="<?php echo \yii\helpers\Url::to(['/enterprise/voice', 'id' => $enterprise->id]); ?>" method="post" enctype="multipart/form-data">
            <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <input type="hidden" name="<?php echo $model->formName(); ?>[recording_file]"/>
            <h5 class="ttl required">1. Mời quý khách nhập nội dung thu âm <span style="color: red; font-size: 13px;" id="counter-character"></span></h5>   
            <textarea id="voice-content" rows="8" name="<?php echo $model->formName(); ?>[content]" style="width: 100%; border: 1px solid;" maxlength="1050"><?php echo yii\helpers\Html::encode($model->content); ?></textarea>
            <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'content']); ?>            

            <h5 class="ttl required">2. Chọn giọng đọc</h5>  
            <table class="table table-hover">
                <tbody>
                    <?php foreach ($voices as $item) { ?>
                        <tr>
                            <td>
                                <?php $check = ($model->giongdoc == $item->code) ? 'checked=""' : ''; ?>
                                <div class="pretty p-icon  p-jelly">
                                    <input type="radio" class="checkone" name="<?php echo $model->formName(); ?>[giongdoc]" value="<?php echo yii\helpers\Html::encode($item->code); ?>" <?php echo $check; ?>/>
                                    <div class="state">
                                        <i class="icon mdi mdi-checkbox-marked-outline"></i>
                                        <label> <?php echo yii\helpers\Html::encode($item->description); ?></label>
                                    </div>
                                </div>   
                            </td>
                            <td><?php echo $item->audio(); ?></td>
                        </tr>
                    <?php } ?>                    
                </tbody>
            </table> 
            <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'giongdoc']); ?>
            <h5 class="ttl required">3. Chọn tốc độ đọc</h5> 
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <?php $playback_speed = ['0.9' => 'Chậm', '1.0' => 'Bình thường', '1.1' => 'Nhanh']; ?>
                        <?php foreach ($playback_speed as $value => $name) { ?>
                            <td>  
                                <div class="col-sm-3">
                                    <div class="pretty p-icon p-jelly">
                                        <input type="radio" class="checkone1" name="<?php echo $model->formName(); ?>[playback_speed]" value="<?php echo $value; ?>" <?php echo $model->playback_speed == $value ? 'checked=""' : '' ?>/>
                                        <div class="state">
                                            <i class="icon mdi mdi-checkbox-marked-outline"></i>
                                            <label> <?php echo $name; ?></label>
                                        </div>
                                    </div>   
                                </div>
                            </td>
                        <?php } ?>
                    </tr> 
                </tbody>
            </table> 
            <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'playback_speed']); ?>
            <h5 class="ttl required">4. Chọn nhạc nền</h5>                 
            <table class="table table-hover">
                <tbody>
                    <?php foreach ($backgroups as $item) { ?>
                        <tr>
                            <td>
                                <?php $check = ($model->background == $item->path) ? 'checked=""' : ''; ?>
                                <div class="pretty p-icon  p-jelly">
                                    <input type="radio" class="checkone2" name="<?php echo $model->formName(); ?>[background]" value="<?php echo yii\helpers\Html::encode($item->path); ?>" <?php echo $check; ?>/>
                                    <div class="state">
                                        <i class="icon mdi mdi-checkbox-marked-outline"></i>
                                        <label> <?php echo yii\helpers\Html::encode($item->name); ?></label>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $item->audio(); ?></td>
                        </tr>
                    <?php } ?>                    
                </tbody>
            </table>  
            <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'background']); ?>
            <input type="submit" class="btn btn-imuzik hvr-wobble-horizontal" value="Thu âm"/>
            <div>
                <?php if ($enterprise->recording_file) { ?>
                    <div style="padding-top: 10px;">
                        <span style="vertical-align: middle; display: inline-block;">File thu âm </span>
                        <audio controls  style="vertical-align: middle; display: inline-block;"><source src="<?php echo $enterprise->getFile(); ?>"></audio>
                        <?php if (!$enterprise->status) { ?>
                            <a class="btn btn-imuzik hvr-wobble-horizontal" href="<?php echo \yii\helpers\Url::to(['/enterprise/payment', 'id' => $enterprise->id]); ?>">Tiếp theo</a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </form>
    </div>
</div>