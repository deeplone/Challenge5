<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRbtHot */

$this->title = 'Tạo mới nhạc chờ hot';
$this->params['breadcrumbs'][] = ['label' => 'Nhạc chờ hot', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-rbt-hot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
