<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EnterpriseRbtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enterprise Rbts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-rbt-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Enterprise Rbt', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tone_code',
            'tone_id',
            'enterprise_id',
            'created_at',
            //'created_by',
            //'expired_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
