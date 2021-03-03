<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRecordingContents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epr-recording-contents-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'recording_content')->textarea(['rows' => 13] ) ?>
        <small class="form-text text-muted">
            Số lượng ký tự: <span style="color: red; font-size: 13px;" id="counter-character"></span>
        </small>

        <div class="form-group">
            <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
