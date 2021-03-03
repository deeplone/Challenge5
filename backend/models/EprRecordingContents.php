<?php

namespace backend\models;

use Yii;

class EprRecordingContents extends \common\models\EprRecordingContentsBase {

    public function rules()
    {
        return [
            [['recording_content'], 'required'],
            [['recording_content'], 'string', 'min' => 300, 'max' => 1200],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()')
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                'value' => \Yii::$app->user->getId()
            ],
        ];
    }
}