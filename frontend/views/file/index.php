<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EnterpriseFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý kho nhạc quảng cáo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tạo nhạc chờ mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'rbt.tone_code:html:Mã nhạc',
            'name',
            'accent',
            'status',
            '',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
