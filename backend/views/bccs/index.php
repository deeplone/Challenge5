<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EnterpriseFileBccsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách nhạc chờ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel, 'action' => 'index']); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'enterprise_id',
            'enterprise.email',
            'enterprise.msisdn',
            [
                'attribute' => 'business_license',
                'format' => 'html',
                'content' => function($data) {
                    return \kartik\helpers\Html::a('Giấy phép', '/uploads/' . $data->business_license, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'copyright_license',
                'format' => 'html',
                'content' => function($data) {
                    return \kartik\helpers\Html::a('Bản quyền', '/uploads/' . $data->copyright_license, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'msisdn_file',
                'format' => 'html',
                'content' => function($data) {
                    return \kartik\helpers\Html::a('Danh sách', '/uploads/' . $data->msisdn_file, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'requires_recording',
                'format' => 'html',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_requires_recording'][$data->requires_recording];
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'label' => 'Trạng thái',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_status'][$data->status];
                }
            ],
            [
                'attribute' => 'recording_file',
                'format' => 'html', //raw, html
                'content' => function($data) {
                    return '<audio controls>
                            <source src="' . $data->getFile() . '">
                            Your browser does not support the audio element.
                        </audio>';
                },
            ],
            'rbt.tone_code',
//            'accent',
//            'region',
//            'intonational',
            //'business_license',
            //'copyright_license',
            //'recording_content:ntext',
            //'sound_background',
            //'requires_recording',
            //'recording_file',
            //'msisdn_file',
            //'status',
            //'created_at',
            //'updated_at',
            //'updated_by',
            //'reason',
            //'name',
            //'brand_id',
            //'source',
            //'background_music',
            //'msisdn_pay',
            //'relate_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
