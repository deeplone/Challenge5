<?php

use frontend\models\ChargingLog;
use frontend\models\EnterpriseFile;
use frontend\models\EnterpriseRbt;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $searchModel frontend\models\ChargingLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>


<section class="mdl mdl-table" id="manageRingTone">
    <div class="container">
        <div class="row row-top">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'action' => ['transaction-manage', 'id' => Yii::$app->request->getQueryParam('id')],
                    'method' => 'get',
                    'options' => [
                        'class' => 'form-inline'
                    ]
                ]); ?>

                <span class="txt-col-1">Từ ngày</span>

                <?=  DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'from_date',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{input}{remove}',
                    'options' => [
                        'readonly' => true,
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'display' => 'none',
                    ]
                ]);
                ?>

                <span class="txt-col-1 ml-5">Tới ngày</span>

                <?=  DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'to_date',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{input}{remove}',
                    'options' => [
                        'readonly' => true,
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]);
                ?>

                <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="scroll-table">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => 'Hiển thị <b>{begin}-{end}</b> / <b>{totalCount}</b> bản ghi',
                        'tableOptions' => ['class' => 'table table-hover table-bordered'],
                        'pager' => [
                            'class' => 'common\helpers\FrontendPager'
                        ],
                        'columns' => [
                            [
                                'header' => 'Thời gian yêu cầu',
                                'attribute' => 'enterprise_file_id',
                                'content' => function ($data) {
                                    /* @var ChargingLog $data */
                                    return $data->charged_at;
                                },
                            ],
                            [
                                'header' => 'Tên bài hát',
                                'attribute' => 'enterprise_file_id',
                                'content' => function ($data) {
                                    /* @var ChargingLog $data */
                                    return EnterpriseFile::getFileById($data->enterprise_file_id)->name;
                                },
                            ],
                            [
                                'header' => 'Mã bài hát',
                                'attribute' => 'enterprise_file_id',
                                'content' => function ($data) {
                                    /* @var ChargingLog $data */
                                    return EnterpriseRbt::getRbtByFileId($data->enterprise_file_id)->tone_code;
                                },
                            ],
                            [
                                'header' => 'Trạng thái',
                                'attribute' => 'enterprise_file_id',
                                'content' => function ($data) {
                                    /* @var ChargingLog $data */
                                    return Yii::$app->params['enterprise_file_status'][EnterpriseFile::getFileById($data->enterprise_file_id)->status];
                                },
                            ],
                            [
                                'header' => 'Tỷ lệ chiết khấu',
                                'attribute' => 'discount',
                                'content' => function ($data) {
                                    /* @var ChargingLog $data */
                                    return !$data->discount ? 'Không có' : $data->discount . '%';
                                },
                            ],
                            [
                                'header' => 'Thanh toán',
                                'attribute' => 'fee',
                                'content' => function ($data) {
                                    /* @var ChargingLog $data */
                                    return $data->fee. ' VNĐ';
                                },
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
</section>
