<?php

use common\helpers\Helpers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ChangePasswordForm */
?>

<?php $form = ActiveForm::begin(['action' => Url::toRoute('/user/update-password'), 'options' => ['data-pjax' => true, 'class' => 'needs-validation']]); ?>

<?= $form->field($model, 'old_password')->passwordInput(['placeholder' => 'Mật khẩu cũ', 'autofocus' => true])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Mật khẩu mới'])->label(false) ?>

<?= $form->field($model, 're_password')->passwordInput(['placeholder' => 'Nhập lại mật khẩu mới'])->label(false) ?>

<p class="font-italic text-center lblSentStatus"><?= isset($message) && $message ? $message : '' ?></p>

<div class="form-group">
    <?= Html::submitButton('Tiếp tục', ['class' => 'btn btn-block btnPopupSubmit']) ?>
</div>

<?php ActiveForm::end(); ?>
