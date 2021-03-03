<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "attt_exercise".
 *
 * @property int $id
 * @property int $class_id
 * @property int $teacher_id
 * @property string $path
 * @property string $name
 */
class EprExerciseDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attt_exercise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'teacher_id'], 'integer'],
            [['path', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
            'teacher_id' => 'Teacher ID',
            'path' => 'Path',
            'name' => 'Name',
        ];
    }
}
