<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EnterpriseFile */

$this->title = 'Update Enterprise File: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Enterprise Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enterprise-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
