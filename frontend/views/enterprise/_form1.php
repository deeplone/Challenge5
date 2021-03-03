<?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
<input type="hidden" name="RegisterForm1[requires_recording]" value="1" />
<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline">
                    <li id="tab-1" onclick="tabClick(1)" class="list-inline-item rounded-pill active">Nội dung thu âm</li>
                    <!-- <li id="tab-2" class="list-inline-item rounded-pill">Giọng đọc và tốc độ đọc</li> -->
                    <li id="tab-2" onclick="tabClick(2)" class="list-inline-item rounded-pill">Giọng đọc và ngữ điệu đọc</li>
                    <!-- <li id="tab-3" class="list-inline-item rounded-pill">Nhạc nền</li> -->
                    <li id="tab-3" onclick="tabClick(3)" class="list-inline-item rounded-pill">Tên bài hát và mời cái nhạc chờ</li>
                </ul>
                <div id="ctn-1" class="ctn ctn-2">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <?php
                                echo $this->render('_noidung', [
                                    'formName' => 'RegisterForm1',
                                    'errors' => $errors,
                                    'model' => $model,
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'sound_background']); ?>
                    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'region']); ?>
                    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'accent']); ?>
                    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'intonational']); ?>
                    <div class="row-ctn-bottom">
                        <a href="/enterprise" class="btn lnk-nex text-decoration-none">Quay lại</a>
                        <button type="button" id="online-step-1" onclick="nextStep()" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>
                <div id="ctn-2" class="ctn ctn-3" style="display:none;">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn giọng đọc</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" class="checkone" name="RegisterForm1[accent]" value="1" checked />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Nam</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" class="checkone" name="RegisterForm1[accent]" value="2" />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Nữ</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" class="checkone1" name="RegisterForm1[region]" value="1" checked />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Miền bắc</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" class="checkone1" name="RegisterForm1[region]" value="2" />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Miền nam</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn ngữ điệu</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" class="checkone2" name="RegisterForm1[intonational]" value="1" checked />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Vừa, trẻ trung</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" class="checkone2" name="RegisterForm1[intonational]" value="2" />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Nghiêm trang</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="ttl-sub">Sử dụng nhạc nền (có hoặc không)</span>

                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="radio" name="RegisterForm1[sound_background]" value="1" <?php echo $model->sound_background == 1 ? 'checked="true"' : ''; ?> />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Có</label>
                                </div>
                            </div>
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="radio" name="RegisterForm1[sound_background]" value="0" <?php echo $model->sound_background == 0 ? 'checked="true"' : ''; ?> />
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Không</label>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row-ctn-bottom">
                        <button type="button" onclick="backStep()" class="btn lnk-nex text-decoration-none">Quay lại</button>
                        <button type="button" onclick="nextStep2v2()" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>

                <div id="ctn-3" class="ctn ctn-2" style="display:none;">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $this->render('_hoso', [
                                'formName' => 'RegisterForm1',
                                'errors' => $errors,
                                'model' => $model,
                            ]);
                            ?>
                            <div class="row-ctn-bottom">
                                <!-- <a href="" class="lnk-pre">Quay lại</a> -->
                                <button type="button" onclick="backStep2v2()" class="btn lnk-nex text-decoration-none">Quay lại</button>
                                <button type="submit" class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Tiếp tục'; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>