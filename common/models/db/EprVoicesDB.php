<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "epr_voices".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $code
 * @property string $path
 * @property string $content
 * @property int $priority
 */
class EprVoicesDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epr_voices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['priority'], 'integer'],
            [['name', 'description', 'code', 'path'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'code' => 'Code',
            'path' => 'Path',
            'content' => 'Content',
            'priority' => 'Priority',
        ];
    }
}
