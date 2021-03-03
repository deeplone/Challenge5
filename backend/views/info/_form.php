<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EprInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epr-info-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->params['epr_info_type']) ?>

    <?=
    $form->field($model, 'content')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => '/site/upload',
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
