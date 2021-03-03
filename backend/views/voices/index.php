<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EprVoicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Giọng đọc mẫu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-voices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cập nhật đoạn văn mẫu', ['create'], ['class' => 'btn btn-success']) ?>
        <button type="button" class="btn btn-success voice-priority-update-actions" data-url="/voices/priority-update" data-action="update"><?= Yii::t('backend', 'Cập nhật vị trí') ?></button>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'contentOptions' => ['class' => 'hidden'],
                'format' => 'raw',
                'headerOptions' => ['width' => '25%', 'class' => 'hidden'],
                'value' => function ($model) {
                    return '<input class="form-control" type="text" name="id[]" value="' . $model->id . '">';
                }
            ],
            'name',
            'description',
            [
                'attribute' => 'path',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return $data->audio();
                },
            ],
            [
                'attribute' => 'priority',
                'format' => 'raw',
                'headerOptions' => ['width' => '25%'],
                'value' => function ($model) {
                    return '<input class="form-control" type="text" name="priority[]" value="' . $model->priority . '">';
                }
            ],
        ],
    ]);
    ?>


</div>
