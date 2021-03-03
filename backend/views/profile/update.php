<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EnterpriseFile */
/* @var $recording_file String */

$this->title = 'Phê duyệt hồ sơ mã: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hồ sơ doanh nghiệp', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enterprise-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'recording_file' => $recording_file
    ])
    ?>

</div>
