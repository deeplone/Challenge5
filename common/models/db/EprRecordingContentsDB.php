<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_recording_contents".
 *
 * @property string $id
 * @property string $recording_content Nội dung thu âm
 * @property string $created_at Tạo lúc
 * @property int $created_by Tạo bởi
 * @property string $updated_at Cập nhật lúc
 * @property int $updated_by Cập nhật bởi
 */
class EprRecordingContentsDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_recording_contents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recording_content'], 'required'],
            [['recording_content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recording_content' => 'Recording Content',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
