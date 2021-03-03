<?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
<input type="hidden" name="RegisterForm3[requires_recording]" value="0" />
<?php
echo $this->render('_hoso', [
    'formName' => 'RegisterForm3',
    'errors' => $errors,
    'model' => $model,
]);
?>

<div class="ttl-row"><i class="mdi mdi-file-check fa"></i> Thông tin thuê bao</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label"> Thuê bao yêu cầu kích hoạt bài hát</label>
    <div class="col-sm-8">
        <div class="upload-btn-wrapper">
            <button class="btn-upload hvr-wobble-horizontal">Upload a file</button>
            <input type="file" name="RegisterForm3[msisdn_file]" accept=".txt" />
        </div>
        <?php echo $model->getUrlFile($model->msisdn_file); ?>
    </div>
    <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'msisdn_file']); ?>
</div>


<section class="mdl mdl-recording">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline">
                    <li id="tab-1" class="list-inline-item rounded-pill active">Nội dung thu âm</li>
                    <li id="tab-2" class="list-inline-item rounded-pill">Giọng đọc và tốc độ đọc</li>
                    <li id="tab-3" class="list-inline-item rounded-pill">Giọng đọc và ngữ điệu đọc</li>
                    <li id="tab-4" class="list-inline-item rounded-pill">Nhạc nền</li>
                    <li id="tab-5" class="list-inline-item rounded-pill">Tên bài hát và mời cái nhạc chờ</li>
                </ul>

                <!-- Content 2 -->
                <div id="ctn-1" class="ctn ctn-2">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-italic">Quý khách có thể tham khảo các nội dung quảng cáo theo mẫu có sẵn để tạo ra đoạn quảng cáo phù hợp nhất với doanh nghiệp của mình. Số lượng ký tự để thu âm cho một nội dung quảng cáo từ 650 đến 1200 ký tự.</p>
                            <form>
                                <p>Bạn có thể sử dụng mẫu nội dung quảng cáo <a href="#" class="lnk-nex text-decoration-none" class="btn btn-banner rounded-pill" data-toggle="modal" data-target="#referenceModal">tại đây</a></p>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nội dung quảng cáo</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        <small class="form-text text-muted">
                                            Số lượng ký tự 0/1200
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="/enterprise/index" class="lnk-pre">Quay lại</a>
                        <button id="online-step-1" onclick="test()" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>


                <!-- Content 2 -->
                <div id="ctn-2" class="ctn ctn-3" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn giọng đọc</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Giọng nữ Miền Bắc</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Giọng nam Miền Bắc</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Giọng nữ Miền Nam</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Giọng nam Miền Nam</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn giọng đọc</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Nhanh vừa vui tươi</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Nhanh vừa truyền cảm</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Đọc chậm trang nghiêm</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Đọc chậm truyền cảm</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="ttl-sub">Sử dụng nhạc nền (có hoặc không)</span>
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox">
                                <div class="state">
                                    <i class="icon mdi mdi-check"></i>
                                    <label>Có</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="" class="lnk-pre">Quay lại</a><button id="online-step-2" onclick="test2()" href="" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>


                <!-- Content 3 -->
                <div id="ctn-3" class="ctn ctn-3" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn giọng đọc</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row-try">
                                <div class="col-try"><button type="button" class="btn btn-outline-blue-aqua rounded-pill btn-listen "><span class="txt">Nghe thử</span> <i class="mdi mdi-pause"></i> </button></div>
                                <div class="col-try">
                                    <div class="btn btn-blue-aqua rounded-pill">
                                        <div class="pretty p-icon p-round p-pulse">
                                            <input type="radio" name="voice" />
                                            <div class="state">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>Nhanh</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row-try">
                                <div class="col-try"><button type="button" class="btn btn-outline-blue-aqua rounded-pill btn-listen"><span class="txt">Nghe thử</span> <i class="mdi mdi-pause"></i></button></div>
                                <div class="col-try">
                                    <div class="btn btn-blue-aqua rounded-pill">
                                        <div class="pretty p-icon p-round p-pulse">
                                            <input type="radio" name="voice" />
                                            <div class="state">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>Nhanh</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="ttl-sub">Mời bạn lựa chọn tốc độ giọng đọc</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="btn btn-blue-aqua btn-block rounded-pill">
                                <div class="pretty p-icon p-round p-pulse">
                                    <input type="radio" name="icon_solid" />
                                    <div class="state">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>Nhanh</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn btn-blue-aqua btn-block rounded-pill">
                                <div class="pretty p-icon p-round p-pulse">
                                    <input type="radio" name="icon_solid" />
                                    <div class="state">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>Trunh bình</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn btn-blue-aqua btn-block rounded-pill">
                                <div class="pretty p-icon p-round p-pulse">
                                    <input type="radio" name="icon_solid" />
                                    <div class="state">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>Chậm</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="" class="lnk-pre">Quay lại</a>
                        <button href="" onclick="test3()" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                    </div>
                </div>

                <!-- Content 2 -->
                <div id="ctn-4" class="ctn ctn-3" style="display:none;">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <h3 class="ttl-sub text-center">Mời bạn lựa chọn nhạc nền cho nội dung quảng cáo</h3>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="row-try">
                                <div class="col-try">
                                    <button type="button" class="btn btn-outline-blue-aqua rounded-pill btn-listen">
                                        <span class="txt">Nghe thử</span>
                                        <i class="mdi mdi-pause"></i>
                                    </button>
                                </div>
                                <div class="col-try">
                                    <div class="btn btn-blue-aqua rounded-pill">
                                        <div class="pretty p-icon p-curve p-pulse">
                                            <input type="checkbox" />
                                            <div class="state">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>Kiss the rain</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-ctn-bottom">
                        <a href="" class="lnk-pre text-decoration-none">Quay lại</a>
                        <button href="" onclick="test4();" class="btn lnk-nex text-decoration-none" data-toggle="modal" data-target="#listenModal"><span class="txt">Nghe thử</span> nhạc chờ</button></div>
                </div>

                <!-- Content 2 -->
                <div id="ctn-5" class="ctn ctn-2" style="display:none;">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tên bài hát</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Tên bài hát" required>
                                        <small class="form-text text-muted">
                                            Tên bài hát là tiếng Việt không dấu và không bao gồm ký tự đặc biệt
                                        </small>
                                        <div class="valid-feedback">
                                            Look good.
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a name.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-6 col-form-label">
                                        Danh sách thuê bao mời cài đặt nhạc chờ quảng cáo (nếu có)
                                    </label>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" required>
                                            <label class="custom-file-label" for="customFile">Chọn file</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    Quý khách có thể đính kèm danh sách thuê bao mời kích hoạt và tải nội dung quảng cáo tại đây.
                                    Hệ thống sẽ gửi lời mời tới thuê bao được yêu cầu.
                                    Lưu ý thuê bao mời cài đặt phải là cán bộ, nhân viên của doanh nghiệp.
                                    Định dạng file đính kèm txt. lấy file mẫu <a href="" class="text-decoration-none">tại đây</a>
                                </div>

                            </div>
                        </div>
                        <div class="row-ctn-bottom text-right">
                            <button href="" class="btn lnk-nex text-decoration-none">Tiếp tục</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>