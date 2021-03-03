<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EnterpriseFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yêu cầu thu âm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-file-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel, 'action' => 'record']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'created_at',
            'id',
            [
                'attribute' => 'recording_content',
                'format' => 'html',
                'content' => function($data) {
                    return Html::a(Html::encode($data->recording_content), yii\helpers\Url::to(['/profile/update', 'id' => $data->id]));
                }
            ],
            [
                'attribute' => 'accent',
                'format' => 'html',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_accent'][$data->accent];
                }
            ],
            [
                'attribute' => 'intonational',
                'format' => 'html',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_intonational'][$data->intonational];
                }
            ],
            [
                'attribute' => 'sound_background',
                'format' => 'html',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_sound_background'][$data->sound_background];
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
            [
                'attribute' => 'status',
                'format' => 'html',
                'label' => 'Trạng thái',
                'content' => function($data) {
                    return Yii::$app->params['enterprise_file_status'][$data->status];
                }
            ],
            [
                'format' => 'html',
                'label' => 'Upload file ghi âm',
                'content' => function($data) {
                    if (!in_array($data->status, [0, 3])) {
                        return '<input type="file" name="tone-upload-file" accept="audio/mp3" profile="' . $data->id . '"/>';
                    }
                }
            ]
        ],
    ]);
    ?>
</div>