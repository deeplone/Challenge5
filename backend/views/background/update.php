<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprBackground */

$this->title = 'Update Epr Background: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Epr Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="epr-background-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
