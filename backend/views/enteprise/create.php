<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Enteprise */

$this->title = Yii::t('backend', 'Create Enteprise');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Enteprises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enteprise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
