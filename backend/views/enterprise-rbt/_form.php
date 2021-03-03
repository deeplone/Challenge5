<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseRbt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-rbt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tone_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tone_id')->textInput() ?>

    <?= $form->field($model, 'enterprise_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'expired_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
