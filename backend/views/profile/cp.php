<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EnterpriseFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hồ sơ doanh nghiệp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_cp', ['model' => $searchModel, 'action' => 'cp']); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'enterprise.email',
            'enterprise.msisdn',
            [
                'attribute' => 'msisdn_file',
                'format' => 'html',
                'content' => function($data) {
                    return \kartik\helpers\Html::a('Danh sách', '/uploads/' . $data->msisdn_file, ['target' => '_blank']);
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
            'brand_id',
            [
                'attribute' => 'status',
                'format' => 'html',
                'label' => 'Trạng thái',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_status'][$data->status];
                }
            ],
            [
                'attribute' => 'requires_recording',
                'format' => 'html',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_requires_recording'][$data->requires_recording];
                }
            ],
            'created_at',
        ],
    ]);
    ?>


</div>
