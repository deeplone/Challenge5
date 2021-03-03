<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignUpForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Lấy lại mật khẩu';
?>
<?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableClientValidation' => false]); ?>
    <div class="modal fade modal-edited" id="resetPassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-center text-uppercase">Khôi phục mật khẩu
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                    <span>Hệ thống đã gửi một mã xác nhận về số điện thoại của bạn</span>

                    <?= $form->field($model, 'msisdn')->textInput()->input('msisdn', ['placeholder' => "Nhập số điện thoại", 'style' => 'display: none;'])->label(false) ?>


                    <?= $form->field($model, 'otp')->textInput()->input('otp', ['placeholder' => "Nhập mã xác thực"])->label(false) ?>

                    <p class="text-center">
                        <a id="get-otp-password" class="text-reset font-weight-bold"> <span class="mdi mdi-refresh"></span> Lấy lại mã xác thực OTP</a>
                    </p>

                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Nhập mật khẩu"])->label(false) ?>
                    </div>


                    <div class="form-group">
                        <div class="form-group field-resetme-re-password">

                            <input type="password" id="resetme-re-password" class="form-control"
                                   name="ResetMe[resetme-re-password]" placeholder="Nhập lại mật khẩu" required>

                            <p class="help-block help-block-error"></p>
                        </div>
                        <!--                        <input type="password" class="form-control" id="resetme-re-password" placeholder="Nhập lại mật khẩu" required>-->
                    </div>
                    <?=
                    $form->field($model, 'captcha')->widget(yii\captcha\Captcha::className(), [
                        'template' => '<div class="row" style="width: 109%"><div class="col-lg-9" >{input}</div><div class="col-lg-3" style="margin-left: -44px;">{image}</div></div>',
                        'options' => ['placeholder' => 'Nhập captcha'],
                    ])->label(false)
                    ?>
                    <div class="form-group">

                        <?= Html::button('Tiếp tục', ['class' => 'btn btn-primary', 'id' => 'reset-me-button', 'name' => 'reset-me-button']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#reset-me-button').click(function () {
            var msisdn = $("#loginform-msisdn").val();
            var otp = $("#resetme-otp").val();
            var password = $("#resetme-password").val();
            var rePassword = $("#resetme-re-password").val();
            var captcha = $("#resetme-captcha").val();
            if (otp != "") {
                $('.field-resetme-otp p').css({'color': 'red'}).html("");
                if (password != "") {
                    $('.field-resetme-password p').css({'color': 'red'}).html("");
                    if (password == rePassword) {
                        if (captcha != "") {
                            $.ajax({
                                url: '/reset-me',
                                data: {
                                    otp: otp,
                                    msisdn: msisdn,
                                    captcha: captcha,
                                    password: password,
                                    // actionType: "create_user",
                                    _csrf: $('meta[name="csrf-token"]').attr("content")
                                },
                                type: 'post',
                                dataType: "json",
                                success: function (data) {
                                    console.log(data);
                                    if (data.code == 200) {
                                        $("#resetPassword").modal('hide');
                                        $("#loginModal").modal('show');
                                        alert("Đổi mật khẩu thành công");
                                    }
                                    if (data.code == 0) {
                                        alert("Có lỗi xảy ra, vui lòng thử lại!");
                                    }
                                }
                            });
                        } else {
                            $('.field-resetme-captcha p').css({'color': 'red'}).html("<p>Vui lòng nhập captcha</p>");
                        }
                    } else {
                        if (rePassword == "") {
                            $('.field-resetme-re-password p').css({'color': 'red'}).html("<p>Vui lòng nhập lại mật khẩu</p>");
                        } else {
                            $('.field-resetme-re-password p').css({'color': 'red'}).html("<p>Nhập lại mật khẩu không đúng</p>");
                        }
                    }
                } else {
                    $('.field-resetme-re-password p').css({'color': 'red'}).html("");
                    $('.field-resetme-password p').css({'color': 'red'}).html("<p>Vui lòng nhập mật khẩu mới</p>");
                }
            } else {
                $('.field-resetme-otp p').css({'color': 'red'}).html("<p>Vui lòng nhập mã OTP</p>");
                $('.field-resetme-re-password p').css({'color': 'red'}).html("");
                $('.field-resetme-password p').css({'color': 'red'}).html("");
            }
        })

        $('#get-otp-password').click(function () {
            var regex = new RegExp('^(0|84|\\+84|)[1-9]([0-9]{8})$');
            var msisdn = $("#loginform-msisdn").val();
            var captcha = $('#resetme-captcha').val();
            // $('p.help-block-error').html('');
            if (msisdn != "") {
                if (captcha != "") {
                    if (msisdn && regex.test(msisdn)) {
                        $.ajax({
                            url: '/get-otp',
                            data: {
                                msisdn: msisdn,
                                captcha: captcha,
                                actionType: "reset_password",
                                _csrf: $('meta[name="csrf-token"]').attr("content")
                            },
                            type: 'post',
                            dataType: "jsonp",
                            success: function (data) {
                                console.log(data);
                                if (data.code == 200) {
                                    alert(data.message);
                                } else {
                                    alert("Có lỗi xảy ra, xin vui lòng thử lại!");
                                }
                            }
                        });
                    } else {
                        $('.field-resetme-msisdn p').html('Số điện thoại không đúng định dạng');
                    }
                } else {
                    $('.field-resetme-captcha p').html('Mã xác thực không được để trống');
                }
            } else {
                $('.field-resetme-msisdn p').html('Số điện thoại không được để trống');
            }
        });
    </script>
<?php ActiveForm::end(); ?>