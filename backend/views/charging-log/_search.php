<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ChargingLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charging-log-search">

    <?php
    $form = \kartik\widgets\ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?=
    kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [
            'enterprise_id' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['data' => \backend\models\Enteprise::getAll()]
            ],
            'msisdn' => [
                'type' => \kartik\builder\Form::INPUT_TEXT,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => []
            ],
            'error_code' => [
                'type' => \kartik\builder\Form::INPUT_TEXT,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => []
            ],
            'charged_at' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\daterange\DateRangePicker::className(),
                'name' => $model->formName() . '[charged_at]',
                'pluginOptions' => [
                    'timePickerIncrement' => 15,
                    'locale' => [
                        'format' => 'YYYY-MM-DD'
                    ]
                ]
            ]
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', '/charging-log/index', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php \kartik\widgets\ActiveForm::end(); ?>

</div>
