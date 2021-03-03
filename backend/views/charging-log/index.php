<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChargingLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Charging Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charging-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'enterprise.full_name:html:Doanh nghiệp',
        'msisdn',
        'fee',
        'error_code',
        'charged_at',
    ];

    echo \kartik\export\ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'asDropdown' => false,
        'target' => '_self',
        'showConfirmAlert' => false,
        'timeout' => 3600,
        'filename' => date('Ymd') . '_BC_Doanh_thu'
    ]);

    echo yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
    ?>
    ?>


</div>
