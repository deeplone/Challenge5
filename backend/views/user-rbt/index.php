<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserRbtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách thuê bao';
?>
<div class="user-rbt-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'profile.name:html:Tên bài hát',
            'tone_id',
            'tone_code',
            'msisdn',
            'register_at',
            'exprired_at',
            [
                'attribute' => 'status',
                'format' => 'html',
                'content' => function($data) {
                    return $data->status == 1 ? 'Đã tải' : 'Chưa tải';
                }
            ],
        ],
    ]);
    ?>


</div>
