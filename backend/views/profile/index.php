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

    <?php echo $this->render('_search', ['model' => $searchModel, 'action' => 'index']); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'created_at',
            'id',
            'name',
            'enterprise.full_name:html:Doanh nghiệp',
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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $data) {
                        if ($data->status <> 0) {
                            return Html::a('<span class="glyphicon glyphicon-ok" ' . (($data->status <> 3) ? 'style="color: gray;"' : '') . '></span>', $url, ['title' => \Yii::t('backend', Yii::$app->params['enterprise_file_status'][$data->status]), 'data-pjax' => 0]);
                        }
                    },
                ],
                'headerOptions' => ['style' => 'width:10%'],
            ]
        ],
    ]);
    ?>


</div>
