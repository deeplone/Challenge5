<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

    <!-- modal dialog for display pop up login -->
    <!-- <div class="modal-dialog"> -->


    <!-- start ActiveForm -->

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="modal fade modal-edited" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-center text-uppercase">Đăng nhập
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                    <?= $form->field($model, 'msisdn')->textInput(['autofocus' => true])->input('msisdn', ['placeholder' => "Số điện thoại"])->label(false) ?>

                    <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Mật khẩu"])->label(false) ?>
                    <p id="login-error" class="help-block help-block-error" style="display:none;">
                        Số điện thoại hoặc mật khẩu không đúng
                    </p>
                    <?=
                    $form->field($model, 'captcha')->widget(yii\captcha\Captcha::className(), [
                        'template' => '<div class="row" style="width: 109%"><div class="col-lg-9" >{input}</div><div class="col-lg-3" style="margin-left: -44px;">{image}</div></div>',
                        'options' => ['placeholder' => 'Nhập captcha'],
                    ])->label(false)
                    ?>

                    <!-- <?= $form->field($model, 'rememberMe')->checkbox() ?> -->
                    <div class="form-group">
                        <?= Html::button('Đăng nhập', ['class' => 'btn btn-primary', 'id' => 'btn-login', 'name' => 'login-button', 'style' => 'width: 100%']) ?>
                    </div>

                    <div class="form-group last-row">
                        <div class="form-row">
                            <div class="col-5 col-md-4 text-right">
                                <a id="reset-pwd" class="text-reset text-decoration-none active">Quên mật khẩu</a>
                            </div>
                            <div class="col-2 col-md-4 text-center">
                                <span class="border-right"></span>
                            </div>
                            <div class="col-5 col-md-4 text-left">
                                <a href="" class="text-reset text-decoration-none">Đổi mật khẩu</a>
                            </div>
                        </div>
                    </div>
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
    <script>
        $("#btn-login").click(function () {
            var msisdn = $("#loginform-msisdn").val();
            var password = $("#loginform-password").val();
            var captcha = $("#loginform-captcha").val();

            if (msisdn != "" && password != "" && captcha != "") {
                $.ajax({
                    url: '/login',
                    data: {
                        LoginForm: {
                            msisdn: msisdn,
                            captcha: captcha,
                            password: password,
                            // actionType: "create_user",
                            _csrf: $('meta[name="csrf-token"]').attr("content")
                        }
                    },
                    type: 'post',
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.code == 200) {
                            window.location.href = "/user";
                        } else {
                            $("#login-error").show();
                        }
                    }
                });
            } else {
                //console.log("Empty value");
                $('#login-form').submit();
            }
        });

        $("#reset-pwd").click(function () {
            var regex = new RegExp('^(0|84|\\+84|)[1-9]([0-9]{8})$');
            var msisdn = $("#loginform-msisdn").val();
            var password = $("#loginform-password").val();
            var captcha = $("#loginform-captcha").val();

            if (msisdn != "") {
                if (captcha) {
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
                            dataType: "json",

                            beforeSend: function () {
                                $("#loginModal").modal('hide');
                                $("#loadingModal").modal('show');
                            },
                            success: function (data) {
                                if (data.code == 200) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'reset-me',
                                        beforeSend: function () {
                                            $("#loadingModal").modal('show');
                                        },
                                        success: function (data) {
                                            $("#loadingModal").modal('hide');
                                            $("body").append(data)
                                            $('#resetPassword').modal();

                                        }
                                    });
                                } else {
                                    $("#loginModal").modal('show');
                                    $("#loadingModal").modal('hide');
                                    alert("Có lỗi xảy ra, vui lỏng thử lại!");
                                }

                            }
                        });
                    } else {
                        $('.field-loginform-msisdn p').html('Số điện thoại không đúng định dạng');
                    }
                } else {
                    $('.field-loginform-msisdn p').html('Mã xác thực không được để trống');
                }
            } else {
                $('.field-loginform-msisdn p').html('Số điện thoại không được để trống');
            }
        })
    </script>
<?php ActiveForm::end(); ?>