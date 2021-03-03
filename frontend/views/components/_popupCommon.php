<?php

use frontend\models\ChangePasswordForm;
use frontend\models\LoginForm;
use yii\web\View;
use yii\widgets\Pjax;

$model = new LoginForm();
/* @var $this View */
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="modal fade modal-edited full-screen" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Form register -->
                    <h5 class="text-center text-uppercase" style="margin-bottom: 1.3em;">Đổi mật khẩu
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <?php Pjax::begin(['id' => 'pChangePasswordForm', 'enablePushState' => false, 'enableReplaceState' => false]); ?>

                    <?= $this->render('/user/changePassword', ['model' => new ChangePasswordForm(), 'message' => '']); ?>

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
