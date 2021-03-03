<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRbtHot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epr-rbt-hot-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'rbt_code')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'img_path')->fileInput(['accept' => ".png,.jpg"]) ?>

    <?= $form->field($model, 'audio_path')->fileInput(['accept' => ".mp3"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
