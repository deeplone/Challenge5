<?php

use common\helpers\Helpers;
use frontend\models\Enteprise;
use frontend\models\EnterpriseFile;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $searchModel frontend\models\EnterpriseFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<section class="mdl mdl-table" id="manageRingTone">
    <div class="container">
        <div class="row row-top">
            <div class="col-md-3">
                <?= Html::a('<i class="mdi mdi-plus mdi-24px"></i> Tạo yêu cầu mới', ['/rbt/create'], ['class' => 'btn btn-outline-info rounded-pill']) ?>
            </div>
            <div class="col-md-9">
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'options' => [
                        'class' => 'form-inline'
                    ]
                ]); ?>

                <?= Html::activeTextInput($searchModel, 'name', [
                    "class" => "form-control rounded-pill bg-secondary text-white border-0",
                    "placeholder" => "Tìm kiếm theo mã hoặc tên nhạc chờ",
                    "aria-label" => "Search",
                    "style" => "font-size:12px"
                ]); ?>

                <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn']) ?>
                <!--                </form>-->
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
                        'summary' => 'Hiển thị <b>{begin}-{end}</b> / <b>{totalCount}</b> bài hát',
                        'tableOptions' => ['class' => 'table table-hover table-bordered'],
                        'pager' => [
                            'class' => 'common\helpers\FrontendPager'
                        ],
                        'columns' => [
                            [
                                'header' => 'Số hồ sơ',
                                'attribute' => 'id',
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    return Helpers::eprCode($data->id);
                                },
                                'format' => 'html', //raw, html
                            ],
                            [
                                'header' => 'Mã bài hát',
                                'format' => 'html', //raw, html
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    $tone_code = $data->rbt->tone_code;
                                    return $tone_code ? Html::encode($tone_code) : "Chưa tạo mã";
                                },
                            ],
                            [
                                'header' => 'Tên bài hát',
                                'attribute' => 'name',
                                'format' => 'html', //raw, html
                                'contentOptions' => ['style' => 'white-space: pre-line;'],
                            ],
                            [
                                'header' => 'File quảng cáo',
                                'format' => 'raw', //raw, html
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    return $data->newAudio($data->id);
                                },
                            ],
                            [
                                'header' => 'Trạng thái',
                                'attribute' => 'status',
                                'format' => 'html', //raw, html
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    return Yii::$app->params['enterprise_file_status'][$data->status];
                                },
                            ],
                            [
                                'header' => 'TB cài đặt',
                                'format' => 'raw', //raw, html
                                'content' => function ($data) {
                                    if (filesize('uploads' . $data->msisdn_file) > 1) {
                                        return Html::a("Kiểm tra", Url::toRoute(['user/user-rbt', 'id' => $data->id]));
                                    } else {
                                        return "Không có";
                                    }
                                },
                            ],
                            [
                                'header' => 'Thời gian tạo',
                                'attribute' => 'created_at',
                                'format' => 'html', //raw, html
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    return $data->created_at ? date('d-m-Y', strtotime($data->created_at)) : Yii::t('frontend', '(không có)');
                                },
                            ],
                            [
                                'header' => 'Thời gian phê duyệt',
                                'attribute' => 'updated_at',
                                'format' => 'html', //raw, html
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    return $data->updated_at ? date('d-m-Y', strtotime($data->updated_at)) : Yii::t('frontend', '(không có)');
                                },
                            ],
                            [
                                'header' => 'Lý do từ chối duyệt',
                                'attribute' => 'reason',
                                'format' => 'html', //raw, html
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    return $data->reason;
                                },
                            ],
                            [
                                'header' => 'Hành động',
                                'format' => 'raw',
                                'content' => function ($data) {
                                    /* @var EnterpriseFile $data */
                                    $user = Yii::$app->user->getIdentity();
                                    /* @var Enteprise $user */
                                    if ($data->requires_recording == 0 && $data->accent) {
                                        $urlUpdate = Url::toRoute(['rbt/record-online', 'id' => $data->id]);
                                    } else if ($data->requires_recording == 1) {
                                        $urlUpdate = Url::toRoute(['rbt/record-request', 'id' => $data->id]);
                                    } else {
                                        $urlUpdate = Url::toRoute(['rbt/record-upload', 'id' => $data->id]);
                                    }
                                    if ($user->type == USER_TYPE_INTERNAL) {
                                        if ($data->requires_recording == 0 && $data->accent) {
                                            $urlPayment = Url::toRoute(['rbt/payment-online-internal', 'id' => $data->id, 'back' => 'home']);
                                        } else if ($data->requires_recording == 1) {
                                            $urlPayment = Url::toRoute(['rbt/payment-request-internal', 'id' => $data->id, 'back' => 'home']);
                                        } else {
                                            $urlPayment = Url::toRoute(['rbt/payment-upload-internal', 'id' => $data->id, 'back' => 'home']);
                                        }
                                    } else {
                                        if ($data->requires_recording == 0 && $data->accent) {
                                            $urlPayment = Url::toRoute(['rbt/payment-online', 'id' => $data->id, 'back' => 'home']);
                                        } else if ($data->requires_recording == 1) {
                                            $urlPayment = Url::toRoute(['rbt/payment-request', 'id' => $data->id, 'back' => 'home']);
                                        } else {
                                            $urlPayment = Url::toRoute(['rbt/payment-upload', 'id' => $data->id, 'back' => 'home']);
                                        }
                                    }
                                    $urlAddExists = Url::toRoute(['/rbt/create', 'relate-id' => $data->id]);
                                    $updateStr = '';
                                    $paymentStr = '';
                                    $addExistsStr = '';
                                    if (in_array($data->status, [RBT_STATUS_NEW, RBT_STATUS_WAITING, RBT_STATUS_REJECTED])) {
                                        $updateStr = "<a href=\"$urlUpdate\" class=\"text-reset text-decoration-none\">
                                                  <span title=\"Sửa\" class=\"mdi mdi-table-edit\"></span>
                                                </a>";
                                    }
                                    if ($data->status == RBT_STATUS_NEW) {
                                        $paymentStr = "<a href=\"$urlPayment\" class=\"text-reset text-decoration-none\">
                                                  <span title=\"Thanh toán\" class=\"mdi mdi-credit-card\"></span>
                                                </a>";
                                    }
                                    if (in_array($data->status, [RBT_STATUS_APPROVED, RBT_STATUS_RBT_SUCCESS]) && $user->type !== USER_TYPE_INTERNAL) {
                                        $addExistsStr = "<a href=\"$urlAddExists\" class=\"text-reset text-decoration-none\">
                                          <span class=\"mdi mdi-plus-circle\"></span>
                                        </a>";
                                    }

                                    return $updateStr . $paymentStr . $addExistsStr;
                                },
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
</section>
