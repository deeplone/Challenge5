<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprVoices */

$this->title = 'Update Epr Voices: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Epr Voices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="epr-voices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
