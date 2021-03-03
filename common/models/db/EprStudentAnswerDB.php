<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "attt_student_answer".
 *
 * @property int $id
 * @property int $student_id
 * @property int $exercise_id
 * @property string $path
 */
class EprStudentAnswerDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attt_student_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'exercise_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'exercise_id' => 'Exercise ID',
            'path' => 'Path',
        ];
    }
}
