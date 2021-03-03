<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EprVoices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epr-voices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 10]); ?>

    <div class="form-group">
        <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
