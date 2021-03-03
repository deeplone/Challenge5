<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserRbt */

$this->title = 'Create User Rbt';
$this->params['breadcrumbs'][] = ['label' => 'User Rbts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-rbt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
