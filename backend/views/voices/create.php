<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprVoices */

$this->title = 'Cập nhật';
$this->params['breadcrumbs'][] = ['label' => 'Giọng đọc mẫu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-voices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
