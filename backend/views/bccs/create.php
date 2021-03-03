<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseFile */

$this->title = 'Create Enterprise File';
$this->params['breadcrumbs'][] = ['label' => 'Enterprise Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
