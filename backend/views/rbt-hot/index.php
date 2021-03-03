<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EprRbtHotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhạc chờ hot';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-rbt-hot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return Html::encode($data->name);
                },
                'contentOptions' => ['style' => 'text-align: left; vertical-align: middle; width: 400px']
            ],
            [
                'attribute' => 'img_path',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return $data->getImage();
                },
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
            [
                'attribute' => 'audio_path',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return $data->getAudio();
                },
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
            [
                'attribute' => 'created_at',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return Html::encode($data->created_at);
                },
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
            ],
        ],
    ]);
    ?>


</div>
