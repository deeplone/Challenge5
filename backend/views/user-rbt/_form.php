<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserRbt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-rbt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tone_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tone_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'msisdn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'register_at')->textInput() ?>

    <?= $form->field($model, 'exprired_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
