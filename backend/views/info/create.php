<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EprInfo */

$this->title = 'Tạo mới';
$this->params['breadcrumbs'][] = ['label' => 'Biên tập nội dung', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
