<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignUpForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Đổi mật khẩu';
?>

<?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableClientValidation' => false]); ?>
<div class="modal-dialog modal-dialog-centered" role="document" style="margin-top:-150px;">
    <div class="modal-content" style="width: 350px;">
        <div class="modal-body">
            <h5 class="text-center text-uppercase">Đổi mật khẩu <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></h5>

            <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Mật khẩu"])->label(false) ?>
            <?= $form->field($model, 'new_password')->passwordInput(['placeholder' => "Mật khẩu mới"])->label(false) ?>
            <?= $form->field($model, 're_password')->passwordInput(['placeholder' => "Nhập lại mật khẩu"])->label(false) ?>
            <?=
                $form->field($model, 'captcha')->widget(yii\captcha\Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
                ])->label(false)
            ?>

            <div class="form-group">
                <?= Html::submitButton('Đổi mật khẩu', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'style' => 'width: 100%']) ?>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>