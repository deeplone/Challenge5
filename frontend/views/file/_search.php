<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EnterpriseFileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enterprise_id') ?>

    <?= $form->field($model, 'accent') ?>

    <?= $form->field($model, 'region') ?>

    <?= $form->field($model, 'intonational') ?>

    <?php // echo $form->field($model, 'business_license') ?>

    <?php // echo $form->field($model, 'copyright_license') ?>

    <?php // echo $form->field($model, 'recording_content') ?>

    <?php // echo $form->field($model, 'sound_background') ?>

    <?php // echo $form->field($model, 'requires_recording') ?>

    <?php // echo $form->field($model, 'recording_file') ?>

    <?php // echo $form->field($model, 'msisdn_file') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
