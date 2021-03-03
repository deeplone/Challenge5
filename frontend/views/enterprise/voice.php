<?php //var_dump($playback_speed); die; 
?>

<?php if ($type == "paid") { ?>
<form action="<?php echo \yii\helpers\Url::to(['/enterprise/voice', 'type' => 'paid']); ?>" method="post"
      enctype="multipart/form-data">
    <?php } else { ?>
    <form action="<?php echo \yii\helpers\Url::to(['/enterprise/voice', 'type' => 'new']); ?>" method="post"
          enctype="multipart/form-data">
        <?php } ?>
        <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <input type="hidden" name="<?php echo $formName != "" ? $formName : $model->formName(); ?>[recording_file]"/>

        <section class="mdl mdl-recording">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-inline">
                            <li id="tab-1" onclick="tabClick(1)" class="list-inline-item rounded-pill active">Nội dung
                                thu âm
                            </li>
                            <li id="tab-2" class="list-inline-item rounded-pill">Giọng đọc và tốc độ đọc</li>
                            <li id="tab-3" class="list-inline-item rounded-pill">Nhạc nền</li>
                            <li id="tab-4" class="list-inline-item rounded-pill">Tên bài hát và mời cái nhạc chờ</li>
                            <!-- <li id="tab-4" onclick="tabClick(4)" class="list-inline-item rounded-pill">Tên bài hát và mời cái nhạc chờ</li> -->
                        </ul>
                        <!-- Content 2 -->
                        <div id="ctn-1" class="ctn ctn-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    echo $this->render('_noidung', [
                                        'errors' => $errors,
                                        'example_contents' => $recording_content,
                                        'model' => $model,
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="row-ctn-bottom">
                                <a href="/enterprise/index" class="lnk-pre">Quay lại</a>
                                <a id="online-step-1" onclick="nextStep()" class="btn lnk-nex text-decoration-none">Tiếp
                                    tục</a>
                            </div>
                        </div>

                        <div id="ctn-2" class="ctn ctn-3" style="display: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="ttl-sub">Mời bạn lựa chọn giọng đọc</h3>
                                </div>
                                <?php foreach ($voices as $item) { ?>
                                    <?php if ($giongdoc != "") {
                                        $check = ($giongdoc == $item->code) ? 'checked=""' : '';
                                    } else {
                                        $check = ($model->giongdoc == $item->code) ? 'checked=""' : '';
                                    } ?>
                                    <div class="col-md-6">
                                        <div class="row-try">
                                            <div class="col-try">
                                                <button type="button" id="try-listen"
                                                        class="btn btn-outline-blue-aqua rounded-pill btn-listen "
                                                        value="/uploads/<?php echo $item->path ?>">
                                                    <span class="txt">Nghe thử</span> <i class="mdi mdi-pause"></i>
                                                </button>
                                            </div>
                                            <div class="col-try">
                                                <div class="btn btn-blue-aqua rounded-pill"
                                                     style="text-align: left; padding-left: 33%;">
                                                    <div class="pretty p-icon p-round p-pulse">
                                                        <input type="checkbox" class="checkone"
                                                               name="<?php echo $formName != "" ? $formName : $model->formName(); ?>[giongdoc]"
                                                               value="<?php echo yii\helpers\Html::encode($item->code); ?>" <?php echo $check; ?> />
                                                        <div class="state">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label><?php echo yii\helpers\Html::encode($item->description); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                            <?= $this->render('_errorMessage', ['errors' => $errors, 'field' => 'giongdoc']); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="ttl-sub">Mời bạn lựa chọn tốc độ giọng đọc</h3>
                                </div>
                                <?php $playback_speed_arr = ['0.9' => 'Chậm', '1.0' => 'Bình thường', '1.1' => 'Nhanh']; ?>
                                <?php foreach ($playback_speed_arr as $value => $name) { ?>
                                    <?php if ($playback_speed != "") {
                                        $check = ($playback_speed == $value) ? 'checked=""' : '';
                                    } else {
                                        $check = ($model->playback_speed == $value) ? 'checked=""' : '';
                                    } ?>
                                    <div class="col-md-4">
                                        <div class="btn btn-blue-aqua btn-block rounded-pill">
                                            <div class="pretty p-icon p-round p-pulse">
                                                <input type="checkbox" class="checkone1"
                                                       name="<?php echo $formName != "" ? $formName : $model->formName(); ?>[playback_speed]"
                                                       value="<?php echo $value; ?>" <?php echo $check ?> />
                                                <div class="state">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label><?php echo $name; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- <div class="row">
                            <div class="col-md-12">
                                <span class="ttl-sub">Sử dụng nhạc nền (có hoặc không)</span>
                                <div class="pretty p-icon p-curve p-pulse">
                                    <input id="music-background" type="checkbox">
                                    <div class="state">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>Có</label>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                            <div class="row-ctn-bottom">
                                <button type="button" onclick="backStep()" class="btn lnk-nex text-decoration-none">Quay
                                    lại
                                </button>
                                <a id="online-step-2" onclick="nextStep2()" class="btn lnk-nex text-decoration-none">Tiếp
                                    tục</a>
                            </div>
                        </div>

                        <!-- Content 2 -->
                        <div id="ctn-3" class="ctn ctn-3" style="display: none;">
                            <div class="row justify-content-md-center">
                                <div class="col-md-6">
                                    <h3 class="ttl-sub text-center">Mời bạn lựa chọn nhạc nền cho nội dung quảng cáo (Có
                                        hoặc không)</h3>
                                </div>
                            </div>
                            <?php foreach ($backgroups as $item) { ?>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <div class="row-try">
                                            <div class="col-try">
                                                <button type="button" id="try-listen"
                                                        class="btn btn-outline-blue-aqua rounded-pill btn-listen "
                                                        value="/uploads<?php echo $item->path ?>">
                                                    <span class="txt">Nghe thử</span> <i class="mdi mdi-pause"></i>
                                                </button>
                                            </div>
                                            <div class="col-try">
                                                <div class="btn btn-blue-aqua rounded-pill">
                                                    <div class="pretty p-icon p-round p-pulse">
                                                        <input type="checkbox" class="checkone2"
                                                               name="<?php echo $formName != "" ? $formName : $model->formName(); ?>[background]"
                                                               value="<?php echo yii\helpers\Html::encode($item->path); ?>" <?php echo $check; ?> />
                                                        <div class="state">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label><?php echo yii\helpers\Html::encode($item->name); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row-ctn-bottom">
                                <button type="button" onclick="backStep2v2()" class="btn lnk-nex text-decoration-none">
                                    Quay lại
                                </button>
                                <a class="btn lnk-nex text-decoration-none" onclick="nghethu()" data-toggle="modal">Nghe
                                    thử nhạc chờ</a>
                            </div>
                        </div>

                        <div id="ctn-4" class="ctn ctn-2" style="display:none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    echo $this->render('_hoso', [
                                        'formName' => 'RegisterForm3',
                                        'errors' => $errors,
                                        'model' => $model,
                                    ]);
                                    ?>
                                    <input type="text" name="RegisterForm3[recording_file]" class="form-control"
                                           value="" style="display: none;"/>
                                    <div class="row-ctn-bottom">
                                        <button type="button" onclick="backStep2()"
                                                class="btn lnk-nex text-decoration-none">Quay lại
                                        </button>
                                        <button type="submit"
                                                class="btn btn-imuzik hvr-wobble-horizontal"><?php echo ($model->id) ? 'Cập nhật' : 'Tiếp tục'; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade modal-edited" id="listenModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div class="player">
                                <!-- <img src="images/player.png" alt="" srcset="" width="100%" class="img-fluid"> -->
                                <div id="single-song-player">
                                    <img data-amplitude-song-info="cover_art_url"/>
                                    <div class="bottom-container">
                                        <progress class="amplitude-song-played-progress" id="song-played-progress"></progress>

                                        <div class="time-container">
                                            <span class="current-time">
                                                <span class="amplitude-current-minutes"></span>:<span class="amplitude-current-seconds"></span>
                                            </span>
                                            <span class="duration">
                                                <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
                                            </span>
                                        </div>

                                        <div class="control-container">
                                            <div class="amplitude-play-pause" id="play-pause"></div>
                                            <div class="meta-container">
                                                <span data-amplitude-song-info="name" class="song-name"></span>
                                                <span data-amplitude-song-info="artist"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="player">
                                <a id="audio_play" src="">play</a>
                                <a id="audio_pause" src="">pause</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-imuzik hvr-wobble-horizontal">Trở lại</button>
                            <button type="button" onclick="nextStep3()" class="btn btn-imuzik hvr-wobble-horizontal">
                                Tiếp tục
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-edited" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true"
                 style="background: transparent; border:none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="background: transparent;  border:none;">
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <div class="modal fade modal-edited modal-theme" id="paid-finish" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="ctn">
                        <p>Giao dịch thanh toán thành công!</p>
                        <p>Mã hồ sơ trên hệ thống của quý khách là <?php echo($model->id); ?></p>
                        <p>Cảm ơn quý khách đã sử dụng dịch vụ của Viettel</p>
                        <P>
                            <a type="button" href="/user" class="btn btn-block rounded-pill">Quay về quản lý kho nhạc
                                quảng cáo</a>
                        </P>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Amplitude.init({
            "bindings": {
                37: 'prev',
                39: 'next',
                32: 'play_pause'
            },
            "songs": [
                {
                    "name": "Risin' High (feat Raashan Ahmad)",
                    "artist": "Ancient Astronauts",
                    "album": "We Are to Answer",
                    "url": "https://521dimensions.com/song/Ancient Astronauts - Risin' High (feat Raashan Ahmad).mp3",
                    "cover_art_url": "/images/cd.png"
                }
            ]
        });

        window.onkeydown = function (e) {
            return !(e.keyCode == 32);
        };

        /*
          Handles a click on the song played progress bar.
        */
        document.getElementById('song-played-progress').addEventListener('click', function (e) {
            var offset = this.getBoundingClientRect();
            var x = e.pageX - offset.left;

            Amplitude.setSongPlayedPercentage((parseFloat(x) / parseFloat(this.offsetWidth)) * 100);
        });
    </script>