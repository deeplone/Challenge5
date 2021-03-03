<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignUpForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

<div class="modal fade modal-edited" id="signUpModalStep1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Form register -->
                <h5 class="text-center text-uppercase">Đăng ký tài khoản
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
                <p id="signup-error" class="help-block help-block-error" style="display:none;">
                    Đăng ký tài khoản thất bại, vui lòng thử lại!
                </p>

                <div class="form-group">
                    <?= $form->field($model, 'msisdn')->textInput(['autofocus' => true])->input('msisdn', ['placeholder' => "Số điện thoại"])->label(false) ?>
                    <span id="tel-mess" style="display: none;"></span>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'full_name')->input('full_name', ['placeholder' => "Nhập họ và tên"])->label(false) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'email')->input('full_name', ['placeholder' => "Nhập Email đăng ký"])->label(false) ?>
                    <span id="email-mess" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'id_number')->input('id_number', ['placeholder' => "Số chứng minh thư"])->label(false) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Nhập mật khẩu"])->label(false) ?>
                </div>

                <div class="form-group">
                    <div class="form-group field-enteprise-repeat_password required has-error">

                        <input type="password" id="repeat_password" class="form-control"
                               placeholder="Nhập lại mật khẩu" aria-required="true" aria-invalid="true">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <?=
                $form->field($model, 'captcha')->widget(yii\captcha\Captcha::className(), [
                    'template' => '<div class="row" style="width: 109%"><div class="col-lg-9" >{input}</div><div class="col-lg-3" style="margin-left: -44px;">{image}</div></div>',
                    'options' => ['placeholder' => 'Nhập captcha'],
                ])->label(false)
                ?>


                <!-- <button class="btn btn-primary btn-block" type="submit" onclick="singupStep2()">Tiếp tục</button> -->
                <a id="signupButtonStep1" class="btn btn-primary btn-block">Tiếp tục</a>
            </div>
        </div>
    </div>
</div>


<!-- Sigup Modal step 2 -->
<div class="modal fade modal-edited" id="signUpModalStep2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Form register -->
                <h5 class="text-center text-uppercase">Đăng ký tài khoản
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </h5>
                <p class="font-italic text-center">Hệ thống đã gửi một mã xác thực đăng ký tài khoản tới số thuê bao
                    <span id="phone-number" value=""></p>

                <div class="form-group">
                    <?= $form->field($model, 'otp')->textInput(['autofocus' => true])->input('otp', ['placeholder' => "Nhập mã xác thực"])->label(false) ?>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                    <div class="invalid-feedback">
                        Vui lòng không bỏ trống trường này!
                    </div>
                </div>

                <p class="text-center">
                    <a href="" class="text-reset font-weight-bold"> <span class="mdi mdi-refresh"></span> Lấy lại mã xác
                        thực OTP</a>
                </p>

                <div class="form-group">
                    <?= $form->field($model, 'agree')->checkbox()->label('Tôi hoàn toàn đồng ý với các điều khoản của dịch vụ') ?>
                    <div class="scroll-content">
                        Vui lòng đọc “Điều khoản sử dụng” này nếu bạn đang xem xét sử dụng bất cứ tài liệu, dịch vụ
                        hoặc thôngtin nào hiển thị trên trang của Sony Mobile Communications.
                        <br>Lưu ý rằng bằng việc truy cập và/hoặc sử dụngtrang của chúng tôi, bạn đồng ý với những
                        Điều khoản sử dụng này.
                        <br> Nếu bạn không đồng ý với Điều khoản sử dụng của chúng tôi, hãy ngưng kết nối và không
                        sử dụng Trang này.
                    </div>
                </div>

                <div class="form-group" style="padding-left: 30px;">
                    <?= Html::button('Đăng ký', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'id' => 'signup-button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#signupButtonStep1').click(function () {
        var regex = new RegExp('^(0|84|\\+84|)[1-9]([0-9]{8})$');
        var msisdn = $('#enteprise-msisdn').val();
        var password = $('#enteprise-password').val();
        var captcha = $('#enteprise-captcha').val();
        var fullName = $('#enteprise-full_name').val();
        var idNumber = $('#enteprise-id_number').val();
        var email = $('#enteprise-email').val();
        var repeatPassword = $('#repeat_password').val();
        // $('p.help-block-error').html('');

        if (!msisdn) {
            $('.field-enteprise-msisdn p').html('Số điện thoại không được để trống');
        } else if (!regex.test(msisdn)) {
            $('.field-enteprise-msisdn p').html('Số điện thoại không đúng định dạng');
        }
        if (!fullName) {
            $('.field-enteprise-full_name p').html('Họ tên không được để trống');
        }
        if (!email) {
            $('.field-enteprise-email p').html('Email không được để trống');
        }
        if (!idNumber) {
            $('.field-enteprise-id_number p').html('Số chứng minh thư không được để trống');
        }
        if (!captcha) {
            $('.field-enteprise-captcha p').html('Captcha không được để trống');
        }
        if (!password) {
            $('.field-enteprise-password p').html('Mật khẩu không được để trống');
        }
        if (!repeatPassword) {
            $('.field-enteprise-repeat_password p').html('Mật khẩu không được để trống');
        }
        if (password && repeatPassword && password !== repeatPassword) {
            $('.field-enteprise-repeat_password p').html('Mật khẩu nhập lại không trùng');
        }
        $.ajax({
            url: '/get-otp',
            data: {
                ResetMe: {
                    msisdn: msisdn,
                    captcha: captcha,
                    email: email,
                    actionType: "create_user",
                    _csrf: $('meta[name="csrf-token"]').attr("content")
                }
            },
            type: 'post',
            dataType: "json",
            success: function (data) {
                // $("#loadingModal").modal('hide');
                console.log(data);
                if (data.code == 200) {
                    $("#signUpModalStep1").modal('hide');
                    $("#phone-number").text(msisdn);
                    $("#signUpModalStep2").modal('show');
                } else {
                    // alert("vào đây à?");
                    $("#signUpModalStep1").modal('show');
                    $("#enteprise-captcha-image").click();
                    if (data.msisdn) {
                        $('.field-enteprise-msisdn p').css({'color': 'red'}).html(data.msisdn);
                    }
                    if (data.email) {
                        $('.field-enteprise-email p').css({'color': 'red'}).html(data.email);
                    }
                    if (data.captcha) {
                        $('.field-enteprise-captcha p').css({'color': 'red'}).html(data.captcha);
                    }
                }
            }
        });

    });

    $("#signup-button").click(function () {
        var msisdn = $('#enteprise-msisdn').val();
        var password = $('#enteprise-password').val();
        var captcha = $('#enteprise-captcha').val();
        var fullName = $('#enteprise-full_name').val();
        var idNumber = $('#enteprise-id_number').val();
        var email = $('#enteprise-email').val();
        var repeatPassword = $('#repeat_password').val();
        var otp = $('#enteprise-otp').val();
        var agree = $('#enteprise-agree').val();
        // console.log(document.getElementById("enteprise-agree").getAttribute("aria-invalid"));
        // return false;
        // var checkAgree = document.getElementById("enteprise-agree").getAttribute("aria-invalid");

        $ariaInvalid = document.getElementById('enteprise-agree').getAttribute('aria-invalid');
        var checkVal = 0;
        if ($ariaInvalid === false) {
            checkVal = 1;
        } else {
            checkVal = 0;
        }
        console.log("AAAAAA", checkVal);
        if ($ariaInvalid == null || $ariaInvalid === true) {
            $('.field-enteprise-agree p').css({'color': 'red'}).text("Bạn chưa đồng ý với các điều khoản của dịch vụ");
            return false;
        }

        if (otp != "") {
            $.ajax({
                url: '/signup',
                data: {
                    msisdn: msisdn,
                    captcha: captcha,
                    password: password,
                    fullName: fullName,
                    idNumber: idNumber,
                    email: email,
                    agree: agree,
                    repeatPassword: repeatPassword,
                    otp: otp,
                    // actionType: "create_user",
                    _csrf: $('meta[name="csrf-token"]').attr("content")
                },
                type: 'post',
                dataType: "json",
                success: function (data) {
                    if (data.code == 200) {
                        alert("Đăng ký thành công");
                        $('.field-loginform-password p').html('');
                        $('.field-loginform-password p').html('');
                        $("#signUpModalStep2").modal('hide');
                        $("#loginform-msisdn").val(msisdn);
                        $("#loginModal").modal('show');
                    } else {
                        console.log(data);
                        alert("Mã xác nhận không đúng");
                    }
                }
            });
        } else {
            $('.field-enteprise-msisdn p').css({'color': 'red'}).text("Vui lòng nhập mã xác thực");
        }
    })
</script>
<?php ActiveForm::end(); ?>


