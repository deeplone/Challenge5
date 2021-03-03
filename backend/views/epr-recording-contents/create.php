<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRecordingContents */

$this->title = 'Tạo nội dung mẫu';
$this->params['breadcrumbs'][] = ['label' => 'Tạo nội dung mẫu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-recording-contents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
