<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EnterpriseFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enterprise_id')->textInput() ?>

    <?= $form->field($model, 'accent')->textInput() ?>

    <?= $form->field($model, 'region')->textInput() ?>

    <?= $form->field($model, 'intonational')->textInput() ?>

    <?= $form->field($model, 'business_license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'copyright_license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recording_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sound_background')->textInput() ?>

    <?= $form->field($model, 'requires_recording')->textInput() ?>

    <?= $form->field($model, 'recording_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'msisdn_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
