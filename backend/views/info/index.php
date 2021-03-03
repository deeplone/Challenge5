<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EprInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biên tập nội dung';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epr-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'type',
                'format' => 'html',
                'content' => function($data) {
                    return Yii::$app->params['epr_info_type'][$data->type];
                },
                'filter' => Yii::$app->params['epr_info_type']
            ],
            //'content:html',
            'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
