<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EprRecordingContentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nội dung thu âm mẫu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-recording-contents-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tạo nội dung mẫu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'recording_content',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return Html::encode($data->recording_content);
                },
                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle; width: 400px']
            ],
//            'recording_content:ntext',
            'created_at',
//            'created_by',
            'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
            //'updated_by',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
