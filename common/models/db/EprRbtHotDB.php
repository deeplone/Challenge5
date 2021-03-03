<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_rbt_hot".
 *
 * @property int $id
 * @property string $name
 * @property string $audio_path
 * @property string $img_path
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string $rbt_code
 */
class EprRbtHotDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_rbt_hot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'audio_path', 'img_path'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['name', 'audio_path', 'img_path'], 'string', 'max' => 255],
            [['rbt_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'audio_path' => 'Audio Path',
            'img_path' => 'Img Path',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'rbt_code' => 'Rbt Code',
        ];
    }
}
