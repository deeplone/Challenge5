<?php

use frontend\models\UserRbt;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $searchModel frontend\models\UserRbtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<section class="mdl mdl-table" id="manageRingTone">
    <div class="container">
        <div class="row row-top">
            <div class="col-md-9">
                <?php $form = ActiveForm::begin([
                    'action' => ['user-rbt', 'id' => Yii::$app->request->getQueryParam('id')],
                    'method' => 'get',
                    'options' => [
                        'class' => 'form-inline'
                    ]
                ]); ?>

                <span class="txt-col-1">Số điện thoại</span>

                <?= Html::activeTextInput($searchModel, 'msisdn', [
                    "class" => "form-control rounded-pill bg-secondary text-white border-0 small-ipt",
                    "placeholder" => "Số điện thoại",
                    "aria-label" => "Search",
                ]); ?>

                <span class="txt-col-1 ml-5">Mã bài hát</span>

                <?= Html::activeTextInput($searchModel, 'tone_code', [
                    "class" => "form-control rounded-pill bg-secondary text-white border-0 small-ipt",
                    "placeholder" => "Mã bài hát",
                    "aria-label" => "Search",
                ]); ?>

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
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'Thứ tự',
                            ],
                            [
                                'header' => 'Số điện thoại',
                                'attribute' => 'msisdn',
                            ],
                            [
                                'header' => 'Mã bài hát',
                                'attribute' => 'tone_code',
                            ],
                            [
                                'header' => 'Trạng thái',
                                'attribute' => 'status',
                                'content' => function ($data) {
                                    /* @var UserRbt $data */
                                    return $data->status == 1 ? 'Đã kích hoạt' : 'Chờ kích hoạt';
                                },
                            ],
                            [
                                'header' => 'Ngày đăng ký',
                                'attribute' => 'register_at',
                                'content' => function ($data) {
                                    /* @var UserRbt $data */
                                    return $data->register_at ? date('d-m-Y', strtotime($data->register_at)) : Yii::t('frontend', '(không có)');
                                },
                            ],
                            [
                                'header' => 'Ngày hết hạn',
                                'attribute' => 'exprired_at',
                                'content' => function ($data) {
                                    /* @var UserRbt $data */
                                    return $data->exprired_at ? date('d-m-Y', strtotime($data->exprired_at)) : Yii::t('frontend', '(không có)');
                                },
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
</section>
