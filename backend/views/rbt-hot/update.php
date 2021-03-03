<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRbtHot */

$this->title = 'Update Epr Rbt Hot: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Epr Rbt Hots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="epr-rbt-hot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
