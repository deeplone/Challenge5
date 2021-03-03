<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_enterprise_rbt".
 *
 * @property int $id ID
 * @property string $tone_code Mã nhạc
 * @property int $tone_id Tone ID
 * @property int $enterprise_id Doanh nghiệp
 * @property string $created_at Tạo lúc
 * @property int $created_by Tạo bởi
 * @property string $file_path File
 * @property string $enterprise_file_id
 */
class EnterpriseRbtDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_enterprise_rbt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tone_code', 'tone_id', 'enterprise_id'], 'required'],
            [['tone_id', 'enterprise_id', 'created_by', 'enterprise_file_id'], 'integer'],
            [['created_at'], 'safe'],
            [['tone_code'], 'string', 'max' => 20],
            [['file_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tone_code' => 'Mã nhạc',
            'tone_id' => 'Tone ID',
            'enterprise_id' => 'Doanh nghiệp',
            'created_at' => 'Tạo lúc',
            'created_by' => 'Tạo bởi',
            'file_path' => 'File',
            'enterprise_file_id' => 'Enterprise File ID',
        ];
    }
}
