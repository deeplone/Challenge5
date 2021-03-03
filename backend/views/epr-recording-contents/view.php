<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EprRecordingContents */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Epr Recording Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="epr-recording-contents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa mục này không?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'recording_content:ntext',
            'created_at',
            ['attribute' => 'created_by',
                'value' => $created_by
            ],
            'updated_at',
            ['attribute' => 'updated_by',
                'value' => $updated_by
            ],
        ],
    ]) ?>

</div>
