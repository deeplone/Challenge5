<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseFile */
/* @var $recording_file String */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-file-form">

    <?php $form = \kartik\widgets\ActiveForm::begin(); ?>

    <?=
    \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [
            'enterprise_id' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['data' => \backend\models\Enteprise::getAll(), 'disabled' => true]
            ],
            'requires_recording' => [
                'type' => \kartik\builder\Form::INPUT_WIDGET,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['data' => Yii::$app->params['enterprise_file_requires_recording'], 'disabled' => true]
            ],
            'name' => [
                'type' => \kartik\builder\Form::INPUT_TEXT,
                'widgetClass' => \kartik\widgets\Select2::className(),
                'options' => ['disabled' => true]
            ],
        ]
    ]);
    ?>

    <?php
    if ($model->requires_recording) {
        echo \kartik\builder\Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 4,
            'attributes' => [
                'accent' => [
                    'type' => \kartik\builder\Form::INPUT_WIDGET,
                    'widgetClass' => \kartik\widgets\Select2::className(),
                    'options' => ['data' => Yii::$app->params['enterprise_file_accent'], 'disabled' => true]
                ],
//                'region' => [
//                    'type' => \kartik\builder\Form::INPUT_WIDGET,
//                    'widgetClass' => \kartik\widgets\Select2::className(),
//                    'options' => ['data' => Yii::$app->params['enterprise_file_region'], 'disabled' => true]
//                ],
                'intonational' => [
                    'type' => \kartik\builder\Form::INPUT_WIDGET,
                    'widgetClass' => \kartik\widgets\Select2::className(),
                    'options' => ['data' => Yii::$app->params['enterprise_file_intonational'], 'disabled' => true]
                ],
                'sound_background' => [
                    'type' => \kartik\builder\Form::INPUT_WIDGET,
                    'widgetClass' => \kartik\widgets\Select2::className(),
                    'options' => ['data' => Yii::$app->params['enterprise_file_sound_background'], 'disabled' => true]
                ],
            ]
        ]);
    }
    ?>    

    <?php echo ($model->requires_recording) ? $form->field($model, 'recording_content')->textarea(['rows' => 6, 'disabled' => true]) : '' ?>

    <div class="form-group highlight-addon field-enterprisefile-status">
        <label class="control-label has-star" for="enterprisefile-status">Trạng thái: <?php echo Html::encode(Yii::$app->params['enterprise_file_status'][$model->status]) ?></label>
    </div>

    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'reason')->textarea(['rows' => 6])->label('Lý do từ chối duyệt') ?>

    <div>
        <?= \kartik\helpers\Html::a('Giấy phép kinh doanh', '/uploads/' . $model->business_license, ['target' => '_blank']); ?>; 
        &nbsp;<?= \kartik\helpers\Html::a('Giấy tờ bản quyền', '/uploads/' . $model->copyright_license, ['target' => '_blank']); ?>;
        &nbsp;<?= \kartik\helpers\Html::a('Số lượng thuê bao yêu cầu gửi tặng nhạc chờ', '/uploads/' . $model->msisdn_file, ['target' => '_blank']); ?>
    </div>
    <?php if ($model->relate_id) { ?>
    <div class="form-group highlight-addon field-enterprisefile-status">
        <label class="control-label has-star" for="enterprisefile-status">Mã hồ sơ gốc: <?php echo Html::encode( $model->relate_id) ?></label>
    </div>
    <?php } ?>

    <div style="margin-top: 10px; margin-bottom: 10px;">
        <?php if ($recording_file) { ?>
            <span style="vertical-align: middle; text-align: left;">File nhạc gốc: </span>
            <audio controls="" style="vertical-align: middle"><source src="<?php echo '/uploads'.$recording_file ?>"></audio>
        <?php } ?>
    </div>

    <div style="margin-top: 10px; margin-bottom: 10px;">
        <?php if ($model->recording_file) { ?>
            <span style="vertical-align: middle; text-align: left;">File nhạc mới: </span>
            <audio controls="" style="vertical-align: middle"><source src="<?php echo $model->getFile(); ?>"></audio>
        <?php } ?>
    </div>

    <div class="form-group">
        <?php // echo in_array($model->status, [1]) ? Html::button('Tạo nhạc chờ', ['class' => 'btn btn-success', 'status' => 6, 'name' => 'enterprise_approved']) : ''; ?>
        <?= !in_array($model->status, [0, 3, 4]) ? Html::button('Từ chối duyệt', ['class' => 'btn btn-success', 'status' => 4, 'name' => 'enterprise_approved']) : ''; ?>
        <?= in_array($model->status, [1]) ? Html::button('Phê duyệt', ['class' => 'btn btn-success', 'status' => 3, 'name' => 'enterprise_approved']) : ''; ?>
    </div>

    <?php \kartik\widgets\ActiveForm::end(); ?>

</div>
