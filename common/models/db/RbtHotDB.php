<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_rbt_hot".
 *
 * @property int $id
 * @property string $name
 * @property string $enterprise_file_di
 * @property string $img_path
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class RbtHotDB extends \yii\db\ActiveRecord
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
            [['name', 'enterprise_file_di', 'img_path'], 'required'],
            [['enterprise_file_di', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'img_path'], 'string', 'max' => 255],
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
            'enterprise_file_di' => 'Enterprise File Di',
            'img_path' => 'Img Path',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
