<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprBackground */

$this->title = 'Create Epr Background';
$this->params['breadcrumbs'][] = ['label' => 'Epr Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-background-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
