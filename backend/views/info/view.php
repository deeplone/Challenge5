<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EprInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Biên tập nội dung', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="epr-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => Yii::$app->params['epr_info_type'][$model->type],
            ],
            'content:html',
            'created_at',
            [
                'attribute' => 'created_by',
                'format' => 'html',
                'value' => $model->getUser($model->created_by),
            ],
            'updated_at',
            [
                'attribute' => 'updated_by',
                'format' => 'html',
                'value' => $model->getUser($model->updated_by),
            ],
        ],
    ])
    ?>

</div>
