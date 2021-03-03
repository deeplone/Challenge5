<?php

use frontend\models\ForgotPasswordForm;
use frontend\models\InternalRegisterForm;
use frontend\models\LoginForm;
use frontend\models\RegisterForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$model = new LoginForm();
/* @var $this View */
?>

<?php if (Yii::$app->user->isGuest): ?>
    <div class="modal fade modal-edited full-screen" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-center text-uppercase">Đăng nhập
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                    <?php Pjax::begin(['id' => 'pLoginForm', 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                    <?= $this->render('/user/login', ['model' => $model]); ?>

                    <?php Pjax::end(); ?>

                    <div class="loading popup-loading" style="display: none;">
                        <div class="loader">
                        </div>
                        Đang xử lý ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edited full-screen" id="signUpModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Form register -->
                    <h5 class="text-center text-uppercase">Đăng ký tài khoản
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <p style="text-align: center; font-family: 'Helvetica-Italic';">Nhấn nút đóng để hủy</p>

                    <div class="form-group">
                        <?= Html::button('Tài khoản giáo viên', ['class' => 'btn btn-block btnPopupSubmit', 'onclick' => 'normalSignUp()']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::button('Tài khoản học sinh', ['class' => 'btn btn-block btnPopupSubmit', 'onclick' => 'internalSignUp()']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edited full-screen" id="signUpNormalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Form register -->
                    <h5 class="text-center text-uppercase">Đăng ký tài khoản
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <p style="text-align: center; font-family: 'Helvetica-Italic';">Nhấn nút đóng để hủy</p>
                    <?php Pjax::begin(['id' => 'pNormalSignUpForm', 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                    <?= $this->render('/user/register', ['model' => new RegisterForm()]); ?>

                    <?php Pjax::end(); ?>

                    <div class="loading popup-loading" style="display: none;">
                        <div class="loader">
                        </div>
                        Đang xử lý ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edited full-screen" id="signUpInternalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Form register -->
                    <h5 class="text-center text-uppercase">Đăng ký tài khoản
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <p style="text-align: center; font-family: 'Helvetica-Italic';">Nhấn nút đóng để hủy</p>
                    <?php Pjax::begin(['id' => 'pInternalSignUpForm', 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                    <?= $this->render('/user/internalRegister', ['model' => new InternalRegisterForm()]); ?>

                    <?php Pjax::end(); ?>

                    <div class="loading popup-loading" style="display: none;">
                        <div class="loader">
                        </div>
                        Đang xử lý ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-edited full-screen" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Form register -->
                    <h5 class="text-center text-uppercase" style="margin-bottom: 1.3em;">Lấy lại mật khẩu
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <?php Pjax::begin(['id' => 'pForgotPasswordForm', 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                    <?= $this->render('/user/forgotPassword', ['model' => new ForgotPasswordForm()]); ?>

                    <?php Pjax::end(); ?>

                    <div class="loading popup-loading" style="display: none;">
                        <div class="loader">
                        </div>
                        Đang xử lý ...
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>

</script>