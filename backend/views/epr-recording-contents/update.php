<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRecordingContents */

$this->title = 'Cập nhật nội dung mẫu: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nội dung mẫu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="epr-recording-contents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
