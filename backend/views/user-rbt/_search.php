<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseFileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-file-search">

    <?php
    $form = \kartik\widgets\ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <?=
    \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [
            'enterprise_file_id' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['data' => \backend\models\EnterpriseFile::getAll()]
            ],
            'status' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['data' => ['' => 'Tất cả', 1 => 'Đã tải', 0 => 'Chưa tải']]
            ],
            'msisdn' => [
                'type' => \kartik\builder\Form::INPUT_TEXT,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => []
            ],
            'tone_code' => [
                'type' => \kartik\builder\Form::INPUT_TEXT,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => []
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', '/user-rbt/index', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php \kartik\widgets\ActiveForm::end(); ?>

</div>
