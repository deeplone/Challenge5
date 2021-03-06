<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseFileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-file-search">

    <?php
    $form = \kartik\widgets\ActiveForm::begin([
                'action' => [$action],
                'method' => 'get',
    ]);
    ?>
    <?=
    \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [
            'status' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['data' => Yii::$app->params['enterprise_file_status']]
            ],
            'name' => [
                'type' => \kartik\builder\Form::INPUT_TEXT,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => []
            ],
//            'msisdn' => [
//                'type' => \kartik\builder\Form::INPUT_TEXT,
//                'label' => 'Số điện thoại',
//                'widgetClass' => \kartik\widgets\Select2::className(),
//                'options' => []
//            ],
//            'rbt' => [
//                'type' => \kartik\builder\Form::INPUT_TEXT,
//                'label' => 'Mã nhạc chờ',
//                'widgetClass' => \kartik\widgets\Select2::className(),
//                'options' => []
//            ]
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', '/profile/' . $action, ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php \kartik\widgets\ActiveForm::end(); ?>

</div>
