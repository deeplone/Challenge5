<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseRbt */

$this->title = 'Update Enterprise Rbt: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enterprise Rbts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enterprise-rbt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
